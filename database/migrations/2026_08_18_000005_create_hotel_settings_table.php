<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('currency', 3)->default('PEN');
            $table->string('timezone')->default('America/Lima');
            $table->time('check_in_time')->default('14:00:00');
            $table->time('check_out_time')->default('12:00:00');
            $table->enum('cancellation_policy_type', ['free_until_hours', 'percentage', 'fixed', 'none'])->default('free_until_hours');
            $table->decimal('cancellation_policy_value', 10, 2)->nullable();
            $table->unsignedInteger('cancellation_free_hours')->default(48);
            $table->boolean('tax_enabled')->default(false);
            $table->decimal('tax_percentage', 5, 2)->nullable();
            $table->boolean('booking_enabled')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_settings');
    }
};
