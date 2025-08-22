@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Productos</h1>

        <a href="{{ route('config.productos.create') }}" class="btn btn-primary mb-3">Alta Producto</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Stock Min</th>
                    <th>Stock Max</th>
                    <th>Stock Actual</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->costo }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock_min }}</td>
                        <td>{{ $producto->stock_max }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->activo ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('config.productos.edit', $producto->id) }}"
                                class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('config.productos.destroy', $producto->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Elininar producto?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($productos instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-3">{{ $productos->links() }}</div>
        @endif
    </div>
@endsection
