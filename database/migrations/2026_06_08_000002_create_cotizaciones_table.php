<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->nullable()->constrained('autos')->nullOnDelete();
            $table->string('nombre');
            $table->string('email')->index();
            $table->string('telefono');
            $table->string('modelo_interes')->nullable();
            $table->text('mensaje')->nullable();
            $table->string('estado')->default('pendiente')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
