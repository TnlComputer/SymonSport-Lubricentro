@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>Dashboard</h2>
<p>¡Hola, {{ auth()->user()->name }}! Bienvenido a tu panel de control.</p>

<hr>


@endsection