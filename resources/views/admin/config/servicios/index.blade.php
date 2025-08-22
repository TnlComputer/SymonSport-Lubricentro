@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Servicios</h1>

        <a href="{{ route('config.servicios.create') }}" class="btn btn-primary mb-3">Alta Servicio</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->nombre }}</td>
                        <td>
                            <a href="{{ route('config.servicios.edit', $servicio->id) }}"
                                class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('config.servicios.destroy', $servicio->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($servicios instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-3">{{ $servicios->links() }}</div>
        @endif
    </div>
@endsection
