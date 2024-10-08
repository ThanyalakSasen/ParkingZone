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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('booking_date');  // วันที่จอง
            $table->time('start_time');  // เวลาเข้า
            $table->time('end_time');  // เวลาออก
            $table->string('reservation_number');  // หมายเลขที่จอง
            $table->string('parking_type');  // ประเภทที่จอด
            $table->string('license_plate');  // ป้ายทะเบียน
            $table->string('parking_status');  // สถานะที่จอด
            $table->decimal('price', 8, 2);  // ราคา
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
