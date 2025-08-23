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
            <input type="number" step="0.01" name="costo" id="precio_compra" class="form-control" value="{{ old('costo') }}" required>
        </div>

        <div class="form-group">
            <label for="precio_venta">Precio Venta</label>
            <input type="number" step="0.01" name="precio" id="precio_venta" class="form-control" value="{{ old('precio') }}" required>
        </div>

        <div class="form-group">
            <label for="stock_actual">Stock Inicial</label>
            <input type="number" name="stock" id="stock_actual" class="form-control" value="{{ old('stock') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        <a href="{{ route('config.productos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
</div>
@endsection
