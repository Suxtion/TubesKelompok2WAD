<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenyediaCatering;
use App\Models\PemesananCatering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyediaCateringController extends Controller
{
    // Menampilkan daftar penyedia catering untuk admin
    public function index()
    {
        $penyediaCaterings = PenyediaCatering::latest()->get();
        $daftarPesanan = PemesananCatering::with(['user', 'penyediaCatering'])->orderByDesc('created_at')->get();
        return view('admin.penyedia-catering.index', compact('penyediaCaterings', 'daftarPesanan'));
    }

    // Menampilkan form untuk menambah penyedia catering
    public function create()
    {
        return view('admin.penyedia-catering.create');
    }

    // Menyimpan penyedia catering baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_penyedia' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'menu' => 'nullable|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'logo_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('logo_foto')) {
            $validatedData['logo_foto'] = $request->file('logo_foto')->store('logos', 'public');
        }

        PenyediaCatering::create($validatedData);
        return redirect()->route('admin.penyedia-catering.index')->with('success', 'Penyedia Catering berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit penyedia catering
    public function edit(PenyediaCatering $penyediaCatering)
    {
        return view('admin.penyedia-catering.edit', compact('penyediaCatering'));
    }


    // Mengupdate penyedia catering
    public function update(Request $request, PenyediaCatering $penyediaCatering)
    {
        $validatedData = $request->validate([
            'nama_penyedia' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'menu' => 'nullable|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'logo_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('logo_foto')) {
            if ($penyediaCatering->logo_foto) {
                Storage::disk('public')->delete($penyediaCatering->logo_foto);
            }
            $validatedData['logo_foto'] = $request->file('logo_foto')->store('logos', 'public');
        }

        $penyediaCatering->update($validatedData);
        return redirect()->route('admin.penyedia-catering.index')->with('success', 'Penyedia Catering berhasil diperbarui.');
    }

    // Menghapus penyedia catering
    public function destroy(PenyediaCatering $penyediaCatering)
    {
        if ($penyediaCatering->logo_foto) {
            Storage::disk('public')->delete($penyediaCatering->logo_foto);
        }
        $penyediaCatering->delete();
        return redirect()->route('admin.penyedia-catering.index')->with('success', 'Penyedia Catering berhasil dihapus.');
    }

    public function approveOrder($cateringId, $pemesananId)
    {
        $pemesanan = PemesananCatering::findOrFail($pemesananId);
        $pemesanan->status = 'disetujui';
        $pemesanan->save();

        return redirect()->back()->with('success', 'Pemesanan catering berhasil disetujui.');
    }

    public function rejectOrder($cateringId, $pemesananId)
    {
        $pemesanan = PemesananCatering::findOrFail($pemesananId);
        $pemesanan->status = 'ditolak';
        $pemesanan->save();

        return redirect()->back()->with('success', 'Pemesanan catering berhasil ditolak.');
    }

}
