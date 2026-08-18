<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->restrictOnDelete();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->string('reason', 255)->nullable();
            $table->string('reference', 255)->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();

            $table->index('payment_id');
            $table->index('status');
        });

        // Restricción para garantizar que el monto reembolsado sea estrictamente mayor a 0
        DB::statement('ALTER TABLE refunds ADD CONSTRAINT chk_refunds_amount CHECK (amount > 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};