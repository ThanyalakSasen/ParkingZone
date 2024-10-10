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
            $table->string("shipping_type");
            $table->string("vehicle_type");
            $table->string('license_plate');
            $table->dateTime("date_entry");
            $table->dateTime("date_exit");
            $table->integer('duration');
            $table->time("time_start");
            $table->timestamps();
            // $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboards');
        // $table->dropSoftDeletes();
    }
};
