<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\TipoTurno;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TurnoController extends Controller
{
  // Mostrar todos los turnos
  public function index()
  {
    $user = Auth::user();

    if ($user->role === 'admin') {
      // Admin: ver todos los turnos
      $turnos = Turno::with(['cliente', 'servicios', 'vehiculo'])
        ->orderBy('fecha', 'asc')
        ->orderBy('hora', 'asc')
        ->get();
    } else {
      // Usuario normal: solo sus turnos
      $turnos = Turno::with(['servicios', 'vehiculo'])
        ->where('cliente_id', $user->id)
        ->orderBy('fecha', 'asc')
        ->orderBy('hora', 'asc')
        ->get();
    }

    return view('turnos.index', compact('turnos'));
  }

  // Formulario para crear turno
  public function create()
  {
    $tipoTurnos = TipoTurno::all();
    $clientes = User::where('role', 'user')->get(); // solo clientes
    $vehiculos = Vehiculo::all();
    $servicios = Servicio::all(); // TODOS los servicios
    return view('turnos.create', compact('tipoTurnos', 'clientes', 'vehiculos', 'servicios'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'fecha' => 'required|date',
      'hora' => 'required',
      'tipos_turno' => 'required|array',
    ]);

    $turno = Turno::create($request->all());

    // Asignar los tipos de turno
    $turno->tiposTurno()->sync($request->tipos_turno);

    return redirect()->route('turnos.index')->with('success', 'Turno creado correctamente.');
  }

  public function edit(Turno $turno)
  {
    $tipoTurnos = TipoTurno::all();
    $clientes = User::where('role', 'user')->get();
    $vehiculos = Vehiculo::all();
    $servicios = Servicio::all();
    return view('turnos.edit', compact('turno', 'tipoTurnos', 'clientes', 'vehiculos', 'servicios'));
  }

  public function update(Request $request, Turno $turno)
  {
    $request->validate([
      'fecha' => 'required|date',
      'hora' => 'required',
      'tipos_turno' => 'required|array',
      'servicios' => 'required|array',
    ]);

    // Actualizar fecha, hora y cliente/vehículo si querés
    $turno->fecha = $request->fecha;
    $turno->hora = $request->hora;
    $turno->cliente_id = $request->cliente_id;
    $turno->vehiculo_id = $request->vehiculo_id;
    $turno->status = $request->status;
    $turno->save();

    // Guardar relaciones muchos a muchos
    $turno->tiposTurno()->sync($request->tipos_turno);
    $turno->servicios()->sync($request->servicios);

    return redirect()->route('home')->with('success', 'Turno actualizado correctamente.');
  }

  // Eliminar turno (soft delete)
  public function destroy(Turno $turno)
  {
    $turno->delete();
    return redirect()->route('turnos.index')->with('success', 'Turno eliminado correctamente');
  }
}
