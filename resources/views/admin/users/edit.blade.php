@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h1>Editar Usuario</h1>

  <form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Nombre</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
      @error('name')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
      @error('email')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label>Rol</label>
      <select name="role" class="form-control" required>
        @foreach($roles as $role)
        <option value="{{ $role }}" @selected(old('role', $user->role) == $role)>{{ ucfirst($role) }}</option>
        @endforeach
      </select>
      @error('role')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label>Contraseña (dejar vacío para no cambiar)</label>
      <input type="password" name="password" class="form-control" autocomplete="new-password">
      @error('password')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label>Confirmar Contraseña</label>
      <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection