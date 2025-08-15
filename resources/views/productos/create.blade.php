@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ isset($producto) ? 'Editar Producto' : 'Nuevo Producto' }}</h1>

  <form action="{{ isset($producto) ? route('productos.update', $producto) : route('productos.store') }}" method="POST">
    @csrf
    @if(isset($producto)) @method('PUT') @endif

    <div class="form-group">
      <label>Artículo</label>
      <input type="text" name="articulo" class="form-control" value="{{ old('articulo', $producto->articulo ?? '') }}"
        required>
    </div>
    <div class="form-group">
      <label>Descripción</label>
      <input type="text" name="descripcion" class="form-control"
        value="{{ old('descripcion', $producto->descripcion ?? '') }}" required>
    </div>
    <div class="form-group">
      <label>Costo</label>
      <input type="number" step="0.01" name="costo" class="form-control"
        value="{{ old('costo', $producto->costo ?? '') }}" required>
    </div>
    <div class="form-group">
      <label>Venta</label>
      <input type="number" step="0.01" name="venta" class="form-control"
        value="{{ old('venta', $producto->venta ?? '') }}" required>
    </div>
    <div class="form-group">
      <label>Proveedor</label>
      <input type="text" name="proveedor" class="form-control"
        value="{{ old('proveedor', $producto->proveedor ?? '') }}">
    </div>
    <div class="form-group">
      <label>Stock Mínimo</label>
      <input type="number" name="stock_minimo" class="form-control"
        value="{{ old('stock_minimo', $producto->stock_minimo ?? '') }}" required>
    </div>
    <div class="form-group">
      <label>Stock Máximo</label>
      <input type="number" name="stock_maximo" class="form-control"
        value="{{ old('stock_maximo', $producto->stock_maximo ?? '') }}">
    </div>
    <div class="form-group">
      <label>Stock</label>
      <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock ?? '') }}"
        required>
    </div>
    <div class="form-group">
      <label>Estado</label>
      <select name="status" class="form-control">
        <option value="1" {{ old('status', $producto->status ?? 1) ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ old('status', $producto->status ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success mt-3">{{ isset($producto) ? 'Actualizar' : 'Guardar' }}</button>
  </form>
</div>
@endsection