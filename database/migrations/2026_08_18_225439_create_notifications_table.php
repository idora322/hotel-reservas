<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID PK
            $table->foreignId('hotel_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type');
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id'); // Coincide con PK de users
            $table->json('data'); // JSON NOT NULL
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Índices declarados explícitamente
            $table->index(['notifiable_type', 'notifiable_id']);
            $table->index('hotel_id');
            $table->index('read_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};