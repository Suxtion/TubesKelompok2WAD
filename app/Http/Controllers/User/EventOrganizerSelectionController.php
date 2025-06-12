<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EventOrganizer;
use App\Models\EoBookingRequest; // Impor model baru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class EventOrganizerSelectionController extends Controller
{
    /**
     * Display a listing of active Event Organizers for users to choose from.
     */
    public function index()
    {
        $eventOrganizers = EventOrganizer::where('status', 'aktif')->latest()->get();
        return view('user.event_organizers.index', compact('eventOrganizers'));
    }

    /**
     * Show the form for booking a specific Event Organizer.
     */
    public function showBookingForm(EventOrganizer $eventOrganizer)
    {
        if ($eventOrganizer->status !== 'aktif') {
            abort(404, 'Event Organizer tidak aktif.');
        }
        return view('user.event_organizers.book', compact('eventOrganizer'));
    }


    /**
     * Store a new booking request for the specified Event Organizer.
     */
    public function storeBooking(Request $request, EventOrganizer $eventOrganizer)
    {
        // Pastikan EO aktif sebelum di-booking
        if ($eventOrganizer->status !== 'aktif') {
            return redirect()->back()->with('error', 'Tidak dapat membooking EO ini karena tidak aktif.');
        }

        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string|max:500',
        ]);

        EoBookingRequest::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'event_organizer_id' => $eventOrganizer->id,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'notes' => $request->notes,
            'status' => 'pending', // Status awal: pending
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan booking Anda ke ' . $eventOrganizer->nama_eo . ' telah terkirim! EO akan segera menghubungi Anda.');
        // Atau redirect ke halaman 'permintaan booking saya'
    }

    // Fungsi show detail EO sebelumnya bisa dihapus atau diintegrasikan ke showBookingForm
    // public function show(EventOrganizer $eventOrganizer)
    // {
    //     if ($eventOrganizer->status !== 'aktif') {
    //         abort(404);
    //     }
    //     return view('user.event_organizers.show', compact('eventOrganizer'));
    // }
}