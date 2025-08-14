@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container my-4">
  <h2 class="mb-3 text-primary">
    <i class="fas fa-home"></i><strong> Home </strong>
  </h2>

  <div class="alert alert-info">
    <strong>¡Hola {{ auth()->user()->name ?? 'Invitado' }}!</strong>
    Bienvenido a tu panel de control.
  </div>

  <hr>

  @if(auth()->user()->role === 'user')
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title text-success">
        <i class="fas fa-user"></i> Perfil Usuario
      </h5>

      <hr>

      <p class="mt-5 mb-4">Próximo turno: <span class="text-muted">[Aquí iría la fecha]</span></p>

      <h6 class="mt-3 mb-2">Historial de Servicios</h6>
      <ul class="list-group">
        <li class="list-group-item">Trabajos realizados en Lubricentro</li>
        <li class="list-group-item">Trabajos realizados en Mecánica Ligera</li>
      </ul>
    </div>
  </div>

  @else
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title text-danger">
        <i class="fas fa-user-shield"></i> Perfil Administrador
      </h5>


      <h6 class="mt-5 mb-3"><i class="fas fa-calendar-day"></i> Turnos del día</h6>


      <ul class="list-group mb-3">
        <li class="list-group-item">Lubricentro</li>
        <li class="list-group-item">Mecánica Ligera</li>
      </ul>

      <h6><i class="fas fa-boxes"></i> Stock Disponible</h6>
      <p class="text-muted">[Datos de stock aquí]</p>
    </div>
  </div>
  @endif
</div>
@endsection