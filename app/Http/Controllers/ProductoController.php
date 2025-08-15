<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(10);
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
            'costo' => 'required|numeric|min:0',
            'venta' => 'required|numeric|min:0',
            'proveedor' => 'nullable|string|max:255',
            'stock_minimo' => 'required|integer|min:0',
            'stock_maximo' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'boolean',
        ]);

        Producto::create($request->all());

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
            'costo' => 'required|numeric|min:0',
            'venta' => 'required|numeric|min:0',
            'proveedor' => 'nullable|string|max:255',
            'stock_minimo' => 'required|integer|min:0',
            'stock_maximo' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'boolean',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}