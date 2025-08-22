<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class ConfigServicioController extends Controller
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
        $query = Servicio::where('activo', true)->orderBy('nombre');
        $servicios = $query->count() > 20 ? $query->paginate(20) : $query->get();
        return view('admin.config.servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('config.servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:255']);
        Servicio::create($request->only('nombre') + ['activo' => true]);
        return redirect()->route('config.servicios.index')->with('success', 'Servicio creado.');
    }

    public function edit(Servicio $servicio)
    {
        return view('admin.config.servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate(['nombre' => 'required|string|max:255']);
        $servicio->update($request->only('nombre'));
        return redirect()->route('config.servicios.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->update(['activo' => 0]);
        return redirect()->route('config.servicios.index')->with('success', 'Servicio desactivado.');
    }
}
