<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lubricentro')</title>

    <!-- Bootstrap 4.6 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Botón hamburguesa AdminLTE -->
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('build/img/logo_ssp150_trans.png') }}" alt="Lubricentro"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Lubricentro</span>
            </a>

            <div class="sidebar">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @include('layouts.navigation')
                </ul>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="content-wrapper p-3">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer py-4 mt-auto bg-light">
            <div class="container position-relative d-flex align-items-center">
                <small class="mx-auto text-center text-wrap">© 2025 Lubricentro - Todos los derechos reservados</small>
                <a class="afip position-absolute end-0" href="http://qr.afip.gob.ar" target="_blank">
                    <img src="https://www.afip.gob.ar/images/f960/DATAWEB.jpg" alt="QR AFIP"
                        class="logo-afip img-fluid">
                </a>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    @stack('scripts')
</body>

</html>
