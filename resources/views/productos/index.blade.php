@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<h2>Productos</h2>

@if($productos->isEmpty())
<p>No hay productos disponibles.</p>
@else
<div class="row">
  @foreach($productos as $producto)
  <div class="col-md-4 mb-3">
    <div class="card h-100">
      <img src="{{ asset('storage/'.$producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
      <div class="card-body">
        <h5 class="card-title">{{ $producto->nombre }}</h5>
        <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
        <a href="{{ route('productos.show', $producto) }}" class="btn btn-primary">Ver detalle</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif

@endsection