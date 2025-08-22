<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoTurno;
use Illuminate\Support\Facades\Auth;

class ConfigTipoTurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Acceso no autorizado');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $query = TipoTurno::where('activo', true)->orderBy('nombre');
        $tiposTurno = $query->count() > 20 ? $query->paginate(20) : $query->get();
        return view('admin.config.tipos_turno.index', compact('tiposTurno'));
    }

    public function create()
    {
        return view('admin.config.tipos_turno.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:255']);
        TipoTurno::create($request->only('nombre') + ['activo' => true]);
        return redirect()->route('config.tipos-turno.index')->with('success', 'Tipo de turno creado.');
    }

    // Controlador
    public function edit(TipoTurno $tipos_turno)
    {
        return view('admin.config.tipos_turno.edit', compact('tipos_turno'));
    }

    public function update(Request $request, TipoTurno $tipos_turno)
    {
        $request->validate(['nombre' => 'required|string|max:255']);
        $tipos_turno->update($request->only('nombre'));
        return redirect()->route('config.tipos-turno.index')->with('success', 'Tipo de turno actualizado.');
    }


    public function destroy(TipoTurno $tipos_turno)
    {
        $tipos_turno->update(['activo' => false]);
        return redirect()->route('config.tipos-turno.index')->with('success', 'Tipo de turno desactivado.');
    }
}
