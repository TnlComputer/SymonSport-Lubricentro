@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<h2>Contacto</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('contacto.enviar') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
    @error('nombre')
    <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Correo electrónico</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
    @error('email')
    <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="mensaje" class="form-label">Mensaje</label>
    <textarea name="mensaje" id="mensaje" rows="4" class="form-control">{{ old('mensaje') }}</textarea>
    @error('mensaje')
    <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
@endsection