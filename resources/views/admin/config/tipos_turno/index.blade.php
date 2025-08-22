@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tipos de Turno</h1>
        <a href="{{ route('config.tipos-turno.create') }}" class="btn btn-success mb-3">Nuevo Tipo de Turno</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tiposTurno as $tipo)
                    <tr>
                        <td>{{ $tipo->nombre }}</td>
                        <td>
                            <a href="{{ route('config.tipos-turno.edit', $tipo) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('config.tipos-turno.destroy', $tipo) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar tipo de turno?')">Borrar</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($tiposTurno instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $tiposTurno->links() }}
        @endif
    </div>
@endsection
