<?php

use App\Http\Controllers\Admin\AutoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/catalogo', [HomeController::class, 'catalogo'])->name('catalogo');
Route::get('/autos/{auto}', [HomeController::class, 'auto'])->name('autos.show');
Route::get('/como-importamos', [HomeController::class, 'comoImportamos'])->name('como-importamos');
Route::get('/quienes-somos', [HomeController::class, 'quienesSomos'])->name('quienes-somos');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [CotizacionController::class, 'store'])->name('contacto.store');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/contrasena', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/mensajes', [TicketController::class, 'message'])->name('tickets.messages.store');
    Route::get('/autos/{auto}/consulta', [TicketController::class, 'start'])->name('tickets.start');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/panel', [AdminController::class, 'inicio'])->name('dashboard.admin');
    Route::get('/autos', [AutoController::class, 'index'])->name('autos.admin');
    Route::post('/autos', [AutoController::class, 'store'])->name('autos.store');
    Route::post('/autos/{auto}', [AutoController::class, 'update'])->name('autos.update.upload');
    Route::put('/autos/{auto}', [AutoController::class, 'update'])->name('autos.update');
    Route::delete('/autos/{auto}', [AutoController::class, 'destroy'])->name('autos.destroy');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios.admin');
    Route::get('/ventas', [AdminController::class, 'ventas'])->name('ventas.admin');
    Route::put('/cotizaciones/{cotizacion}', [AdminController::class, 'actualizarCotizacion'])->name('cotizaciones.update');
    Route::post('/tickets/{ticket}/claim', [TicketController::class, 'claim'])->name('tickets.claim');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
});
