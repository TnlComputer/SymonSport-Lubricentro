@extends('layouts.app')

@section('content')
    <h1>Vehículos</h1>
    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">Nuevo Vehículo</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Patente</th>
                <th>Observaciones</th>
                @if (auth()->user()->is_admin)
                    <th>Usuario</th>
                @endif
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                <tr @if (Auth::user()->is_admin && !$vehiculo->activo) style="color: red;" @endif>
                    <td>{{ $vehiculo->marca }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td>{{ $vehiculo->patente }}</td>
                    <td>{{ $vehiculo->observaciones }}</td>
                    @if (auth()->user()->is_admin)
                        <td>{{ $vehiculo->user->nombre ?? '' }}</td>
                    @endif
                    <td>
                        @if ($vehiculo->activo)
                            Activo
                        @else
                            Eliminado
                        @endif
                    </td>
                    <td>
                        @can('update', $vehiculo)
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-warning btn-sm">Editar</a>
                        @endcan
                        @can('delete', $vehiculo)
                            <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
