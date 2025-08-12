@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h1>Usuarios</h1>
  <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Crear Usuario</a>

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>
          <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Editar</a>
          <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block"
            onsubmit="return confirm('¿Eliminar usuario?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Borrar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $users->links() }}
</div>
@endsection