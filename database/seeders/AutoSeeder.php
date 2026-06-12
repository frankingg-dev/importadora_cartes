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
                'puertas' => 5,
                'cilindros' => 4,
                'potencia' => '165',
                'traccion' => 'Delantera',
                'seguridad' => 'Buena altura de manejo, frenos ABS y doble airbag para uso familiar.',
                'tecnologia' => 'Radio multimedia, aire acondicionado y comandos simples para viajes diarios.',
                'detalles' => "Interior amplio para familia\nMaletero practico\nMantenciones revisables\nBuen despeje para ciudad y camino",
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
                'puertas' => 5,
                'cilindros' => 4,
                'potencia' => '94',
                'traccion' => 'Delantera',
                'seguridad' => 'Carroceria compacta, buena visibilidad y respuesta agil para ciudad.',
                'tecnologia' => 'Equipamiento simple y funcional, ideal para traslados diarios de bajo consumo.',
                'detalles' => "Muy economico para uso urbano\nFacil de estacionar\nMecanica sencilla\nBuen rendimiento de combustible",
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
                'cilindros' => 4,
                'potencia' => '105',
                'traccion' => 'Delantera',
                'seguridad' => 'Plataforma confiable, manejo predecible y estructura simple de mantener.',
                'tecnologia' => 'Controles basicos, mecanica conocida y repuestos faciles de encontrar.',
                'detalles' => "Motor Toyota reconocido por su durabilidad\nSedan amplio de 4 puertas\nBajo costo de mantenimiento\nIdeal para primer auto o trabajo",
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
                'puertas' => 5,
                'cilindros' => 4,
                'potencia' => '166',
                'traccion' => 'Delantera',
                'seguridad' => 'Posicion de manejo alta, buena estabilidad y equipamiento familiar.',
                'tecnologia' => 'Confort interior, aire acondicionado y mandos practicos para viajes.',
                'detalles' => "SUV comoda para familia\nBuen espacio interior\nMaletero amplio\nAutomatica para manejo descansado",
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
