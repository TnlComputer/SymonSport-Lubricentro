@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Tipo de Turno</h1>

        <form action="{{ route('config.tipos-turno.update', $tipos_turno->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ old('nombre', $tipos_turno->nombre) }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            <a href="{{ route('config.tipos-turno.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
        </form>
    </div>
@endsection
