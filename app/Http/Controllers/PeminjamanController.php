<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $peminjamans = Peminjaman::with('user')->latest()->get();
            return view('admin.peminjaman.index', compact('peminjamans'));
        } else {
            $peminjamans = Peminjaman::where('user_id', Auth::id())->latest()->get();
            return view('customer.peminjaman.index', compact('peminjamans'));
        }
    }

    public function edit(Peminjaman $peminjaman)
    {
        if (Auth::id() !== $peminjaman->user_id || $peminjaman->status !== 'pending') {
            return redirect()->route('peminjaman.index')->with('error', 'Anda tidak dapat mengubah pengajuan ini.');
        }
        return view('customer.peminjaman.edit', compact('peminjaman'));
    }

    public function create()
    {
        return view('customer.peminjaman.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keperluan' => 'required|string',
            'kontak_penanggung_jawab' => 'required|string',
        ]);

        $validatedData['user_id'] = Auth::id();
        Peminjaman::create($validatedData);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dibuat.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if (Auth::id() !== $peminjaman->user_id || $peminjaman->status !== 'pending') {
            return redirect()->route('peminjaman.index')->with('error', 'Anda tidak dapat membatalkan pengajuan ini.');
        }

        $peminjaman->update(['status' => 'dibatalkan']);
        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dibatalkan.');
    }

    public function updateStatus(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,dipinjam,dikembalikan,hilang/rusak',
        ]);

        $peminjaman->update(['status' => $request->status]);
        return redirect()->route('admin.peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        if (Auth::id() !== $peminjaman->user_id || $peminjaman->status !== 'pending') {
            return redirect()->route('peminjaman.index')->with('error', 'Anda tidak dapat mengubah pengajuan ini.');
        }

        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keperluan' => 'required|string',
            'kontak_penanggung_jawab' => 'required|string',
        ]);

        $peminjaman->update($validatedData);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil diperbarui.');
    }
}