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
        Schema::table('penyedia_caterings', function (Blueprint $table) {
            $table->text('menu')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('penyedia_caterings', function (Blueprint $table) {
            $table->dropColumn('menu');
        });
    }
};
