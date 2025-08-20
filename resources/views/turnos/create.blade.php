@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Turno</h1>
        <form action="{{ route('turnos.store') }}" method="POST">
            @csrf

            {{-- Cliente solo para admin --}}
            @if (auth()->user()->role === 'admin')
                <div class="form-group">
                    <label>Cliente</label>
                    <select id="user_id" class="form-control" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @endif

            {{-- Vehículo --}}
            <div class="form-group">
                <label>Vehículo</label>
                <select name="vehiculo_id" id="vehiculo_id" class="form-control" required>
                    <option value="">Seleccione un vehículo</option>
                    @foreach ($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->patente }} - {{ $vehiculo->modelo }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">
                    Si no desea usar un vehículo existente, puede crear uno nuevo.
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#nuevoVehiculoModal">Nuevo Vehículo</button>
                </small>
            </div>

            {{-- Tipos de turno --}}
            <div class="form-group">
                <label>Tipos de turno</label>
                @foreach ($tiposTurno as $tipo)
                    <div class="form-check">
                        <input type="checkbox" name="trabajos[][tipo_trabajo]" value="{{ $tipo->nombre }}"
                            class="form-check-input">
                        <label class="form-check-label">{{ $tipo->nombre }}</label>
                    </div>
                @endforeach
            </div>

            {{-- Servicios --}}
            <div class="form-group">
                <label>Servicios</label>
                @foreach ($servicios as $servicio)
                    <div class="form-check">
                        <input type="checkbox" name="trabajos[][servicio_id][]" value="{{ $servicio->id }}"
                            class="form-check-input">
                        <label class="form-check-label">{{ $servicio->nombre }}</label>
                    </div>
                @endforeach
            </div>

            {{-- Fecha y hora --}}
            <div class="form-group">
                <label>Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Hora Inicio</label>
                <input type="time" name="hora_inicio" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Hora Fin</label>
                <input type="time" name="hora_fin" class="form-control" required>
            </div>

            {{-- Estado --}}
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

    {{-- Modal Nuevo Vehículo --}}
    <div class="modal fade" id="nuevoVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoVehiculoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="nuevoVehiculoForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Vehículo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Patente</label>
                            <input type="text" name="patente" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" name="marca" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Año</label>
                            <input type="number" name="anio" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control"></textarea>
                        </div>
                        <input type="hidden" name="user_id" id="vehiculo_user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="guardarVehiculoBtn" class="btn btn-primary">Guardar Vehículo</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // document.addEventListener("DOMContentLoaded", function() {

        //     // Filtrado de vehículos al cambiar cliente (solo admin)
        //     @if (auth()->user()->role === 'admin')
        //         let selectCliente = document.getElementById('user_id');
        //         let selectVehiculo = document.getElementById('vehiculo_id');

        //         selectCliente.addEventListener('change', function() {
        //             let userId = this.value;
        //             fetch(`/usuarios/${userId}/vehiculos`)
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     selectVehiculo.innerHTML =
        //                         '<option value="">Seleccione un vehículo</option>';
        //                     data.forEach(v => {
        //                         let option = document.createElement('option');
        //                         option.value = v.id;
        //                         option.text = v.patente + ' - ' + v.modelo;
        //                         selectVehiculo.appendChild(option);
        //                     });
        //                 });
        //         });
        //     @endif

        //     // Guardar vehículo desde modal
        //     let btnGuardar = document.getElementById('guardarVehiculoBtn');
        //     let form = document.getElementById('nuevoVehiculoForm');

        //     if (btnGuardar && form) {
        //         btnGuardar.addEventListener('click', function() {
        //             let formData = new FormData(form);
        //             fetch("{{ route('vehiculos.store.ajax') }}", {
        //                     method: "POST",
        //                     headers: {
        //                         "X-CSRF-TOKEN": "{{ csrf_token() }}",
        //                         "Accept": "application/json"
        //                     },
        //                     body: formData
        //                 })
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove(
        //                         'is-invalid'));
        //                     form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

        //                     if (data.success) {
        //                         $('#nuevoVehiculoModal').modal('hide');

        //                         let option = document.createElement('option');
        //                         option.value = data.vehiculo.id;
        //                         option.text = data.vehiculo.patente + ' - ' + data.vehiculo.modelo;
        //                         option.selected = true;
        //                         selectVehiculo.appendChild(option);

        //                         form.reset();
        //                     } else if (data.errors) {
        //                         for (const [field, messages] of Object.entries(data.errors)) {
        //                             let input = form.querySelector(`[name="${field}"]`);
        //                             if (input) {
        //                                 input.classList.add('is-invalid');
        //                                 let feedback = document.createElement('div');
        //                                 feedback.className = 'invalid-feedback';
        //                                 feedback.innerText = messages.join(', ');
        //                                 input.parentNode.appendChild(feedback);
        //                             }
        //                         }
        //                     } else {
        //                         alert("Error al guardar el vehículo.");
        //                     }
        //                 })
        //                 .catch(err => {
        //                     console.error(err);
        //                     alert("Hubo un problema al guardar el vehículo.");
        //                 });
        //         });
        //     }

        // });
        document.addEventListener("DOMContentLoaded", function() {
            let userSelect = document.getElementById('user_id');
            let vehiculoUserId = document.getElementById('vehiculo_user_id');

            // Actualizar el user_id del modal al cambiar el select
            if (userSelect) {
                userSelect.addEventListener('change', function() {
                    vehiculoUserId.value = this.value;

                    // Opcional: limpiar el select de vehículos del turno
                    let vehiculoSelect = document.getElementById('vehiculo_id');
                    vehiculoSelect.innerHTML = '<option value="">Seleccione un vehículo</option>';

                    // Aquí podrías hacer un fetch para traer los vehículos del usuario seleccionado
                    fetch(`/usuarios/${this.value}/vehiculos`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(v => {
                                let option = document.createElement('option');
                                option.value = v.id;
                                option.text = v.patente + ' - ' + v.modelo;
                                vehiculoSelect.appendChild(option);
                            });
                        });
                });

                // Inicializar el hidden con el primer valor del select si existe
                if (userSelect.value) {
                    vehiculoUserId.value = userSelect.value;
                }
            }

            // Guardar vehículo vía modal
            let btnGuardar = document.getElementById('guardarVehiculoBtn');
            let form = document.getElementById('nuevoVehiculoForm');

            btnGuardar.addEventListener('click', function() {
                let formData = new FormData(form);

                fetch("{{ route('vehiculos.store.ajax') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Limpiar errores previos
                        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove(
                            'is-invalid'));
                        form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                        if (data.success) {
                            $('#nuevoVehiculoModal').modal('hide');

                            // Agregar vehículo al select del turno y seleccionarlo
                            let option = document.createElement('option');
                            option.value = data.vehiculo.id;
                            option.text = data.vehiculo.patente + ' - ' + data.vehiculo.modelo;
                            option.selected = true;
                            document.getElementById('vehiculo_id').appendChild(option);

                            form.reset();
                        } else if (data.errors) {
                            for (const [field, messages] of Object.entries(data.errors)) {
                                let input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    input.classList.add('is-invalid');
                                    let feedback = document.createElement('div');
                                    feedback.className = 'invalid-feedback';
                                    feedback.innerText = messages.join(', ');
                                    input.parentNode.appendChild(feedback);
                                }
                            }
                        } else {
                            alert("Error al guardar el vehículo.");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Hubo un problema al guardar el vehículo.");
                    });
            });
        });
    </script>
@endsection
