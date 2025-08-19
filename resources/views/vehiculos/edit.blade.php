@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Vehículo</h1>

        <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Solo admin puede cambiar el usuario asignado --}}
            @if (Auth::user()->role === 'admin')
                <div class="mb-3">
                    <label for="user_id" class="form-label">Asignar a usuario</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($usuarios as $u)
                            <option value="{{ $u->id }}"
                                {{ old('user_id', $vehiculo->user_id) == $u->id ? 'selected' : '' }}>
                                {{ $u->nombre }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}">
                @error('marca')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}">
                @error('modelo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Patente</label>
                <input type="text" name="patente" class="form-control" value="{{ old('patente', $vehiculo->patente) }}">
                @error('patente')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Año</label>
                <input type="number" name="anio" class="form-control" value="{{ old('anio', $vehiculo->anio) }}">
                @error('anio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <input type="text" name="observaciones" class="form-control"
                    value="{{ old('observaciones', $vehiculo->observaciones) }}">
                @error('observaciones')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
