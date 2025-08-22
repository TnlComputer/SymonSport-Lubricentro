<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ConfigProductoController extends Controller
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
        $query = Producto::orderBy('nombre');
        $productos = $query->count() > 20 ? $query->paginate(20) : $query->get();
        return view('admin.config.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.config.productos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'costo' => 'required|numeric',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'minimo' => 'nullable|integer',
        'maximo' => 'nullable|integer',
    ]);

    Producto::create($request->only('nombre', 'descripcion', 'costo', 'precio', 'stock', 'minimo', 'maximo'));

    return redirect()->route('config.productos.index')->with('success', 'Producto creado.');
}


    public function edit(Producto $producto)
    {
        return view('admin.config.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'costo' => 'required|numeric',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'minimo' => 'nullable|integer',
        'maximo' => 'nullable|integer',
    ]);

    $producto->update($request->only('nombre', 'descripcion', 'costo', 'precio', 'stock', 'minimo', 'maximo'));

    return redirect()->route('config.productos.index')->with('success', 'Producto actualizado.');
}


    public function destroy(Producto $producto)
    {
        $producto->update(['activo' => 0]);
        return redirect()->route('config.productos.index')->with('success', 'Producto desactivado.');
    }
}
