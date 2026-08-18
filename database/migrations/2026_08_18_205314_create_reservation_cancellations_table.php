<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_cancellations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->text('reason')->nullable();
            $table->decimal('penalty', 10, 2)->default(0.00);
            $table->decimal('refund', 10, 2)->default(0.00);
            $table->json('cancellation_policy_snapshot')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Garantiza que haya máximo una cancelación por reserva
            $table->unique('reservation_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_cancellations');
    }
};