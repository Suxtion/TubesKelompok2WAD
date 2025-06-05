<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_total'); // Jumlah total barang ini yang dimiliki
            $table->integer('jumlah_tersedia'); // Jumlah yang saat ini tersedia untuk dipinjam
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Perlu Perbaikan', 'Rusak Berat'])->default('Baik');
            $table->string('gambar')->nullable(); // Path atau URL ke gambar barang
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};