<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('catering_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catering_vendor_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('price_per_pax', 10, 2);
            $table->integer('minimum_order');
            $table->integer('delivery_time_estimate'); // dalam menit
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catering_menus');
    }
};