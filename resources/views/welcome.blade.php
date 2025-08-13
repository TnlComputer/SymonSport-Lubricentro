@extends('layouts.app')

@section('title', 'Bienvenido a Lubricentro')

@section('content')
<div class="text-center">
  <h1 class="mt-4">Bienvenido a Lubricentro</h1>
  <p class="lead">Tu mejor aliado en lubricantes y mantenimiento automotor.</p>
  <div class="p-4 flex justify-center">
    <img src="{{ asset('build/img/foto1.jpg') }}" alt="Libricentro">
  </div>

  @guest
  <a href="{{ route('login') }}" class="btn btn-primary mx-2">Iniciar Sesión</a>
  <a href="{{ route('register') }}" class="btn btn-outline-primary mx-2">Registrarse</a>
  @else
  <a href="{{ route('home') }}" class="btn btn-success">Ir al Home</a>
  @endguest
</div>
@endsection