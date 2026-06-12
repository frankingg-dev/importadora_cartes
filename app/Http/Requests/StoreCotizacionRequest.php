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
            'nombre' => ['required', 'string', 'max:120', "regex:/^(?=(?:.*\pL){4,})[\pL\s'.-]+$/u"],
            'email' => ['required', 'email', 'max:160'],
            'telefono' => ['required', 'string', 'max:40', 'regex:/^\+56\s?[0-9\s]{8,13}$/'],
            'modelo_interes' => ['nullable', 'string', 'max:160'],
            'mensaje' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombre' => trim((string) $this->input('nombre')),
            'telefono' => preg_replace('/\s+/', ' ', trim((string) $this->input('telefono'))),
            'modelo_interes' => trim((string) $this->input('modelo_interes')) ?: null,
        ]);
    }

    public function messages(): array
    {
        return [
            'nombre.regex' => 'Ingresa un nombre valido con al menos 4 letras.',
            'telefono.regex' => 'El telefono debe comenzar con +56 y contener solo numeros despues del codigo.',
        ];
    }
}
