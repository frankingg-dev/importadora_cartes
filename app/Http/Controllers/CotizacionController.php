<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCotizacionRequest;
use App\Models\Cotizacion;
use Illuminate\Http\RedirectResponse;

class CotizacionController extends Controller
{
    public function store(StoreCotizacionRequest $request): RedirectResponse
    {
        Cotizacion::create($request->validated());

        return back()->with('message', 'Tu consulta fue enviada correctamente. Te contactaremos pronto.');
    }
}
