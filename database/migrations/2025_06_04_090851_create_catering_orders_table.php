<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('catering_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('catering_vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('catering_menu_id')->constrained()->onDelete('cascade');
            $table->dateTime('event_date');
            $table->integer('pax');
            $table->text('special_notes')->nullable();
            $table->string('contact_person');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'sent_to_vendor', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catering_orders');
    }
};