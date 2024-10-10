<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // เพิ่มคอลัมน์ user_id
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('reservation_number');
            $table->string('parking_type');
            $table->string('license_plate');
            $table->string('parking_status');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // เชื่อมโยงกับตาราง users
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
