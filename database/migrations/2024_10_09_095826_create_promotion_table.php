<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) { 
            $table->id();
            $table->string('festival_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('vehicle_type');
            $table->decimal('hourly_price', 8, 2);
            $table->decimal('daily_price', 8, 2);
            $table->decimal('hourly_discounted', 8, 2)->nullable();
            $table->decimal('daily_discounted', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions'); 
    }
};
