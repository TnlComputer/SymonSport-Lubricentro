@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alta Producto</h1>

    <form action="{{ route('config.productos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="precio_compra">Precio Compra</label>
            <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control" value="{{ old('precio_compra') }}" required>
        </div>

        <div class="form-group">
            <label for="precio_venta">Precio Venta</label>
            <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta') }}" required>
        </div>

        <div class="form-group">
            <label for="stock_min">Stock Mínimo</label>
            <input type="number" name="stock_min" id="stock_min" class="form-control" value="{{ old('stock_min') }}" required>
        </div>

        <div class="form-group">
            <label for="stock_max">Stock Máximo</label>
            <input type="number" name="stock_max" id="stock_max" class="form-control" value="{{ old('stock_max') }}" required>
        </div>

        <div class="form-group">
            <label for="stock_actual">Stock Actual</label>
            <input type="number" name="stock_actual" id="stock_actual" class="form-control" value="{{ old('stock_actual') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        <a href="{{ route('config.productos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
</div>
@endsection
