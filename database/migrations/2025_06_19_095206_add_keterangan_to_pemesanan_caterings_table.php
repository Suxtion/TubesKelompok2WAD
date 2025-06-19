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
        Schema::table('pemesanan_caterings', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('jumlah_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pemesanan_caterings', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
};
