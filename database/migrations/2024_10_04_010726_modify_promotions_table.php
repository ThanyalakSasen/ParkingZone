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
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn('hourly_discounted');
            $table->dropColumn('daily_discounted');
            $table->dropColumn('monthly_discounted');
            $table->decimal('discount_percentage', 8, 2)->after('monthly_price')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->decimal('hourly_discounted', 8, 2)->default(0.00);
            $table->decimal('daily_discounted', 8, 2)->default(0.00);
            $table->decimal('monthly_discounted', 8, 2)->default(0.00);

            $table->dropColumn('discount_percentage');
        });
    }
};
