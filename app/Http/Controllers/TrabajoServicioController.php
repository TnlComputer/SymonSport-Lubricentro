<?php

namespace App\Http\Controllers;

use App\Models\TrabajoServicio;
use App\Models\Vehiculo;
use App\Models\Turno;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TrabajoServicioController extends Controller
{
  public function index()
  {
    $trabajos = Auth::user()->rol === 'admin'
      ? TrabajoServicio::all()
      : TrabajoServicio::whereHas('vehiculo', function ($q) {
        $q->where('user_id', Auth::id());
      })->get();

    return view('trabajos.index', compact('trabajos'));
  }

  public function create()
  {
    $vehiculos = Auth::user()->rol === 'admin' ? Vehiculo::all() : Auth::user()->vehiculos;
    $turnos = Turno::all();
    $servicios = Servicio::all();
    return view('trabajos.create', compact('vehiculos', 'turnos', 'servicios'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'vehiculo_id' => 'required|exists:vehiculos,id',
      'turno_id' => 'required|exists:turnos,id',
      'servicio_id' => 'required|exists:servicios,id',
      'numero_operacion' => 'required|integer|unique:trabajos_servicio',
      'descripcion' => 'nullable|string',
      'tipo_trabajo' => 'nullable|string|max:255',
      'fecha' => 'required|date',
    ]);

    $data['user_id'] = Auth::id();
    TrabajoServicio::create($data);

    return redirect()->route('trabajos.index')->with('success', 'Trabajo registrado');
  }
}
