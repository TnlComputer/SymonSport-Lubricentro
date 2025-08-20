<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $hoy = now()->toDateString();

        if (Auth::user()->role === 'admin') {
            $turnosFuturos = Turno::with(['tipoTurnos', 'servicios', 'user', 'vehiculo'])
                ->where('activo', true)
                ->whereDate('fecha', '>=', $hoy)
                ->orderBy('fecha')
                ->orderBy('hora_inicio')
                ->get();
        } else {
            $turnosFuturos = Turno::where('user_id', Auth::id())
                ->with(['tipoTurnos', 'servicios', 'vehiculo'])
                ->where('activo', true)
                ->whereDate('fecha', '>=', $hoy)
                ->orderBy('fecha')
                ->orderBy('hora_inicio')
                ->get();
        }

        $mensaje = $turnosFuturos->isEmpty() ? 'No tienes turnos próximos.' : '';

        return view('home', compact('turnosFuturos', 'mensaje'));
    }
}
