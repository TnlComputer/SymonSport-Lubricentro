<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('activo', 1)->paginate(10);
        return view('productos.index', compact('productos'));
    }


    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'articulo' => 'required|string|max:255|unique:productos,articulo',
            'descripcion' => 'required|string|max:255',
            'proveedor' => 'nullable|string|max:255',
            'costo' => 'required|numeric|min:0',
            'venta' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Crear producto
        $producto = Producto::create($request->only(['articulo', 'descripcion', 'proveedor']));

        // Crear precio inicial
        $producto->precios()->create([
            'costo' => $request->costo,
            'venta' => $request->venta,
            'fecha_desde' => now(),
        ]);

        // Crear stock inicial
        $producto->stocks()->create([
            'tipo_movimiento' => 'ingreso',
            'cantidad' => $request->stock,
            'stock_total' => $request->stock,
            'descripcion' => 'Stock inicial',
            'fecha_movimiento' => now(),
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }


    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'articulo' => 'required|string|max:255|unique:productos,articulo,' . $producto->id,
            'descripcion' => 'required|string|max:255',
            'proveedor' => 'nullable|string|max:255',
            'costo' => 'required|numeric|min:0',
            'venta' => 'required|numeric|min:0',
        ]);

        // Actualizar datos del producto
        $producto->update($request->only(['articulo', 'descripcion', 'proveedor']));

        // Cerrar el precio anterior
        $producto->precios()->where('activo', 1)->update([
            'fecha_hasta' => now(),
            'activo' => 0
        ]);

        // Crear nuevo precio
        $producto->precios()->create([
            'costo' => $request->costo,
            'venta' => $request->venta,
            'fecha_desde' => now(),
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }


    public function destroy(Producto $producto)
    {
        // En vez de eliminar, marcamos como inactivo
        $producto->update(['activo' => 0]);

        return redirect()->route('productos.index')->with('success', 'Producto desactivado correctamente.');
    }

    public function restore($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update(['activo' => 1]);

        return redirect()->route('productos.index')->with('success', 'Producto reactivado correctamente.');
    }
}
