@extends('layouts.app')

@section('title', 'home')

@section('content')
<h2>home</h2>
<p>¡Hola, {{ auth()->user()->name ?? 'Invitado'}}! Bienvenido a tu panel de control.</p>

<hr>


@endsection