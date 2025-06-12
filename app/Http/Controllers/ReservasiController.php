<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // Admin melihat semua reservasi
            $reservasis = Reservasi::latest()->get();
            return view('admin.reservasi.index', compact('reservasis'));
        } else {
            // Customer hanya melihat reservasi miliknya
            $reservasis = Reservasi::where('user_id', Auth::id())->latest()->get();
            return view('customer.reservasi.index', compact('reservasis'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.reservasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Validasi data input
        $validatedData = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'ruangan' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'jumlah_peserta' => 'required|integer',
            'kontak_penanggung_jawab' => 'required|string',
            'deskripsi_kegiatan' => 'nullable|string',
        ]);

        // 2. Tambahkan user_id ke data yang akan disimpan
        $validatedData['user_id'] = Auth::id();

        // 3. Simpan data ke database
        Reservasi::create($validatedData);

        // 4. Redirect ke halaman riwayat reservasi dengan pesan sukses
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diajukan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservasi $reservasi)
    {
        // Pastikan customer hanya bisa mengedit reservasi miliknya
        if (Auth::id() !== $reservasi->user_id) {
            return redirect()->route('reservasi.index')->with('error', 'Anda tidak memiliki akses.');
        }

        return view('customer.reservasi.edit', compact('reservasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        // 1. Otorisasi: Pastikan user yang benar dan status masih pending
        if (Auth::id() !== $reservasi->user_id || $reservasi->status !== 'pending') {
            return redirect()->route('reservasi.index')->with('error', 'Anda tidak dapat mengubah reservasi ini.');
        }

        // 2. Validasi data
        $validatedData = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'ruangan' => 'required|string',
            'tanggal' => 'required|date',
            // Anda bisa menambahkan validasi lain sesuai form edit
        ]);

        // 3. Update data di database
        $reservasi->update($validatedData);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservasi $reservasi)
    {
        // Otorisasi: Pastikan user yang benar dan status masih pending
        if (Auth::id() !== $reservasi->user_id || $reservasi->status !== 'pending') {
            return redirect()->route('reservasi.index')->with('error', 'Anda tidak dapat membatalkan reservasi ini.');
        }

        // Ubah status menjadi 'dibatalkan'
        $reservasi->update(['status' => 'dibatalkan']);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dibatalkan.');
    }

    public function updateStatus(Request $request, Reservasi $reservasi)
{
    // Validasi input status
    $request->validate([
        'status' => 'required|in:disetujui,ditolak',
    ]);

    // Update status reservasi
    $reservasi->update([
        'status' => $request->status,
    ]);

    return redirect()->route('admin.reservasi.index')->with('success', 'Status reservasi berhasil diperbarui.');
}
}

