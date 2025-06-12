<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    
    protected $fillable = [
        'user_id',
        'nama_barang',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'keperluan',
        'kontak_penanggung_jawab',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
