@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Nuevo Vehículo</h1>

  <form action="{{ route('vehiculos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Marca</label>
      <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
      @error('marca')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Modelo</label>
      <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}">
      @error('modelo')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Patente</label>
      <input type="text" name="patente" class="form-control" value="{{ old('patente') }}">
      @error('patente')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Año</label>
      <input type="number" name="anio" class="form-control" value="{{ old('anio') }}">
      @error('anio')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Kilometraje</label>
      <input type="number" name="kilometraje" class="form-control"
        value="{{ old('kilometraje', $vehiculo->kilometraje ?? 0) }}">
      @error('kilometraje')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection