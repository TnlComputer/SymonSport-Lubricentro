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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TurnoController extends Controller
{
  public function index()
  {
    $hoy = now()->toDateString();

    if (Auth::user()->role === 'admin') {
      $turnos = Turno::with(['tipoTurnos', 'servicios', 'user', 'vehiculo'])
        ->where('activo', true)
        ->whereDate('fecha', '>=', now()->toDateString())
        ->orderBy('fecha')
        ->orderBy('hora_inicio')
        ->get();
    } else {
      $turnos = Turno::where('user_id', Auth::id())
        ->with(['vehiculo', 'tipoTurnos', 'servicios'])
        ->whereDate('fecha', '>=', $hoy)
        ->where('activo', true)
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

    if (Auth::user()->role === 'admin') {
      $usuarios = User::all();
      $vehiculos = collect(); // No hay vehículos cargados hasta elegir un usuario
    } else {
      $usuarios = collect([Auth::user()]);
      // Asegurarse que sea siempre colección aunque no tenga vehículos
      $vehiculos = Auth::user()->vehiculos ?? collect();
    }

    return view('turnos.create', compact('tiposTurno', 'servicios', 'usuarios', 'vehiculos'));
  }


  public function store(Request $request)
  {
    // dd($request->all());
    // 1️⃣ Validación
    $validated = $request->validate([
      'user_id' => 'required|exists:users,id',
      'vehiculo_id' => 'required|exists:vehiculos,id',
      'tipos_trabajo' => 'required|array|min:1',
      'tipos_trabajo.*' => 'required|string|exists:tipo_turnos,nombre',
      'servicios' => 'required|array|min:1',
      'servicios.*' => 'required|exists:servicios,id',
      'fecha' => 'required|date',
      'hora_inicio' => 'required',
      'hora_fin' => 'required',
      'status' => 'required|string',
    ]);

    // 2️⃣ Crear Turno
    $turno = Turno::create([
      'user_id' => $validated['user_id'],
      'vehiculo_id' => $validated['vehiculo_id'],
      'fecha' => $validated['fecha'],
      'hora_inicio' => $validated['hora_inicio'],
      'hora_fin' => $validated['hora_fin'],
      'status' => $validated['status'],
    ]);

    // 3️⃣ Asociar Tipos de Trabajo
    $tipoIds = TipoTurno::whereIn('nombre', $validated['tipos_trabajo'])->pluck('id')->toArray();
    $turno->tipos_trabajo()->sync($tipoIds);

    // 4️⃣ Asociar Servicios con pivot extra
    $pivotServicios = [];
    foreach ($validated['servicios'] as $servicio_id) {
      $pivotServicios[$servicio_id] = [
        'cantidad' => 1,
        'estado' => 'pendiente',
        'activo' => 1,
      ];
    }
    $turno->servicios()->sync($pivotServicios);

    // 5️⃣ Retornar mensaje
    return redirect()->route('turnos.index')
      ->with('success', 'Turno creado correctamente.');
  }


  // public function edit(Turno $turno)
  // {
  //   $user = Auth::user();
  //   $servicios = Servicio::all();
  //   $tiposTurno = TipoTurno::all();

  //   if ($user->role === 'admin') {
  //     $clientes = User::where('role', 'usuario')->get();
  //     $vehiculos = Vehiculo::all();
  //     return view('turnos.edit', compact('turno', 'clientes', 'vehiculos', 'servicios', 'tiposTurno'));
  //   } else {
  //     $vehiculos = $user->vehiculos;
  //     return view('turnos.edit', compact('turno', 'vehiculos', 'servicios', 'tiposTurno'));
  //   }
  // }
  public function edit(Turno $turno)
  {
    // Solo admin puede editar cualquier turno, usuario solo el suyo
    if (Auth::user()->role !== 'admin' && Auth::id() !== $turno->user_id) {
      abort(403);
    }

    $usuarios = Auth::user()->role === 'admin' ? User::all() : collect([Auth::user()]);
    $vehiculos = Auth::user()->role === 'admin' ? Vehiculo::all() : Auth::user()->vehiculos;
    $tiposTurno = TipoTurno::all();
    $servicios = Servicio::all();

    // Para marcar los checkboxes seleccionados
    $tiposSeleccionados = $turno->tipos_trabajo->pluck('nombre')->toArray();
    $serviciosSeleccionados = $turno->servicios->pluck('id')->toArray();

    return view('turnos.edit', compact(
      'turno',
      'usuarios',
      'vehiculos',
      'tiposTurno',
      'servicios',
      'tiposSeleccionados',
      'serviciosSeleccionados'
    ));
  }

  public function update(Request $request, Turno $turno)
  {
    // 1️⃣ Validación
    $validated = $request->validate([
      'user_id' => 'required|exists:users,id',
      'vehiculo_id' => 'required|exists:vehiculos,id',
      'tipos_trabajo' => 'required|array|min:1',
      'tipos_trabajo.*' => 'required|string|exists:tipo_turnos,nombre',
      'servicios' => 'required|array|min:1',
      'servicios.*' => 'required|exists:servicios,id',
      'fecha' => 'required|date',
      'hora_inicio' => 'required',
      'hora_fin' => 'required',
      'status' => 'required|string',
    ]);

    // 2️⃣ Actualizar Turno
    $turno->update([
      'user_id' => $validated['user_id'],
      'vehiculo_id' => $validated['vehiculo_id'],
      'fecha' => $validated['fecha'],
      'hora_inicio' => $validated['hora_inicio'],
      'hora_fin' => $validated['hora_fin'],
      'status' => $validated['status'],
    ]);

    // 3️⃣ Sincronizar Tipos de Trabajo
    $tipoIds = TipoTurno::whereIn('nombre', $validated['tipos_trabajo'])->pluck('id')->toArray();
    $turno->tipos_trabajo()->sync($tipoIds);

    // 4️⃣ Sincronizar Servicios
    $pivotServicios = [];
    foreach ($validated['servicios'] as $servicio_id) {
      $pivotServicios[$servicio_id] = [
        'cantidad' => 1,
        'estado' => 'pendiente',
        'activo' => 1,
      ];
    }
    $turno->servicios()->sync($pivotServicios);

    // 5️⃣ Retornar mensaje
    return redirect()->route('turnos.index')
      ->with('success', 'Turno actualizado correctamente.');
  }

  public function destroy(Turno $turno)
  {
    if (Auth::user()->role !== 'admin' && Auth::id() !== $turno->user_id) {
      abort(403);
    }

    // Marcar como inactivo
    $turno->update(['activo' => false]);

    return redirect()->route('turnos.index')->with('success', 'Turno eliminado correctamente.');
  }
}
