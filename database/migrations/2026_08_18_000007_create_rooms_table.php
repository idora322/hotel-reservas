<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_type_id')->constrained()->restrictOnDelete();
            $table->string('room_number');
            $table->string('floor')->nullable();
            $table->text('description')->nullable();
            $table->enum('operational_status', ['active', 'maintenance', 'out_of_service'])->default('active');
            $table->enum('housekeeping_status', ['clean', 'dirty', 'cleaning', 'inspected'])->default('clean');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['hotel_id', 'room_number']);
            $table->index('hotel_id');
            $table->index('room_type_id');
            $table->index(['hotel_id', 'operational_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};