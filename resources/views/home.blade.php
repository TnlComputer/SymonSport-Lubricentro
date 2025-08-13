@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h2>Home</h2>
<p>¡Hola, {{ auth()->user()->name ?? 'Invitado'}}! Bienvenido a tu panel de control.</p>

<hr>
@if(auth()->user()->role === 'user')
<p>Bienvenido {{ auth()->user()->name }} - User</p>
@else
<p>Bienvenido {{ auth()->user()->name }} - Admin</p>
<h3>Turnos del dia</h3>
<div>Lubricentro</div>
<div>Mecanica Ligera</div>
<h4>Stock Disponible</h4>
@endif
aca el resto
@endsection