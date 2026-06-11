<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [
        'auto_id',
        'nombre',
        'email',
        'telefono',
        'modelo_interes',
        'mensaje',
        'estado',
    ];

    protected $attributes = [
        'estado' => 'pendiente',
    ];

    public function auto(): BelongsTo
    {
        return $this->belongsTo(Auto::class);
    }
}
