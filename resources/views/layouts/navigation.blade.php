<!-- resources/views/layouts/navigation.blade.php -->
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

  @auth
  {{-- Menú común para todos los usuarios logueados --}}
  <li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
      <i class="nav-icon fas fa-home"></i>
      <p>Home</p>
    </a>
  </li>

  <!-- {{-- Enlace al perfil (visible para todos los usuarios autenticados) --}}
  <li class="nav-item">
    <a href="{{ route('profile.edit') }}" class="nav-link">
      <i class="nav-icon fas fa-user"></i>
      <p>Mi Perfil</p>
    </a>
  </li> -->

  @if(auth()->user()->role === 'admin')
  {{-- Opciones SOLO para ADMIN --}}
  <li class="nav-item">
    <a href="{{ route('admin.users.index') }}" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>Gestión de Usuarios</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('admin.config') }}" class="nav-link">
      <i class="nav-icon fas fa-cogs"></i>
      <p>Configuraciones</p>
    </a>
  </li>
  @else
  {{-- Opciones para usuarios normales --}}
  <li class="nav-item">
    <a href="{{ route('profile.edit') }}" class="nav-link">
      <i class="nav-icon fas fa-user"></i>
      <p>Mi Perfil</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('pedidos.index') }}" class="nav-link">
      <i class="nav-icon fas fa-shopping-cart"></i>
      <p>Mis Pedidos</p>
    </a>
  </li>
  @endif

  {{-- Separador --}}
  <li class="nav-header"></li>

  {{-- Botón Cerrar Sesión --}}
  <li class="nav-item mt-auto">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="nav-link btn btn-link text-start">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Cerrar Sesión</p>
      </button>
    </form>
  </li>

  @else
  {{-- Menú público --}}
  <li class="nav-item">
    <a href="{{ route('contacto') }}" class="nav-link">
      <i class="nav-icon fas fa-envelope"></i>
      <p>Contacto</p>
    </a>
  </li>

  {{-- Separador --}}
  <li class="nav-header"></li>

  {{-- Botones de autenticación --}}
  <li class="nav-item mt-auto">
    <a href="{{ route('login') }}" class="nav-link">
      <i class="nav-icon fas fa-sign-in-alt"></i>
      <p>Iniciar Sesión</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('register') }}" class="nav-link">
      <i class="nav-icon fas fa-user-plus"></i>
      <p>Registrarse</p>
    </a>
  </li>
  @endauth

</ul>