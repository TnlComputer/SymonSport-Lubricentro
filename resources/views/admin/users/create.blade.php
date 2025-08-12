@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h1>Crear Usuario</h1>

  <form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <div class="mb-3">
      <label>Nombre</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      @error('email')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label>Rol</label>
      <select name="role" class="form-control" required>
        @foreach($roles as $role)
        <option value="{{ $role }}" @selected(old('role')==$role)>{{ ucfirst($role) }}</option>
        @endforeach
      </select>
      @error('role')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label>Contraseña</label>
      <input type="password" name="password" class="form-control" required>
      @error('password')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label>Confirmar Contraseña</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection