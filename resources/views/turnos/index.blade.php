@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Turnos</h1>
        <a href="{{ route('turnos.create') }}" class="btn btn-primary mb-3">Crear Turno</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($turnos->isEmpty())
            <div class="alert alert-info">No hay turnos registrados.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @if (auth()->user()->role === 'admin')
                            <th>Cliente</th>
                        @endif
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Usuario</th>
                        <th>Vehículo</th>
                        <th>Tipos de Turno</th>
                        <th>Servicios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turnos as $turno)
                        <tr>
                            @if (auth()->user()->role === 'admin')
                                <td>{{ $turno->user->nombre ?? 'N/A' }}</td>
                            @endif
                            <td>{{ $turno->fecha }}</td>
                            <td>{{ $turno->hora_inicio }}</td>
                            <td>{{ $turno->hora_fin }}</td>
                            <td>{{ $turno->user->name ?? 'N/A' }}</td>
                            <td>{{ $turno->vehiculo->patente ?? 'N/A' }}</td>
                            <td>
                                {{-- @foreach ($turno->tipoTurnos as $tipo)
                                    {{ $tipo->nombre }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach --}}
                                @foreach ($turno->trabajos as $trabajo)
                                    {{ $trabajo->tipo_trabajo }}
                                @endforeach
                            </td>
                            <td>
                                <ul>
                                    @foreach ($turno->trabajos as $trabajo)
                                        {{ $trabajo->servicio->nombre ?? 'Servicio no asignado' }}
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('turnos.edit', $turno->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este turno?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
