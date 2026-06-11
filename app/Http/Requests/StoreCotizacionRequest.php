<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auto_id' => ['nullable', 'integer', 'exists:autos,id'],
            'nombre' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'telefono' => ['required', 'string', 'max:40'],
            'modelo_interes' => ['nullable', 'string', 'max:160'],
            'mensaje' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
