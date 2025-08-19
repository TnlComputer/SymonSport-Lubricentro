<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Inicializamos variables por defecto
        $turnosFuturos = collect();
        $mensaje = 'No hay turnos próximos.';

        if ($user) {
            if ($user->role === 'admin') {
                // Admin ve todos los turnos futuros
                $turnosFuturos = Turno::whereDate('fecha_hora', '>=', now())->get();
            } else {
                $turnosFuturos = Turno::whereDate('fecha_hora', '>=', now())->get();
                // Usuario ve solo sus turnos futuros
                // if (method_exists($user, 'turnos')) {
                //     $turnosFuturos = $user->turnos()
                //         ->whereDate('fecha_hora', '>=', now())
                //         ->get();
                // }
            }

            // Actualizamos mensaje si hay turnos
            if ($turnosFuturos->isNotEmpty()) {
                $mensaje = '';
            }
        }
        dd(get_class($user));  // Ver qué clase de modelo es realmente
        dd(method_exists($user, 'turnos')); // Esto debería dar true

        return view('home', compact('turnosFuturos', 'mensaje'));
    }
}
