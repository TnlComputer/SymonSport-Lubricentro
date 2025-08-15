<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::with('cliente')->get();
        return view('turnos.index', compact('turnos'));
    }

    public function create()
    {
        $clientes = User::where('role', 'user')->get();
        $servicios = Servicio::all();
        return view('turnos.create', compact('clientes', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:users,id',
            'tipo_turno' => 'required|in:lubricentro,mecanica ligera,mecanica pesada',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio_id' => 'required|exists:servicios,id',
            'status' => 'nullable|in:pendiente,confirmado,completado,cancelado'
        ]);

        $servicio = Servicio::find($request->servicio_id);

        Turno::create([
            'cliente_id' => $request->cliente_id,
            'tipo_turno' => $request->tipo_turno,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'duracion' => $servicio->duracion,
            'status' => $request->status ?? 'pendiente'
        ]);

        return redirect()->route('turnos.index')->with('success', 'Turno creado correctamente');
    }
}