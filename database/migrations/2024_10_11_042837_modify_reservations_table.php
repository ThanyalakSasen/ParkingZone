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
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('reservation_number');
            $table->string('spot_number')->after('user_id')->nullable()->default(null);
            $table->time('time_start')->after('booking_date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('spot_number');
            $table->dropColumn('time_start');
            $table->time('start_time')->after('booking_date')->nullable()->default(null);;
            $table->string('reservation_number')->after('end_time')->nullable()->default(null);;
        });
    }
};
