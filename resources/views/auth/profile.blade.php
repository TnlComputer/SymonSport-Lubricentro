@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<h1>Perfil de Usuario</h1>
<p>Bienvenido, {{ auth()->user()->name }}</p>
@endsection