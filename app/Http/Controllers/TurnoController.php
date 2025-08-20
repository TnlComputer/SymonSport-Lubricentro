<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Servicio;
use App\Models\TipoTurno;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TurnoController extends Controller
{
  public function index()
  {
    $hoy = now()->toDateString();

    if (Auth::user()->role === 'admin') {
      $turnos = Turno::with(['user', 'vehiculo', 'trabajos.servicio', 'tipoTurnos'])
        ->whereDate('fecha', '>=', $hoy)
        ->orderBy('fecha')
        ->orderBy('hora_inicio')
        ->get();

      // dd($turnos);
    } else {
      $turnos = Turno::where('user_id', Auth::id())
        ->with(['trabajos.servicio', 'vehiculo', 'tipoTurnos'])
        ->whereDate('fecha', '>=', $hoy)
        ->orderBy('fecha')
        ->orderBy('hora_inicio')
        ->get();
    }

    return view('turnos.index', compact('turnos'));
  }



public function create()
{
    $tiposTurno = TipoTurno::all(); // Todos los tipos de turno
    $servicios = Servicio::all();    // Todos los servicios

    if(Auth::user()->role === 'admin') {
        $usuarios = User::all();
        $vehiculos = collect(); // se selecciona luego según usuario
    } else {
        $usuarios = collect([Auth::user()]);
        $vehiculos = Auth::user()->vehiculos; // Vehículos propios
    }

    return view('turnos.create', compact('tiposTurno','servicios','usuarios','vehiculos'));
}

public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'vehiculo_id' => 'nullable|exists:vehiculos,id',
        'nuevo_vehiculo' => 'nullable|string|max:50',
        'fecha' => 'required|date',
        'hora_inicio' => 'required',
        'hora_fin' => 'required',
        'trabajos.*.tipo_trabajo' => 'required',
        'trabajos.*.servicio_id' => 'required|exists:servicios,id',
    ]);

    $user_id = $request->user_id;
    if($request->nuevo_vehiculo) {
        $vehiculo = Vehiculo::create([
            'user_id' => $user_id,
            'patente' => $request->nuevo_vehiculo,
        ]);
        $vehiculo_id = $vehiculo->id;
    } else {
        $vehiculo_id = $request->vehiculo_id;
    }

    $turno = Turno::create([
        'user_id' => $user_id,
        'vehiculo_id' => $vehiculo_id,
        'fecha' => $request->fecha,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin' => $request->hora_fin,
    ]);

    foreach ($request->trabajos as $trabajoData) {
        $turno->trabajos()->create($trabajoData);
    }

    return redirect()->route('turnos.index')->with('success','Turno creado correctamente.');
}

  public function edit(Turno $turno)
  {
    $user = Auth::user();
    $servicios = Servicio::all();
    $tiposTurno = TipoTurno::all();

    if ($user->role === 'admin') {
      $clientes = User::where('role', 'usuario')->get();
      $vehiculos = Vehiculo::all();
      return view('turnos.edit', compact('turno', 'clientes', 'vehiculos', 'servicios', 'tiposTurno'));
    } else {
      $vehiculos = $user->vehiculos;
      return view('turnos.edit', compact('turno', 'vehiculos', 'servicios', 'tiposTurno'));
    }
  }
}
