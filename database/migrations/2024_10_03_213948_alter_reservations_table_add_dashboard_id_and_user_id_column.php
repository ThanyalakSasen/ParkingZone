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
            // ตรวจสอบว่าคอลัมน์ไม่มีอยู่แล้วก่อนเพิ่ม
            if (!Schema::hasColumn('reservations', 'dashboard_id')) {
                $table->foreignId('dashboard_id')->nullable()->default(0)->after('id');
            }
            
            if (!Schema::hasColumn('reservations', 'user_id')) {
                $table->foreignId('user_id')->nullable()->default(0)->after('dashboard_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('dashboard_id');
            $table->dropColumn('user_id');
        });
    }
    
    // /**
    //  * Run the migrations.
    //  */
    // public function up(): void
    // {
    //     Schema::table('reservations', function (Blueprint $table) {
    //         $table->foreignId('dashboard_id')->nullable()->default(false)->after('id');
    //         $table->foreignId('user_id')->nullable()->default(false)->after('dashboard_id');
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::table('reservations', function (Blueprint $table) {
    //         $table->dropColumn('dashboard_id');
    //         $table->dropColumn('user_id');
    //     });
    // }
};