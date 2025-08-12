<?php

use App\Http\Controllers\Admin\GestionUsuarioController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContactoController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contacto', [ContactoController::class, 'show'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas de Verificación de Email
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Se ha reenviado el enlace de verificación.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Usuarios autenticados y verificados)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // home
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Productos
    Route::resource('productos', ProductoController::class)->only(['index', 'show']);

    // Pedidos
    Route::resource('pedidos', PedidoController::class);
    // Pedidos
    Route::resource('vehiculos', VehiculoController::class);

    /*
    |--------------------------------------------------------------------------
    | Rutas de Administrador
    |--------------------------------------------------------------------------
    | Puedes aplicar un middleware adicional para que solo el rol admin acceda:
    | middleware(['auth', 'is_admin'])
    |--------------------------------------------------------------------------
    */

Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', GestionUsuarioController::class);
        Route::resource('config', ConfiguracionController::class);
    });

});