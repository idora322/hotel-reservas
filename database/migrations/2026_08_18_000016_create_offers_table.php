<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed', 'special_price']);
            $table->decimal('discount_value', 10, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('booking_start')->nullable();
            $table->date('booking_end')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['hotel_id', 'slug']);
            $table->index('hotel_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};