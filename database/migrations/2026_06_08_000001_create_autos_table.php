<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('marca')->index();
            $table->string('modelo');
            $table->string('version')->nullable();
            $table->unsignedSmallInteger('anio')->index();
            $table->string('color')->nullable();
            $table->string('motor')->nullable();
            $table->string('transmision')->nullable();
            $table->unsignedInteger('kilometraje')->default(0);
            $table->unsignedInteger('precio')->default(0);
            $table->string('imagen')->default('/img/home-auto.avif');
            $table->string('tag')->nullable();
            $table->string('estado')->default('disponible')->index();
            $table->boolean('publicado')->default(true)->index();
            $table->boolean('destacado')->default(false)->index();
            $table->text('descripcion')->nullable();
            $table->string('descripcion_breve')->nullable();
            $table->string('combustible')->nullable();
            $table->unsignedTinyInteger('puertas')->nullable();
            $table->unsignedTinyInteger('cilindros')->nullable();
            $table->string('potencia')->nullable();
            $table->string('torque')->nullable();
            $table->string('traccion')->nullable();
            $table->string('capacidad_tanque')->nullable();
            $table->string('consumo_ciudad')->nullable();
            $table->string('consumo_carretera')->nullable();
            $table->string('dimensiones')->nullable();
            $table->string('peso')->nullable();
            $table->string('capacidad_carga')->nullable();
            $table->text('seguridad')->nullable();
            $table->text('tecnologia')->nullable();
            $table->timestamps();

            $table->index(['publicado', 'destacado', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
