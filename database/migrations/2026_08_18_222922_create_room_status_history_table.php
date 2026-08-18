<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_status_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('status_type', 50)
                ->comment('e.g., housekeeping, operational');

            $table->string('old_status', 50)->nullable();
            $table->string('new_status', 50);
            $table->text('notes')->nullable();

            // Log inmutable: solo fecha de creación
            $table->timestamp('created_at');

            $table->index('room_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_status_history');
    }
};