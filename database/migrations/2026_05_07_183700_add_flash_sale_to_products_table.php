<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('flash_sale_price', 15, 2)->nullable()->after('discount_price');
            $table->dateTime('flash_sale_start_date')->nullable()->after('flash_sale_price');
            $table->dateTime('flash_sale_end_date')->nullable()->after('flash_sale_start_date');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['flash_sale_price', 'flash_sale_start_date', 'flash_sale_end_date']);
        });
    }
};