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
            'alamat_pengiriman' => 'required|string|max:255',
        ]);

        $pemesanan = new PemesananCatering();
        $pemesanan->user_id = Auth::id();
        $pemesanan->penyedia_catering_id = $validatedData['penyedia_catering_id'];
        $pemesanan->jumlah_pesanan = $validatedData['jumlah_pesanan'];
        $pemesanan->alamat_pengiriman = $validatedData['alamat_pengiriman'];
        $pemesanan->status = 'pending'; // Status pemesanan
        $pemesanan->save();

        return redirect()->route('catering.index')->with('success', 'Pemesanan catering berhasil dilakukan.');
    }
}
