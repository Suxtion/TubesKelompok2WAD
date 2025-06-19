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
        Schema::create('penyedia_caterings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyedia');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->string('kontak');
            $table->string('logo_foto')->nullable(); // Path ke file gambar
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->text('menu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyedia_caterings');
    }
};
