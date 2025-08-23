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
        $query = Producto::where('activo', 1)->orderBy('articulo');
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

        // Crear producto
        $producto = Producto::create([
            'articulo' => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo' => 1,
        ]);

        // Crear precio inicial
        $producto->precios()->create([
            'costo' => $request->costo,
            'venta' => $request->precio,
            'fecha_desde' => now(),
            'activo' => 1,
        ]);

        // Crear stock inicial
        $producto->stocks()->create([
            'tipo_movimiento' => 'ingreso',
            'cantidad' => $request->stock,
            'stock_total' => $request->stock,
            'descripcion' => 'Stock inicial',
            'fecha_movimiento' => now(),
            'activo' => 1,
        ]);

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

        // Actualizar datos básicos del producto
        $producto->update([
            'articulo' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        // Cerrar precio anterior y crear uno nuevo
        $producto->precios()->where('activo', 1)->update(['activo' => 0, 'fecha_hasta' => now()]);
        $producto->precios()->create([
            'costo' => $request->costo,
            'venta' => $request->precio,
            'fecha_desde' => now(),
            'activo' => 1,
        ]);

        // Agregar movimiento de stock si cambió
        $ultimoStock = $producto->stockActual?->stock_total ?? 0;
        $diferencia = $request->stock - $ultimoStock;

        if ($diferencia != 0) {
            $producto->stocks()->create([
                'tipo_movimiento' => $diferencia > 0 ? 'ingreso' : 'egreso',
                'cantidad' => abs($diferencia),
                'stock_total' => $request->stock,
                'descripcion' => 'Ajuste manual',
                'fecha_movimiento' => now(),
                'activo' => 1,
            ]);
        }

        return redirect()->route('config.productos.index')->with('success', 'Producto actualizado.');
    }



    public function destroy(Producto $producto)
    {
        $producto->update(['activo' => 0]);
        return redirect()->route('config.productos.index')->with('success', 'Producto desactivado.');
    }
}
