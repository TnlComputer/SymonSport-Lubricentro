@extends('layouts.app')

@section('title', 'Bienvenido a Lubricentro')

@section('content')
    <div class="container text-center my-5">
        <h1 class="display-4 font-weight-bold text-primary mb-3">
            Bienvenido a <span class="text-dark">Symon Sport Lubricentro</span>
        </h1>
        <p class="lead text-muted mb-4">
            Tu mejor aliado en lubricantes y mantenimiento automotor.
        </p>

        <!-- Galería de imágenes -->
        <div class="container my-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('build/img/foto9.jpg') }}" alt="Lubricentro Symon Sport"
                        class="img-fluid rounded shadow-lg uniform-img">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('build/img/foto8.jpg') }}" alt="Lubricentro Symon Sport"
                        class="img-fluid rounded shadow-lg uniform-img">
                </div>
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('build/img/foto4.jpg') }}" alt="Lubricentro Symon Sport"
                        class="img-fluid rounded shadow-lg uniform-img">
                </div>
            </div>
        </div>


        @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2 shadow-sm">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg mx-2 shadow-sm">
                <i class="fas fa-user-plus"></i> Registrarse
            </a>
        @else
            <a href="{{ route('home') }}" class="btn btn-success btn-lg shadow-sm">
                <i class="fas fa-home"></i> Ir al Home
            </a>
        @endguest
    </div>
@endsection
