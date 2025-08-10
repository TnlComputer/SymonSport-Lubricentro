<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Lubricentro')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Agrega tus estilos CSS propios o de AdminLTE aquí -->
  {{-- FontAwesome para iconos --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  {{-- AdminLTE 3 (compatible con Bootstrap 4, pero se adapta bien con 5 para layout) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      {{-- Logo o título --}}
      <a href="{{ route('home') }}" class="brand-link d-flex justify-content-center align-items-center">
        <img src="{{ asset('./build/img/logo_ssp150_trans.png') }}" class="img-fluid rounded-top" alt="Lubricentro"
          style="max-height: 50px;">Lubricentro
      </a>


      {{-- Menú --}}
      <div class="sidebar">
        @include('layouts.navigation')
      </div>
    </aside>

    {{-- Contenido principal --}}
    <div class="content-wrapper p-3">
      @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="main-footer text-center py-3 mt-auto">
      <small>© 2025 Lubricentro - Todos los derechos reservados</small>
    </footer>

  </div>

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>