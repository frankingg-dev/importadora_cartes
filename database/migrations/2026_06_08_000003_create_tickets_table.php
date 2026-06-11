<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('titulo');
            $table->string('estado')->default('abierto')->index();
            $table->timestamp('last_message_at')->nullable()->index();
            $table->timestamps();

            $table->index(['cliente_id', 'estado']);
            $table->index(['auto_id', 'cliente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
