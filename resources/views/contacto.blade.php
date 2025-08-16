@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="card shadow-sm mb-4">
  <div class="card-body">
    <h2 class="card-title mb-3">Contacto</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contacto.enviar') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
        @error('nombre')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        @error('email')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea name="mensaje" id="mensaje" rows="4" class="form-control">{{ old('mensaje') }}</textarea>
        @error('mensaje')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane"></i> Enviar
      </button>
    </form>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <h2 class="card-title mb-3">Ubicación</h2>
    <div class="ratio ratio-16x9">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13137.427631225619!2d-58.5584971!3d-34.5951354!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x75e4ad7eb959e17f!2sSymon%20Sport!5e0!3m2!1ses!2sar!4v1653091380281!5m2!1ses!2sar"
        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</div>
<div class="mt-4">
  <div class="row text-center text-md-start">
    <div class="col-md-4 mb-3">
      <h6><i class="fas fa-home"></i> Dirección</h6>
      <p class="mb-0">Asamblea 4511, B1678EQC Caseros<br>Provincia de Buenos Aires</p>
    </div>
    <div class="col-md-4 mb-3">
      <h6><i class="fas fa-phone"></i> Teléfono</h6>
      <p class="mb-0">+54 11 6799 3863</p>
    </div>
    <div class="col-md-4 mb-3">
      <h6><i class="fas fa-envelope"></i> Email</h6>
      <p class="mb-0">info@symonsport.com</p>
    </div>
  </div>
</div>

@endsection