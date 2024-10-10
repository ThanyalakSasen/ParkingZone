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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string("shipping_type"); // hourly, daily, monthly
            $table->string("vehicle_type"); // car, motorcycle
            $table->string('license_plate');
            $table->dateTime("date_entry");
            $table->dateTime("date_exit");
            $table->integer('duration'); // Duration can be hours or days based on shipping_type
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
    
};
