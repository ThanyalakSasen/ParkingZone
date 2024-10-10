<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_floors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('floor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_floors');
    }
};
