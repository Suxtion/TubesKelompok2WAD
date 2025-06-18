<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananCatering extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_caterings';

    protected $fillable = [
        'user_id',
        'penyedia_catering_id',
        'jumlah_pesanan',
        'alamat_pengiriman',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function penyediaCatering()
    {
        return $this->belongsTo(\App\Models\PenyediaCatering::class, 'penyedia_catering_id');
    }

}
