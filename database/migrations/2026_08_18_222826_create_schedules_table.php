<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->tinyInteger('day_of_week')->comment('0 = Sunday, 6 = Saturday');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            // UNIQUE para evitar que el mismo empleado tenga el mismo turno duplicado
            $table->unique(['staff_id', 'day_of_week', 'start_time']);

            $table->index('staff_id');
            $table->index('day_of_week');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};