<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_room_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_room_id')->constrained()->cascadeOnDelete();
            $table->foreignId('season_id')->nullable()->constrained()->restrictOnDelete();
            $table->date('date');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            // Evita que se cobre dos veces la misma fecha a la misma habitación
            $table->unique(['reservation_room_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_room_rates');
    }
};