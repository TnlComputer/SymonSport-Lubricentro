@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>

        <form action="{{ route('config.productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ old('nombre', $producto->articulo) }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label for="precio_compra">Precio Compra</label>
                <input type="number" step="0.01" name="costo" id="precio_compra" class="form-control"
                    value="{{ old('costo', $producto->precioActual->costo ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="precio_venta">Precio Venta</label>
                <input type="number" step="0.01" name="precio" id="precio_venta" class="form-control"
                    value="{{ old('precio', $producto->precioActual->venta ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="stock_actual">Stock Actual</label>
                <input type="number" name="stock" id="stock_actual" class="form-control"
                    value="{{ old('stock', $producto->stockActual->stock_total ?? 0) }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            <a href="{{ route('config.productos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
@endsection
