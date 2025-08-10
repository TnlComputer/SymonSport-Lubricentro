<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>Dashboard</h2>
<p>¡Hola, {{ auth()->user()->name }}! Bienvenido a tu panel de control.</p>

<hr>

<nav>
  <ul class="list-unstyled">
    <li><a href="{{ route('productos.index') }}">Productos</a></li>
    <li><a href="{{ route('contacto') }}">Contacto</a></li>
    <li>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-link p-0" type="submit">Cerrar sesión</button>
      </form>
    </li>
  </ul>
</nav>
@endsection