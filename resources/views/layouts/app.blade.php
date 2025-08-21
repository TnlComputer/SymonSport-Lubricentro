<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Lubricentro')</title>

    <!-- Bootstrap 4.6 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- AdminLTE 3.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Tus estilos -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            {{-- <a href="{{ url('/') }}" class="brand-link text-center">
                <span class="brand-text font-weight-light">Lubricentro</span>
            </a> --}}
            <div class="sidebar">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                    @include('layouts.navigation')
                </ul>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="content-wrapper p-3">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer py-3 mt-auto bg-light">
            <div class="container position-relative d-flex align-items-center">
                <!-- Texto centrado -->
                <small class="mx-auto text-center">
                    © 2025 Lubricentro - Todos los derechos reservados
                </small>

                <!-- QR a la derecha -->
                <a class="afip position-absolute end-0" href="http://qr.afip.gob.ar/?qr=FQNxsrMFMu2Jj0XuTMYpsQ,,"
                    target="_F960AFIPInfo">
                    <img src="https://www.afip.gob.ar/images/f960/DATAWEB.jpg" alt="QR AFIP"
                        class="logo-afip img-fluid">
                </a>
            </div>
        </footer>
    </div>

    <!-- Scripts en el orden correcto -->
    <!-- jQuery (necesario para AdminLTE 3) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap 4.6 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE 3.2 -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Scripts propios -->
    @stack('scripts')
</body>

</html>
