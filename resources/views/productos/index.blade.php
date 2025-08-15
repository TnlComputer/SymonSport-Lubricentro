@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Productos</h1>
  <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Nuevo Producto</a>

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Artículo</th>
        <th>Descripción</th>
        <th>Costo</th>
        <th>Venta</th>
        <th>Proveedor</th>
        <th>Stock</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $producto)
      <tr>
        <td>{{ $producto->articulo }}</td>
        <td>{{ $producto->descripcion }}</td>
        <td>{{ $producto->costo }}</td>
        <td>{{ $producto->venta }}</td>
        <td>{{ $producto->proveedor }}</td>
        <td>{{ $producto->stock }}</td>
        <td>{{ $producto->status ? 'Activo' : 'Inactivo' }}</td>
        <td>
          <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
          <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
              onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $productos->links() }}
</div>
@endsection