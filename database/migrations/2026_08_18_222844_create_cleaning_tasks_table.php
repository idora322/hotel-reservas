<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cleaning_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->restrictOnDelete();
            $table->foreignId('room_id')->constrained()->restrictOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('staff')->restrictOnDelete();
            $table->date('task_date');
            $table->string('status', 50)->default('pending')->comment('pending, in_progress, completed, verified, cancelled');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Índices
            $table->index('hotel_id');
            $table->index('room_id');
            $table->index('staff_id');
            $table->index('task_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cleaning_tasks');
    }
};