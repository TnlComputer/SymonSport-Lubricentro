@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container my-3">
        <h2 class="text-primary mb-3">
            <i class="fas fa-home"></i><strong> Home </strong>
        </h2>

        <div class="alert alert-info">
            <strong>¡Hola {{ auth()->user()->nombre ?? 'Invitado' }}!</strong>
            Bienvenido a tu panel de control.
        </div>

        {{-- Turnos del usuario o admin --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                @if (auth()->user()->role === 'admin')
                    <h5 class="card-title text-danger">
                        <i class="fas fa-user-shield"></i> Perfil Administrador
                    </h5>
                @endif
                <h6 class="mb-3 mt-5">Turnos - {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y') }}</h6>
                @if (isset($turnosFuturos) && $turnosFuturos->isEmpty())
                    <p>{{ $mensaje ?? 'No tienes turnos próximos.' }}</p>
                @elseif(isset($turnosFuturos))
                    <div class="row">
                        @foreach ($turnosFuturos->sortBy(['fecha', 'hora_inicio']) as $turno)
                            <div class="col-md-4 mb-3">
                                <div class="card {{ $turno->fecha->isToday() ? 'bg-warning text-dark' : '' }}">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ $turno->tipoTurnos->pluck('nombre')->join(', ') }}
                                        </h5>
                                        <p class="card-text">
                                            @if (auth()->user()->role === 'admin')
                                                <strong>Cliente:</strong>
                                                {{ $turno->user->nombre ?? ($turno->user->name ?? 'N/A') }}<br>
                                            @endif
                                            <strong>Fecha:</strong>
                                            {{ \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y') }}<br>
                                            <strong>Hora:</strong> {{ $turno->hora_inicio }} - {{ $turno->hora_fin }}<br>
                                            <strong>Servicios:</strong>
                                            {{ $turno->servicios->pluck('nombre')->join(', ') }}<br>
                                            <strong>Vehículo:</strong> {{ $turno->vehiculo->patente ?? '-' }}
                                        </p>
                                        <span class="badge badge-info">{{ ucfirst($turno->status) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
