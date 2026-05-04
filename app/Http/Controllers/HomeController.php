<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User; // Por si necesitas datos de usuarios

class HomeController extends Controller
{
    public function index()
    {
        // Aquí podrías traer datos de la BD

        return Inertia::render('Home', [
            'status' => 'Conectado al servidor con éxito'
        ]);
    }
}
