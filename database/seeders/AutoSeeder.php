<?php

namespace Database\Seeders;

use App\Models\Auto;
use Illuminate\Database\Seeder;

class AutoSeeder extends Seeder
{
    public function run(): void
    {
        Auto::query()
            ->whereIn('modelo', [
                'Palisade Calligraphy',
                'EV6 GT-Line',
                'Santa Fe Hybrid',
                'Sorento Gravity',
                'Ioniq 5 N',
                'Sportage Signature',
            ])
            ->update(['publicado' => false, 'destacado' => false]);

        $autos = [
            [
                'marca' => 'hyundai',
                'modelo' => 'Tucson',
                'version' => 'SUV 5 puertas',
                'anio' => 2012,
                'color' => 'Gris',
                'motor' => '2.0L',
                'transmision' => 'Manual',
                'kilometraje' => 168000,
                'precio' => 6990000,
                'combustible' => 'Bencina',
                'tag' => 'Disponible',
                'estado' => 'disponible',
                'publicado' => true,
                'destacado' => true,
                'descripcion_breve' => 'SUV familiar, comoda y practica para uso diario.',
            ],
            [
                'marca' => 'suzuki',
                'modelo' => 'Swift',
                'version' => 'Hatchback',
                'anio' => 2012,
                'color' => 'Rojo',
                'motor' => '1.4L',
                'transmision' => 'Manual',
                'kilometraje' => 142000,
                'precio' => 5290000,
                'combustible' => 'Bencina',
                'tag' => 'Economico',
                'estado' => 'disponible',
                'publicado' => true,
                'destacado' => true,
                'descripcion_breve' => 'Hatchback compacto, rendidor y facil de estacionar.',
            ],
            [
                'marca' => 'toyota',
                'modelo' => 'Corolla',
                'version' => 'Sedan 4 puertas',
                'anio' => 1991,
                'color' => 'Blanco',
                'motor' => '1.6L',
                'transmision' => 'Manual',
                'kilometraje' => 245000,
                'precio' => 2990000,
                'combustible' => 'Bencina',
                'puertas' => 4,
                'tag' => 'Clasico',
                'estado' => 'disponible',
                'publicado' => true,
                'destacado' => true,
                'descripcion_breve' => 'Sedan 4 puertas confiable, ideal para uso simple y economico.',
            ],
            [
                'marca' => 'kia',
                'modelo' => 'Sportage',
                'version' => 'SUV',
                'anio' => 2012,
                'color' => 'Negro',
                'motor' => '2.0L',
                'transmision' => 'Automatica',
                'kilometraje' => 156000,
                'precio' => 7490000,
                'combustible' => 'Bencina',
                'tag' => 'SUV',
                'estado' => 'disponible',
                'publicado' => true,
                'destacado' => true,
                'descripcion_breve' => 'SUV versatil para ciudad, familia y viajes cortos.',
            ],
        ];

        foreach ($autos as $auto) {
            Auto::updateOrCreate(
                [
                    'marca' => $auto['marca'],
                    'modelo' => $auto['modelo'],
                    'anio' => $auto['anio'],
                ],
                $auto
            );
        }
    }
}
