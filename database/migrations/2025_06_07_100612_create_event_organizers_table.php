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
        Schema::create('event_organizers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_eo');
            $table->text('deskripsi')->nullable();
            $table->string('kontak_email')->unique();
            $table->string('kontak_telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->string('logo_eo')->nullable(); // Path ke gambar logo
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_organizers');
    }
};