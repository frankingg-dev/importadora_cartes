<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auto extends Model
{
    protected $fillable = [
        'marca',
        'modelo',
        'version',
        'anio',
        'color',
        'motor',
        'transmision',
        'kilometraje',
        'precio',
        'imagen',
        'tag',
        'estado',
        'publicado',
        'destacado',
        'descripcion',
        'detalles',
        'descripcion_breve',
        'combustible',
        'puertas',
        'cilindros',
        'potencia',
        'torque',
        'traccion',
        'capacidad_tanque',
        'consumo_ciudad',
        'consumo_carretera',
        'dimensiones',
        'peso',
        'capacidad_carga',
        'seguridad',
        'tecnologia',
    ];

    protected $attributes = [
        'imagen' => '/img/home-auto.avif',
        'estado' => 'disponible',
        'publicado' => true,
        'destacado' => false,
    ];

    protected function casts(): array
    {
        return [
            'anio' => 'integer',
            'kilometraje' => 'integer',
            'precio' => 'integer',
            'puertas' => 'integer',
            'cilindros' => 'integer',
            'publicado' => 'boolean',
            'destacado' => 'boolean',
        ];
    }

    public function getDetalle1Attribute(): string
    {
        return "Especificaciones tecnicas: Motor {$this->motor}, Transmision {$this->transmision}, Potencia {$this->potencia} HP.";
    }

    public function getDetalle2Attribute(): string
    {
        return "Caracteristicas: {$this->puertas} puertas, {$this->cilindros} cilindros, Traccion {$this->traccion}.";
    }

    public function getResumenAttribute(): string
    {
        return "Resumen: {$this->marca} {$this->modelo} {$this->anio}, {$this->kilometraje} km, Precio: {$this->precio}.";
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
