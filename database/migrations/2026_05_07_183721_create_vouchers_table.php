<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'fixed'])->default('fixed');
            $table->decimal('value', 15, 2); // Nilai diskon (persen atau nominal)
            $table->decimal('min_purchase', 15, 2)->default(0); // Minimal belanja
            $table->decimal('max_discount', 15, 2)->nullable(); // Maksimal diskon (untuk persentase)
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('usage_limit')->nullable(); // Batas total kupon bisa dipakai
            $table->integer('used_count')->default(0); // Jumlah kupon yang sudah dipakai
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};