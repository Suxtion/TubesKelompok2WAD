<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_acara',
        'deskripsi_kegiatan',
        'ruangan',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jumlah_peserta',
        'keperluan_tambahan',
        'kontak_penanggung_jawab',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}