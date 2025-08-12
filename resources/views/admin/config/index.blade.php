@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <h1>Configuracion</h1>
  <a href="{{ route('admin.config.create') }}" class="btn btn-success mb-3">Crear Configuracion</a>

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif


</div>
@endsection