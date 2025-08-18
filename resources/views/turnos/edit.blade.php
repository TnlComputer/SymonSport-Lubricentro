@extends('layouts.app')

@section('title', 'Editar Turno')

@section('content_header')
<h1>Editar Turno</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('turnos.update', $turno) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Cliente --}}
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

      {{-- Vehículo --}}
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


      {{-- Tipo de turno (múltiple) --}}
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


      {{-- Fecha --}}
      <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $turno->fecha->format('Y-m-d') }}" required>
      </div>

      {{-- Hora --}}
      <div class="form-group">
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora" class="form-control" value="{{ $turno->hora }}" required>
      </div>

      {{-- Servicios (múltiple) --}}
      <div class="form-group">
        <label>Servicios</label><br>
        @foreach($servicios as $servicio)
        <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
          {{ in_array($servicio->id, $turno->servicios->pluck('id')->toArray()) ? 'checked' : '' }}>
        {{ $servicio->nombre }}
        @endforeach

      </div>

      {{-- Estado --}}
      <div class="form-group">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control">
          <option value="pendiente" {{ $turno->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
          <option value="confirmado" {{ $turno->status == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
          <option value="completado" {{ $turno->status == 'completado' ? 'selected' : '' }}>Completado</option>
          <option value="cancelado" {{ $turno->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Actualizar Turno</button>
    </form>
  </div>
</div>
@stop