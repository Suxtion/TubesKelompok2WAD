<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pemesanan_caterings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('penyedia_catering_id');
            $table->integer('jumlah_pesanan');
            $table->string('alamat_pengiriman', 255);
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('penyedia_catering_id')->references('id')->on('penyedia_caterings');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_caterings');
    }
};
