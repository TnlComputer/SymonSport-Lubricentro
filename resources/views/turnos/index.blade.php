@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Turnos</h1>

        <a href="{{ route('turnos.create') }}" class="btn btn-primary mb-3">Crear Turno</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Tipo de Turno</th>
                    <th>Servicios</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Duración Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ $turno->usuario?->nombre ?? 'Sin cliente' }}</td>
                        <td>{{ $turno->vehiculo?->patente ?? '-' }}</td>


                        <td>{{ $turno->vehiculo->patente ?? '-' }}</td>
                        <td>
                            @forelse($turno->tiposTurno ?? [] as $tipo)
                                @php
                                    $color = match ($tipo->nombre) {
                                        'Mecánica Ligera' => 'primary',
                                        'Mecánica Pesada' => 'danger',
                                        'Revisión' => 'success',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge badge-{{ $color }}">{{ $tipo->nombre }}</span>
                            @empty
                                <span>-</span>
                            @endforelse

                        </td>
                        <td>
                            @forelse($turno->servicios ?? [] as $servicio)
                                <span class="badge badge-info">{{ collect($turno->servicios ?? [])->sum('duracion') }} min
                                </span>
                            @empty
                                <span>-</span>
                            @endforelse

                        </td>
                        <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $turno->hora }}</td>
                        {{-- Duración calculada: suma de los servicios --}}
                        <td>
                            {{ $turno->servicios->sum('duracion') }} min
                        </td>
                        <td>{{ ucfirst($turno->status) }}</td>
                        <td>
                            <a href="{{ route('turnos.edit', $turno->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar turno?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
