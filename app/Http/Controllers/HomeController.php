<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $mensaje = null;

    if ($user->role === 'user') {
      // Turnos futuros del propio usuario
      $turnosFuturos = Turno::with(['tiposTurno', 'servicios', 'vehiculo'])
        ->where('cliente_id', $user->id)
        ->where('fecha', '>=', Carbon::now())
        ->orderBy('fecha', 'asc')
        ->orderBy('hora', 'asc')
        ->get();

      if ($turnosFuturos->isEmpty()) {
        $mensaje = 'No tenés turnos registrados.';
      }
    } else {
      // Admin: todos los turnos futuros de todos los usuarios
      $turnosFuturos = Turno::with(['cliente', 'tiposTurno', 'servicios', 'vehiculo'])
        ->where('fecha', '>=', Carbon::now())
        ->orderBy('fecha', 'asc')
        ->orderBy('hora', 'asc')
        ->get();

      if ($turnosFuturos->isEmpty()) {
        $mensaje = 'No hay turnos registrados.';
      }
    }

    return view('home', compact('turnosFuturos', 'mensaje'));
  }
}

