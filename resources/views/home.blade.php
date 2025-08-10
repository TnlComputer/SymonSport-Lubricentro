{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container">
  <h1 class="mb-4">Bienvenido a Lubricentro</h1>

  @auth
  <div class="alert alert-success">
    Hola <strong>{{ auth()->user()->name }}</strong>, nos alegra verte de nuevo.
  </div>

  <p>Desde aquí puedes acceder rápidamente a tus secciones principales:</p>

  <div class="row">
    @if(auth()->user()->role === 'admin')
    <div class="col-md-4 mb-3">
      <a href="{{ route('admin.users.index') }}" class="card text-center h-100 text-decoration-none text-dark">
        <div class="card-body">
          <i class="fas fa-users fa-2x mb-2"></i>
          <h5>Gestión de Usuarios</h5>
        </div>
      </a>
    </div>
    @endif

    <div class="col-md-4 mb-3">
      <a href="{{ route('profile') }}" class="card text-center h-100 text-decoration-none text-dark">
        <div class="card-body">
          <i class="fas fa-user fa-2x mb-2"></i>
          <h5>Mi Perfil</h5>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="{{ route('contacto') }}" class="card text-center h-100 text-decoration-none text-dark">
        <div class="card-body">
          <i class="fas fa-envelope fa-2x mb-2"></i>
          <h5>Contacto</h5>
        </div>
      </a>
    </div>
  </div>

  @else
  <div class="alert alert-info">
    Bienvenido, visitante. Por favor <a href="{{ route('login') }}">inicia sesión</a> o
    <a href="{{ route('register') }}">regístrate</a> para acceder a todas las funciones.
  </div>

  <p>Desde aquí puedes:</p>
  <ul>
    <li>Conocer más sobre nuestros productos y servicios.</li>
    <li>Contactarnos mediante el formulario de contacto.</li>
    <li>Crear una cuenta para gestionar tus pedidos.</li>
  </ul>
  @endauth
</div>
@endsection