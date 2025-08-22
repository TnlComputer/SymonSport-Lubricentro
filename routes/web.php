<?php

use App\Http\Controllers\Admin\ConfigProductoController;
use App\Http\Controllers\Admin\ConfigServicioController;
use App\Http\Controllers\Admin\ConfigTipoTurnoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TrabajoServicioController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;

// -------------------
// Rutas públicas
// -------------------
Route::get('/', fn() => view('welcome'))->name('welcome');

Route::get('/contacto', [ContactoController::class, 'show'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');

// -------------------
// Rutas autenticadas
// -------------------
Route::middleware(['auth'])->group(function () {

  // Perfil
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Vehículos, Turnos, Servicios, Trabajos
  Route::resource('vehiculos', VehiculoController::class);
  Route::resource('turnos', TurnoController::class);
  Route::resource('servicios', ServicioController::class)->except(['destroy', 'show']);
  Route::resource('trabajos', TrabajoServicioController::class)->except(['destroy', 'edit', 'update']);

  // Vehículos de un usuario (AJAX en turnos)
  Route::get('/usuarios/{id}/vehiculos', [UserController::class, 'vehiculos'])
    ->name('usuarios.vehiculos');
  Route::post('/vehiculos/ajax', [VehiculoController::class, 'storeAjax'])->name('vehiculos.store.ajax');

  // Pedidos y Productos
  Route::resource('pedidos', PedidoController::class);
  Route::resource('productos', ProductoController::class)->only(['index', 'show']);
});

// -------------------
// Rutas de administrador
// -------------------
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
  Route::resource('users', UserController::class);
});

// -------------------
// Rutas de configuración (solo admin)
// -------------------
Route::middleware(['auth', AdminMiddleware::class])
  ->prefix('admin/configuracion')
  ->name('config.')
  ->group(function () {

    // Servicios
    Route::resource('servicios', ConfigServicioController::class);

    // Tipos de Turno
    Route::resource('tipos-turno', ConfigTipoTurnoController::class);

    // Productos
    Route::resource('productos', ConfigProductoController::class);
  });



// -------------------
// Rutas de verificación de email
// -------------------
Route::middleware(['auth'])->group(function () {

  Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');

  Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
  })->middleware(['signed'])->name('verification.verify');

  Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Se ha reenviado el enlace de verificación.');
  })->middleware('throttle:6,1')->name('verification.send');
});

// -------------------
// Ruta Home (auth + verified)
// -------------------
Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// -------------------
// Autenticación Laravel Breeze / Jetstream
// -------------------
require __DIR__ . '/auth.php';
