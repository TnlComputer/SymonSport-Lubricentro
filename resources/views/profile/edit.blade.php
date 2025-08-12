@extends('layouts.app') {{-- Usa tu layout principal de AdminLTE --}}

@section('content')
<div class="container-fluid">
  <h2 class="mb-4">
    <i class="fas fa-user"></i> Perfil
  </h2>

  {{-- Formulario: Actualizar información --}}
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      Actualizar Información
    </div>
    <div class="card-body">
      @include('profile.partials.update-profile-information-form')
    </div>
  </div>

  {{-- Formulario: Cambiar contraseña --}}
  <div class="card mb-4">
    <div class="card-header bg-warning text-dark">
      Cambiar Contraseña
    </div>
    <div class="card-body">
      @include('profile.partials.update-password-form')
    </div>
  </div>

  {{-- Formulario: Eliminar usuario --}}
  <div class="card border-danger">
    <div class="card-header bg-danger text-white">
      Eliminar Cuenta
    </div>
    <div class="card-body">
      @include('profile.partials.delete-user-form')
    </div>
  </div>
</div>
@endsection