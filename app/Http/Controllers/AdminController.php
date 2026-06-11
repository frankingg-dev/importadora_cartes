<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Cotizacion;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Throwable;

class AdminController extends Controller
{
    public function inicio()
    {
        return Inertia::render('Admin/Inicio', [
            'stats' => $this->stats(),
            'ultimosAutos' => Auto::query()
                ->latest()
                ->take(5)
                ->get()
                ->map(fn (Auto $auto) => $this->autoRow($auto)),
            'ultimasCotizaciones' => Cotizacion::query()
                ->latest()
                ->take(5)
                ->get(['id', 'nombre', 'modelo_interes', 'estado', 'created_at'])
                ->map(fn (Cotizacion $cotizacion) => [
                    'id' => $cotizacion->id,
                    'nombre' => $cotizacion->nombre,
                    'modelo_interes' => $cotizacion->modelo_interes,
                    'estado' => $cotizacion->estado,
                    'fecha' => $cotizacion->created_at?->format('d/m/Y'),
                ]),
        ]);
    }

    public function usuarios()
    {
        return Inertia::render('Admin/Usuarios', [
            'stats' => $this->stats(),
            'usuarios' => User::query()
                ->latest()
                ->take(20)
                ->get(['id', 'name', 'email', 'created_at'])
                ->map(fn (User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at?->format('d/m/Y'),
                    'roles' => $user->getRoleNames(),
                ]),
        ]);
    }

    public function ventas()
    {
        return Inertia::render('Admin/Ventas', [
            'stats' => $this->stats(),
            'cotizaciones' => Cotizacion::query()
                ->with('auto:id,marca,modelo')
                ->latest()
                ->paginate(12)
                ->through(fn (Cotizacion $cotizacion) => [
                    'id' => $cotizacion->id,
                    'nombre' => $cotizacion->nombre,
                    'email' => $cotizacion->email,
                    'telefono' => $cotizacion->telefono,
                    'modelo_interes' => $cotizacion->modelo_interes,
                    'estado' => $cotizacion->estado,
                    'mensaje' => $cotizacion->mensaje,
                    'fecha' => $cotizacion->created_at?->format('d/m/Y'),
                    'auto' => $cotizacion->auto ? "{$cotizacion->auto->marca} {$cotizacion->auto->modelo}" : null,
                ]),
        ]);
    }

    public function actualizarCotizacion(Request $request, Cotizacion $cotizacion): RedirectResponse
    {
        $data = $request->validate([
            'estado' => ['required', Rule::in(['pendiente', 'contactado', 'cerrado', 'descartado'])],
        ]);

        DB::beginTransaction();

        try {
            Cotizacion::updateOrCreate(
                ['id' => $cotizacion->id],
                $data
            );

            DB::commit();

            return back()->with('message', 'Cotizacion actualizada.');
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'general' => 'No se pudo actualizar la cotizacion. Intentalo nuevamente.',
            ]);
        }
    }

    private function stats(): array
    {
        return [
            'autos' => Auto::count(),
            'cotizaciones' => Cotizacion::where('estado', 'pendiente')->count(),
            'usuarios' => User::count(),
            'transito' => Auto::where('estado', 'transito')->count(),
        ];
    }

    private function autoRow(Auto $auto): array
    {
        return [
            'id' => $auto->id,
            'marca' => $auto->marca,
            'modelo' => $auto->modelo,
            'version' => $auto->version,
            'anio' => $auto->anio,
            'precio' => $auto->precio,
            'estado' => $auto->estado,
        ];
    }
}
