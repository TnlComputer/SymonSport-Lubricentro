@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h2>Home</h2>
<p>¡Hola, {{ auth()->user()->name ?? 'Invitado'}}! Bienvenido a tu panel de control.</p>

<hr>


@endsection