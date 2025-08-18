@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Crear Turno</h1>

  <form action="{{ route('turnos.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="cliente_id">Cliente</label>
      <select name="cliente_id" class="form-control">
        @foreach($clientes as $cliente)
        <option value="{{ $cliente->id }}"
          @if(isset($turno) && $turno->cliente_id == $cliente->id) selected @endif>
          {{ $cliente->name }}
        </option>
        @endforeach
      </select>
    </div>


    <div class="form-group">
      <label for="vehiculo_id">Vehículo</label>
      <select name="vehiculo_id" class="form-control">
        @foreach($vehiculos as $vehiculo)
        <option value="{{ $vehiculo->id }}"
          @if(isset($turno) && $turno->vehiculo_id == $vehiculo->id) selected @endif>
          {{ $vehiculo->patente }} - {{ $vehiculo->modelo ?? '' }}
        </option>
        @endforeach
      </select>
    </div>


    <div class="form-group">
      <label for="tipos_turno">Tipos de Turno</label>
      <select name="tipos_turno[]" id="tipos_turno" class="form-control" multiple>
        @foreach($tipoTurnos as $tipo)
        <option value="{{ $tipo->id }}"
          @if(isset($turno) && $turno->tiposTurno->contains($tipo->id)) selected @endif>
          {{ $tipo->nombre }}
        </option>
        @endforeach
      </select>
    </div>


    <div class="form-group">
      <label>Servicios</label><br>
      @foreach($servicios as $servicio)
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
          @if(isset($turno) && $turno->servicios->contains($servicio->id)) checked @endif>
        <label class="form-check-label">{{ $servicio->nombre }}</label>
      </div>
      @endforeach
    </div>

    <div class="form-group">
      <label>Fecha</label>
      <input type="date" name="fecha" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Hora</label>
      <input type="time" name="hora" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Estado</label>
      <select name="status" class="form-control">
        <option value="pendiente">Pendiente</option>
        <option value="confirmado">Confirmado</option>
        <option value="completado">Completado</option>
        <option value="cancelado">Cancelado</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar Turno</button>
    <a href="{{ route('turnos.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection