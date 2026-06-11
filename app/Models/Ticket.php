<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'auto_id',
        'cliente_id',
        'admin_id',
        'titulo',
        'estado',
        'last_message_at',
    ];

    protected $attributes = [
        'estado' => 'abierto',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    public function auto(): BelongsTo
    {
        return $this->belongsTo(Auto::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function mensajes(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }
}
