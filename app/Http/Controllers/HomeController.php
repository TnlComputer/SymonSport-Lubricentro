<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Turno;



class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

      if ($user->role === 'user') {
    $proximoTurno = $user->turnos()
        ->where('fecha', '>=', now())
        ->orderBy('fecha', 'asc')
        ->first();

    $eventos = $user->turnos()
        ->whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get()
        ->map(function ($turno) {
            return [
                'title' => 'Turno a las ' . Carbon::parse($turno->fecha)->format('H:i'),
                'start' => $turno->fecha,
            ];
        });

    // Si no hay próximo turno, creamos un mensaje
    $mensaje = $proximoTurno
        ? null
        : 'No tenés turnos próximos asignados.';

    return view('home', compact('proximoTurno', 'eventos', 'mensaje'));
}

        // Si es admin → ve todos los turnos de la semana
        $turnosSemana = Turno::whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('fecha', 'asc')
            ->get();

        $diasSemana = [];
        $startOfWeek = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $diasSemana[] = $startOfWeek->copy()->addDays($i);
        }

        // Eventos para el calendario (todos los clientes)
        $eventos = $turnosSemana->map(function ($turno) {
            return [
                'title' => $turno->cliente->name . ' - ' . Carbon::parse($turno->fecha)->format('H:i'),
                'start' => $turno->fecha,
            ];
        });

        return view('home', compact('turnosSemana', 'diasSemana', 'eventos'));
    }
}
