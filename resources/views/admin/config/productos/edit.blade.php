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
                    value="{{ old('nombre', $producto->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label for="precio_compra">Precio Compra</label>
                <input type="number" name="costo" value="{{ old('costo', $producto->costo ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="precio_venta">Precio Venta</label>
                <input type="number" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="stock_min">Stock Mínimo</label>
                <input type="number" name="stock_min" id="stock_min" class="form-control"
                    value="{{ old('stock_min', $producto->stock_min) }}" required>
            </div>

            <div class="form-group">
                <label for="stock_max">Stock Máximo</label>
                <input type="number" name="stock_max" id="stock_max" class="form-control"
                    value="{{ old('stock_max', $producto->stock_max) }}" required>
            </div>

            <div class="form-group">
                <label for="stock_actual">Stock Actual</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            <a href="{{ route('config.productos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
@endsection
