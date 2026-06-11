<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAutoRequest;
use App\Models\Auto;
use App\Models\Cotizacion;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class AutoController extends Controller
{
    public function index(): Response
    {
        $autos = Auto::query()
            ->latest()
            ->paginate(12)
            ->through(fn (Auto $auto) => $this->autoData($auto));

        return Inertia::render('Admin/Autos', [
            'autos' => $autos,
            'stats' => [
                'autos' => Auto::count(),
                'cotizaciones' => Cotizacion::where('estado', 'pendiente')->count(),
                'usuarios' => User::count(),
                'transito' => Auto::where('estado', 'transito')->count(),
            ],
        ]);
    }

    public function store(StoreAutoRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $payload = $this->autoPayload($request);

            Auto::updateOrCreate(
                [
                    'marca' => $payload['marca'],
                    'modelo' => $payload['modelo'],
                    'anio' => $payload['anio'],
                    'version' => $payload['version'] ?? null,
                ],
                $payload
            );

            DB::commit();

            return back()->with('message', 'Vehiculo agregado al stock.');
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'general' => 'No se pudo guardar el vehiculo. Intentalo nuevamente.',
            ]);
        }
    }

    public function update(StoreAutoRequest $request, Auto $auto): RedirectResponse
    {
        DB::beginTransaction();

        try {
            Auto::updateOrCreate(
                ['id' => $auto->id],
                $this->autoPayload($request)
            );

            DB::commit();

            return back()->with('message', 'Vehiculo actualizado.');
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'general' => 'No se pudo actualizar el vehiculo. Intentalo nuevamente.',
            ]);
        }
    }

    public function destroy(Auto $auto): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $auto->delete();

            DB::commit();

            return back()->with('message', 'Vehiculo eliminado.');
        } catch (Throwable $exception) {
            DB::rollBack();
            report($exception);

            return back()->withErrors([
                'general' => 'No se pudo eliminar el vehiculo. Intentalo nuevamente.',
            ]);
        }
    }

    private function autoData(Auto $auto): array
    {
        return [
            'id' => $auto->id,
            'marca' => $auto->marca,
            'modelo' => $auto->modelo,
            'version' => $auto->version,
            'anio' => $auto->anio,
            'color' => $auto->color,
            'precio' => $auto->precio,
            'estado' => $auto->estado,
            'combustible' => $auto->combustible,
            'motor' => $auto->motor,
            'transmision' => $auto->transmision,
            'kilometraje' => $auto->kilometraje,
            'imagen' => $auto->imagen,
            'tag' => $auto->tag,
            'descripcion' => $auto->descripcion,
            'detalles' => $auto->detalles,
            'descripcion_breve' => $auto->descripcion_breve,
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
            'publicado' => $auto->publicado,
            'destacado' => $auto->destacado,
            'created_at' => $auto->created_at?->format('d/m/Y'),
        ];
    }

    private function autoPayload(StoreAutoRequest $request): array
    {
        $payload = $request->validated();
        unset($payload['imagen_archivo']);

        if ($request->hasFile('imagen_archivo')) {
            $path = $request->file('imagen_archivo')->store('autos', 'public');
            $payload['imagen'] = Storage::url($path);
        }

        return $payload + [
            'publicado' => $request->boolean('publicado'),
            'destacado' => $request->boolean('destacado'),
        ];
    }
}
