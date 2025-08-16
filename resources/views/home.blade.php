@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container my-3">
  <h2 class="mb-3 text-primary">
    <i class="fas fa-home"></i><strong> Home </strong>
  </h2>

  <div class="alert alert-info">
    <strong>¡Hola {{ auth()->user()->name ?? 'Invitado' }}!</strong>
    Bienvenido a tu panel de control.
  </div>

  @if(auth()->user()->role === 'user')
  {{-- PERFIL USUARIO --}}
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title text-success">
        <i class="fas fa-user"></i> Perfil Usuario
      </h5>

      {{-- Mensaje de próximo turno --}}
      @if($proximoTurno)
      <div class="alert alert-success">
        <i class="fas fa-calendar-check"></i>
        Tu próximo turno es el
        <strong>{{ \Carbon\Carbon::parse($proximoTurno->fecha)->format('d/m/Y H:i') }}</strong>
      </div>
      @else
      <div class="alert alert-warning">
        <i class="fas fa-exclamation-circle"></i>
        No tienes turnos agendados sin realizar.
      </div>
      @endif

      {{-- Calendario --}}
      <div id="calendar"></div>

      <h6 class="mt-3 mb-2">Historial de Servicios</h6>
      @if(auth()->user()->servicios->isEmpty())
      <p class="text-muted">Aún no tienes ningún servicio realizado.</p>
      @else
      <ul class="list-group">
        @foreach(auth()->user()->servicios as $servicio)
        <li class="list-group-item">
          {{ $servicio->descripcion ?? $servicio->nombre ?? 'Servicio sin descripción' }}
          - {{ \Carbon\Carbon::parse($servicio->fecha)->format('d/m/Y') }}
        </li>
        @endforeach
      </ul>
      @endif
    </div>
  </div>

  @else
  {{-- PERFIL ADMIN --}}
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <h5 class="card-title text-danger">
        <i class="fas fa-user-shield"></i> Perfil Administrador
      </h5>

      <h6 class="mt-5 mb-3"><i class="fas fa-calendar-week"></i> Calendario de la semana</h6>

      <div class="row">
        @foreach($diasSemana as $dia)
        @php
        $turnosDelDia = $turnosSemana->filter(function($turno) use ($dia) {
        return \Carbon\Carbon::parse($turno->fecha)->isSameDay($dia);
        });
        @endphp
        <div class="col-md-3 mb-3">
          @if(!empty($mensaje ?? null))
          <div class="alert alert-info">{{ $mensaje }}</div>
          @endif
          <div class="card border-info h-100">
            <div class="card-header bg-info text-white">
              {{ $dia->format('D d/m') }}
            </div>
            <ul class="list-group list-group-flush">
              @forelse($turnosDelDia as $turno)
              <li class="list-group-item">
                {{ \Carbon\Carbon::parse($turno->fecha)->format('H:i') }}
                - {{ $turno->cliente->name ?? 'Invitado' }}
              </li>
              @empty
              <li class="list-group-item text-muted">No hay turnos</li>
              @endforelse
            </ul>
          </div>
        </div>
        @endforeach
      </div>

      <h6 class="mt-4"><i class="fas fa-boxes"></i> Stock Disponible</h6>
      <p class="text-muted">[Datos de stock aquí]</p>
    </div>
  </div>
  @endif
</div>
@endsection