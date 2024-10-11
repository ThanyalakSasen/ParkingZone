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
        Schema::dropIfExists('customer_infos');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_card');
            $table->string('line_id');
            $table->string('phone');
            $table->timestamps();
        });
    }
};
