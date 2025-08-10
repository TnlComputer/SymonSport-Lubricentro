@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
<h2>{{ $producto->nombre }}</h2>
<img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid mb-3"
  style="max-width:300px;">
<p>{{ $producto->descripcion }}</p>
<p><strong>Precio: </strong>$ {{ number_format($producto->precio, 2) }}</p>

<a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver a productos</a>
@endsection