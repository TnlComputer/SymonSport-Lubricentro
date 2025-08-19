@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Turno</h1>

        <form action="{{ route('turnos.store') }}" method="POST">
            @csrf

            {{-- Si es admin --}}
            @if (auth()->user()->role === 'admin')
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    <select name="user_id" id="cliente_id" class="form-control" required>
                        <option value="">-- Selecciona un cliente --</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="vehiculos-container">
                    <label for="vehiculo_id">Vehículo</label>
                    <select name="vehiculo_id" id="vehiculo_id" class="form-control" required>
                        <option value="">Seleccione un vehículo</option>
                        {{-- Se llenará por AJAX al elegir cliente --}}
                    </select>

                    <div id="vehiculo-mensaje" class="mt-2"></div>

                    {{-- 🔹 Botón fijo, siempre visible --}}
                    <a href="{{ route('vehiculos.create') }}" class="btn btn-link mt-2" target="_blank">
                        + Agregar vehículo
                    </a>
                </div>
            @else
                {{-- Si es cliente --}}
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="form-group">
                    <label for="vehiculo_id">Tu Vehículo</label>
                    @if ($vehiculos->isEmpty())
                        <p>No tienes vehículos registrados.</p>
                    @else
                        <select name="vehiculo_id" id="vehiculo_id" class="form-control" required>
                            <option value="">Seleccione un vehículo</option>
                            @foreach ($vehiculos as $vehiculo)
                                <option value="{{ $vehiculo->id }}">{{ $vehiculo->patente ?? $vehiculo->modelo }}</option>
                            @endforeach
                        </select>
                    @endif

                    {{-- 🔹 Siempre mostrar la opción para agregar otro --}}
                    <a href="{{ route('vehiculos.create') }}" class="btn btn-link mt-2" target="_blank">
                        + Agregar otro vehículo
                    </a>
                </div>

            @endif

            {{-- Tipos de turno --}}
            <div class="form-group">
                <label for="tipos_turno">Tipos de Turno</label>
                <select name="tipos_turno[]" id="tipos_turno" class="form-control" multiple required>
                    @foreach ($tipoTurnos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Servicios --}}
            <div class="form-group">
                <label>Servicios</label><br>
                @foreach ($servicios as $servicio)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}">
                        <label class="form-check-label">{{ $servicio->nombre }}</label>
                    </div>
                @endforeach
            </div>

            {{-- Fecha y hora --}}
            <div class="form-group">
                <label>Fecha</label>
                <input type="date" name="fecha_hora" class="form-control" required>
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

    @if (auth()->user()->role === 'admin')
        <script>
            document.getElementById('cliente_id').addEventListener('change', function() {
                let clienteId = this.value;
                let vehiculoSelect = document.getElementById('vehiculo_id');
                let mensajeDiv = document.getElementById('vehiculo-mensaje');

                vehiculoSelect.innerHTML = '<option value="">Seleccione un vehículo</option>';
                mensajeDiv.innerHTML = '';

                if (clienteId) {
                    fetch(`/usuarios/${clienteId}/vehiculos`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length === 0) {
                                mensajeDiv.innerHTML = `
                            <p>El cliente no tiene vehículos registrados.
                            <a href="/vehiculos/create" class="btn btn-primary btn-sm">Registrar vehículo</a></p>
                        `;
                            } else {
                                data.forEach(v => {
                                    let opt = document.createElement('option');
                                    opt.value = v.id;
                                    opt.text = v.patente + ' - ' + v.modelo;
                                    vehiculoSelect.appendChild(opt);
                                });
                            }
                        });
                }
            });
        </script>
    @endif
@endsection
