<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin') ?? false;
    }

    public function rules(): array
    {
        return [
            'marca' => ['required', 'string', 'max:80'],
            'modelo' => ['required', 'string', 'max:120'],
            'version' => ['nullable', 'string', 'max:160'],
            'anio' => ['required', 'integer', 'between:1990,2035'],
            'color' => ['nullable', 'string', 'max:80'],
            'motor' => ['nullable', 'string', 'max:120'],
            'transmision' => ['nullable', 'string', 'max:80'],
            'kilometraje' => ['required', 'integer', 'min:0'],
            'precio' => ['required', 'integer', 'min:0'],
            'imagen' => ['nullable', 'string', 'max:255'],
            'imagen_archivo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'tag' => ['nullable', 'string', 'max:80'],
            'estado' => ['required', Rule::in(['disponible', 'transito', 'reservado', 'vendido'])],
            'descripcion_breve' => ['nullable', 'string', 'max:180'],
            'combustible' => ['nullable', 'string', 'max:80'],
            'puertas' => ['nullable', 'integer', 'between:1,6'],
            'cilindros' => ['nullable', 'integer', 'between:1,16'],
            'potencia' => ['nullable', 'string', 'max:80'],
            'torque' => ['nullable', 'string', 'max:80'],
            'traccion' => ['nullable', 'string', 'max:80'],
            'capacidad_tanque' => ['nullable', 'string', 'max:80'],
            'consumo_ciudad' => ['nullable', 'string', 'max:80'],
            'consumo_carretera' => ['nullable', 'string', 'max:80'],
            'dimensiones' => ['nullable', 'string', 'max:120'],
            'peso' => ['nullable', 'string', 'max:80'],
            'capacidad_carga' => ['nullable', 'string', 'max:80'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
            'detalles' => ['nullable', 'string', 'max:4000'],
            'seguridad' => ['nullable', 'string', 'max:2000'],
            'tecnologia' => ['nullable', 'string', 'max:2000'],
            'publicado' => ['boolean'],
            'destacado' => ['boolean'],
        ];
    }
}
