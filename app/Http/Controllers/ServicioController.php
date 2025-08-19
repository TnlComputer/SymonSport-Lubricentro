<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\TipoTurno;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
  public function index()
  {
    $servicios = Servicio::all();
    return view('servicios.index', compact('servicios'));
  }

  public function create()
  {
    $tipos = TipoTurno::all();
    return view('servicios.create', compact('tipos'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'nombre' => 'required|string|max:255',
      'duracion' => 'required|integer',
      'tipo_turno_id' => 'required|exists:tipo_turnos,id',
    ]);

    Servicio::create($data);
    return redirect()->route('servicios.index')->with('success', 'Servicio creado');
  }
}
