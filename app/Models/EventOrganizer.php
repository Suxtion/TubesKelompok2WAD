<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventOrganizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_eo',
        'deskripsi',
        'kontak_email',
        'kontak_telepon',
        'alamat',
        'logo_eo', // Path ke logo EO
        'status', // Contoh: Aktif, Tidak Aktif
    ];

    // Jika nanti ada relasi ke event atau portfolio, bisa ditambahkan di sini
    // public function events()
    // {
    //     return $this->hasMany(Event::class);
    // }
}