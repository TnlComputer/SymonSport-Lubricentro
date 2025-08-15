@extends('layouts.app')

@section('content')
<h1>Listado de Turnos</h1>
<a href="{{ route('turnos.create') }}" class="btn btn-primary">Nuevo Turno</a>
<table class="table table-bordered mt-3">
  <thead>
    <tr>
      <th>Cliente</th>
      <th>Tipo de Turno</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Duración</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($turnos as $turno)
    <tr>
      <td>{{ $turno->cliente->name }}</td>
      <td>{{ ucfirst($turno->tipo_turno) }}</td>
      <td>{{ $turno->fecha }}</td>
      <td>{{ $turno->hora }}</td>
      <td>{{ $turno->duracion }} min</td>
      <td>{{ ucfirst($turno->status) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection