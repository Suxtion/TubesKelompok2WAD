<?php
namespace App\Http\Controllers;

use App\Models\PenyediaCatering;
use App\Models\PemesananCatering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananCateringController extends Controller
{
    public function create()
    {
        $penyediaCaterings = PenyediaCatering::where('status', 'aktif')->get();
        return view('customer.pemesanan-catering.create', compact('penyediaCaterings'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'penyedia_catering_id' => 'required|exists:penyedia_caterings,id',
            'jumlah_pesanan' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'alamat_pengiriman' => 'required|string|max:255',
        ]);

        $pemesanan = new PemesananCatering();
        $pemesanan->user_id = Auth::id();
        $pemesanan->penyedia_catering_id = $validatedData['penyedia_catering_id'];
        $pemesanan->jumlah_pesanan = $validatedData['jumlah_pesanan'];
        $pemesanan->keterangan = $validatedData['keterangan'] ?? null;
        $pemesanan->alamat_pengiriman = $validatedData['alamat_pengiriman'];
        $pemesanan->status = 'pending'; // Status pemesanan
        $pemesanan->save();

        return redirect()->route('customer.catering.index')->with('success', 'Pemesanan catering berhasil dilakukan.');
    }

    public function index()
    {
        $pemesanan = \App\Models\PemesananCatering::where('user_id', auth()->id())->latest()->get();
        return view('customer.catering.index', compact('pemesanan'));
    }
}
