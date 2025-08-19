<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Servicio;
use App\Models\TipoTurno;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnoController extends Controller
{
  public function index()
  {
    $turnos = Auth::user()->role === 'admin'
      ? Turno::with(['servicios', 'vehiculo', 'cliente', 'tiposTurno'])->get()
      : Auth::user()->turnos()->with(['servicios', 'vehiculo', 'tiposTurno'])->get();


    return view('turnos.index', compact('turnos'));
  }

  public function create()
  {
    $user = Auth::user();
    $servicios = Servicio::all();
    $tipoTurnos = TipoTurno::all(); // Traer tipos de turno

    if ($user->role === 'admin') {
      $clientes = User::where('role', 'usuario')->get();
      $vehiculos = Vehiculo::all(); // Todos los vehículos (o filtrar por cliente si quieres)
      return view('turnos.create', compact('clientes', 'vehiculos', 'servicios', 'tipoTurnos'));
    } else {
      $vehiculos = $user->vehiculos;
      return view('turnos.create', compact('vehiculos', 'servicios', 'tipoTurnos'));
    }
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'fecha_hora' => 'required|date',
      'vehiculo_id' => 'required|exists:vehiculos,id',
      'servicios' => 'required|array',
      'servicios.*' => 'exists:servicios,id',
    ]);

    $data['usuario_id'] = Auth::id();

    $turno = Turno::create($data);

    // Guardamos los servicios relacionados
    $turno->servicios()->sync($request->servicios);

    return redirect()->route('turnos.index')->with('success', 'Turno creado correctamente.');
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
