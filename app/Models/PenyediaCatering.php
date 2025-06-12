<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyediaCatering extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penyedia',
        'deskripsi',
        'alamat',
        'kontak',
        'logo_foto',
        'status',
    ];
}