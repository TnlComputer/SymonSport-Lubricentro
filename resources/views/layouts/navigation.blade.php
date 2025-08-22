<li>
    <a href="{{ url('/') }}" class="brand-link text-center">
        <img src="{{ asset('./build/img/logo_ssp150_trans.png') }}" alt="Lubricentro"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Lubricentro</span>
    </a>
</li>

@auth
    {{-- HOME --}}
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <span class="menu-text">Home</span>
        </a>
    </li>

    @if (auth()->user()->role === 'admin')
        {{-- GESTIÓN DE USUARIOS --}}
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <span class="menu-text">Gestión de Usuarios</span>
            </a>
        </li>

        {{-- TURNOS --}}
        <li class="nav-item">
            <a href="{{ route('turnos.index') }}" class="nav-link {{ request()->routeIs('turnos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <span class="menu-text">Turnos</span>
            </a>
        </li>

        {{-- VEHÍCULOS --}}
        <li class="nav-item">
            <a href="{{ route('vehiculos.index') }}"
                class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-car"></i>
                <span class="menu-text">Vehículos</span>
            </a>
        </li>

        {{-- CONFIGURACIÓN --}}
        @php
            $configActive =
                request()->routeIs('config.servicios.*') ||
                request()->routeIs('config.tipos-turno.*') ||
                request()->routeIs('config.productos.*');
        @endphp

        <li class="nav-item has-treeview {{ request()->routeIs('config.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('config.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <span class="menu-text">Configuración
                    <i class="right fas fa-angle-left"></i>
                </span>
            </a>
            <ul class="nav">
                <li class="nav-item">
                    <a href="{{ route('config.servicios.index') }}"
                        class="nav-link {{ request()->routeIs('config.servicios.*') ? 'active' : '' }}">
                        <i class="fas fa-wrench nav-icon"></i>
                        <span class="menu-text">Servicios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('config.tipos-turno.index') }}"
                        class="nav-link {{ request()->routeIs('config.tipos-turno.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <span class="menu-text">Tipos de Turno</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('config.productos.index') }}"
                        class="nav-link {{ request()->routeIs('config.productos.*') ? 'active' : '' }}">
                        <i class="fas fa-boxes nav-icon"></i>
                        <span class="menu-text">Productos</span>
                    </a>
                </li>
            </ul>
        </li>
    @else
        {{-- USUARIO NORMAL --}}
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <span class="menu-text">Perfil</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pedidos.index') }}" class="nav-link {{ request()->routeIs('pedidos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-box"></i>
                <span class="menu-text">Pedidos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('turnos.index') }}" class="nav-link {{ request()->routeIs('turnos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <span class="menu-text">Turnos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vehiculos.index') }}"
                class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-car"></i>
                <span class="menu-text">Vehículos</span>
            </a>
        </li>
    @endif

    <li class="nav-header"></li>

    {{-- CERRAR SESIÓN --}}
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
    {{-- INVITADO --}}
    <li class="nav-item">
        <a href="{{ route('contacto') }}" class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <span class="menu-text">Contacto</span>
        </a>
    </li>

    <li class="nav-header"></li>

    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link keep-text {{ request()->routeIs('login') ? 'active' : '' }}">
            <i class="nav-icon fas fa-sign-in-alt"></i>
            <span class="menu-text">Iniciar Sesión</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('register') }}" class="nav-link keep-text {{ request()->routeIs('register') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-plus"></i>
            <span class="menu-text">Registrarse</span>
        </a>
    </li>
@endauth
