@extends('layouts.app')

@section('content')
<h1>Crear Turno</h1>
<form action="{{ route('turnos.store') }}" method="POST">
  @csrf
  <div class="form-group">
    <label>Cliente</label>
    <select name="cliente_id" class="form-control">
      @foreach($clientes as $cliente)
      <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label>Tipo de Turno</label>
    <select name="tipo_turno" class="form-control">
      <option value="lubricentro">Lubricentro</option>
      <option value="mecanica ligera">Mecánica Ligera</option>
      <option value="mecanica pesada">Mecánica Pesada</option>
    </select>
  </div>

  <div class="form-group">
    <label>Servicio</label>
    <select name="servicio_id" class="form-control">
      @foreach($servicios as $servicio)
      <option value="{{ $servicio->id }}">{{ $servicio->nombre }} ({{ $servicio->duracion }} min)</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label>Fecha</label>
    <input type="date" name="fecha" class="form-control">
  </div>

  <div class="form-group">
    <label>Hora</label>
    <input type="time" name="hora" class="form-control">
  </div>

  <div class="form-group">
    <label>Status</label>
    <select name="status" class="form-control">
      <option value="pendiente">Pendiente</option>
      <option value="confirmado">Confirmado</option>
      <option value="completado">Completado</option>
      <option value="cancelado">Cancelado</option>
    </select>
  </div>

  <button class="btn btn-success">Guardar</button>
</form>
@endsection