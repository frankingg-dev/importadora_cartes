<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $destacados = Auto::query()
            ->where('publicado', true)
            ->where('destacado', true)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Auto $auto) => $this->autoCard($auto));

        return Inertia::render('Home', [
            'destacados' => $destacados,
        ]);
    }

    public function comoImportamos()
    {
        return Inertia::render('Como-Importamos');
    }

    public function quienesSomos()
    {
        return Inertia::render('Quienes-Somos');
    }

    public function infografia()
    {
        return Inertia::render('InfografiaProyecto');
    }

    public function catalogo()
    {
        $autos = Auto::query()
            ->where('publicado', true)
            ->latest()
            ->get()
            ->map(fn (Auto $auto) => $this->autoCard($auto));

        return Inertia::render('Catalogo', [
            'autos' => $autos,
        ]);
    }

    public function auto(Auto $auto)
    {
        abort_unless($auto->publicado, 404);

        return Inertia::render('AutoDetalle', [
            'auto' => $this->autoDetalle($auto),
        ]);
    }

    public function contacto()
    {
        $autos = Auto::query()
            ->where('publicado', true)
            ->orderBy('marca')
            ->orderBy('modelo')
            ->get(['id', 'marca', 'modelo', 'version']);

        return Inertia::render('Contacto', [
            'autos' => $autos,
        ]);
    }

    private function autoCard(Auto $auto): array
    {
        return [
            'id' => $auto->id,
            'marca' => strtolower($auto->marca),
            'modelo' => $auto->modelo,
            'version' => $auto->version,
            'anio' => $auto->anio,
            'motor' => $auto->motor,
            'combustible' => $auto->combustible,
            'imagen' => $auto->imagen,
            'tag' => $auto->tag,
            'precio' => $auto->precio,
            'estado' => $auto->estado,
            'descripcion_breve' => $auto->descripcion_breve,
        ];
    }

    private function autoDetalle(Auto $auto): array
    {
        return [
            ...$this->autoCard($auto),
            'color' => $auto->color,
            'transmision' => $auto->transmision,
            'kilometraje' => $auto->kilometraje,
            'descripcion' => $auto->descripcion,
            'detalles' => $auto->detalles,
            'puertas' => $auto->puertas,
            'cilindros' => $auto->cilindros,
            'potencia' => $auto->potencia,
            'torque' => $auto->torque,
            'traccion' => $auto->traccion,
            'capacidad_tanque' => $auto->capacidad_tanque,
            'consumo_ciudad' => $auto->consumo_ciudad,
            'consumo_carretera' => $auto->consumo_carretera,
            'dimensiones' => $auto->dimensiones,
            'peso' => $auto->peso,
            'capacidad_carga' => $auto->capacidad_carga,
            'seguridad' => $auto->seguridad,
            'tecnologia' => $auto->tecnologia,
            'resumen' => $auto->resumen,
            'detalle1' => $auto->motor && $auto->transmision && $auto->potencia ? $auto->detalle1 : null,
            'detalle2' => $auto->puertas && $auto->cilindros && $auto->traccion ? $auto->detalle2 : null,
        ];
    }
}
