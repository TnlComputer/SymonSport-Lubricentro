<li>
    <a href="{{ route('home') }}" class="brand-link text-center">
        <img src="{{ asset('./build/img/logo_ssp150_trans.png') }}" alt="Lubricentro"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Lubricentro</span>
    </a>
</li>

@auth
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <span class="menu-text">Home</span>
        </a>
    </li>

    @if (auth()->user()->role === 'admin')
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <span class="menu-text">Gestión de Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('turnos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <span class="menu-text">Turnos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vehiculos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-car"></i>
                <span class="menu-text">Vehículos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.config.index') }}" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <span class="menu-text">Configuraciones</span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <span class="menu-text">Perfil</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pedidos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <span class="menu-text">Pedidos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('turnos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <span class="menu-text">Turnos</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('vehiculos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-car"></i>
                <span class="menu-text">Vehículos</span>
            </a>
        </li>
    @endif

    <li class="nav-header"></li>

    <!-- Botón Cerrar Sesión con texto siempre visible -->
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-start keep-text">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <span class="menu-text">Cerrar Sesión</span>
            </button>
        </form>
    </li>
@else
    <li class="nav-item">
        <a href="{{ route('contacto') }}" class="nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <span class="menu-text">Contacto</span>
        </a>
    </li>

    <li class="nav-header"></li>

    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link keep-text">
            <i class="nav-icon fas fa-sign-in-alt"></i>
            <span class="menu-text">Iniciar Sesión</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('register') }}" class="nav-link keep-text">
            <i class="nav-icon fas fa-user-plus"></i>
            <span class="menu-text">Registrarse</span>
        </a>
    </li>
@endauth
