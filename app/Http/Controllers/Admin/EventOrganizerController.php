<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\EoBookingRequest; // Jangan lupa impor model ini


class EventOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventOrganizers = EventOrganizer::latest()->get();
        return view('admin.event_organizers.index', compact('eventOrganizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event_organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_eo' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kontak_email' => 'required|email|unique:event_organizers,kontak_email',
            'kontak_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'logo_eo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo_eo')) {
            $logoPath = $request->file('logo_eo')->store('public/eo_logos');
            $logoPath = str_replace('public/', '', $logoPath);
        }

        EventOrganizer::create([
            'nama_eo' => $request->nama_eo,
            'deskripsi' => $request->deskripsi,
            'kontak_email' => $request->kontak_email,
            'kontak_telepon' => $request->kontak_telepon,
            'alamat' => $request->alamat,
            'logo_eo' => $logoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.event-organizers.index')->with('success', 'Event Organizer berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventOrganizer $eventOrganizer)
    {
        return view('admin.event_organizers.edit', compact('eventOrganizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventOrganizer $eventOrganizer)
    {
        $request->validate([
            'nama_eo' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kontak_email' => 'required|email|unique:event_organizers,kontak_email,' . $eventOrganizer->id,
            'kontak_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'logo_eo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $logoPath = $eventOrganizer->logo_eo;

        if ($request->hasFile('logo_eo')) {
            if ($eventOrganizer->logo_eo && Storage::disk('public')->exists($eventOrganizer->logo_eo)) {
                Storage::disk('public')->delete($eventOrganizer->logo_eo);
            }
            $logoPath = $request->file('logo_eo')->store('public/eo_logos');
            $logoPath = str_replace('public/', '', $logoPath);
        }

        $eventOrganizer->update([
            'nama_eo' => $request->nama_eo,
            'deskripsi' => $request->deskripsi,
            'kontak_email' => $request->kontak_email,
            'kontak_telepon' => $request->kontak_telepon,
            'alamat' => $request->alamat,
            'logo_eo' => $logoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.event-organizers.index')->with('success', 'Event Organizer berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventOrganizer $eventOrganizer)
    {
        if ($eventOrganizer->logo_eo && Storage::disk('public')->exists($eventOrganizer->logo_eo)) {
            Storage::disk('public')->delete($eventOrganizer->logo_eo);
        }

        $eventOrganizer->delete();
        return redirect()->route('admin.event-organizers.index')->with('success', 'Event Organizer berhasil dihapus!');
    }

     public function bookingRequests()
    {
        // Ambil semua permintaan booking, urutkan dari yang terbaru
        // Eager load relasi user dan eventOrganizer untuk menampilkan nama
        $bookingRequests = EoBookingRequest::with(['user', 'eventOrganizer'])
                                            ->latest()
                                            ->get();

        return view('admin.booking_requests.index', compact('bookingRequests'));
    }

    /**
     * Show the form for editing the specified booking request status.
     */
    public function editBookingStatus(EoBookingRequest $bookingRequest)
    {
        return view('admin.booking_requests.edit_status', compact('bookingRequest'));
    }

    /**
     * Update the status of the specified booking request.
     */
    public function updateBookingStatus(Request $request, EoBookingRequest $bookingRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed',
        ]);

        $bookingRequest->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.booking-requests.index')->with('success', 'Status permintaan booking berhasil diperbarui!');
    }
}