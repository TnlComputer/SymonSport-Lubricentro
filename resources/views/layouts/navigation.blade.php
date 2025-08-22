@auth
    {{-- HOME --}}
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
        </a>
    </li>

    @if (auth()->user()->role === 'admin')
        {{-- GESTIÓN DE USUARIOS --}}
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Gestión de Usuarios</p>
            </a>
        </li>

        {{-- TURNOS --}}
        <li class="nav-item">
            <a href="{{ route('turnos.index') }}" class="nav-link {{ request()->routeIs('turnos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Turnos</p>
            </a>
        </li>

        {{-- VEHÍCULOS --}}
        <li class="nav-item">
            <a href="{{ route('vehiculos.index') }}"
               class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-car"></i>
                <p>Vehículos</p>
            </a>
        </li>

        {{-- CONFIGURACIÓN --}}
        <li class="nav-item {{ request()->routeIs('config.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('config.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Configuración
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('config.servicios.index') }}"
                       class="nav-link {{ request()->routeIs('config.servicios.*') ? 'active' : '' }}">
                        <i class="fas fa-wrench nav-icon"></i>
                        <p>Servicios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('config.tipos-turno.index') }}"
                       class="nav-link {{ request()->routeIs('config.tipos-turno.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check nav-icon"></i>
                        <p>Tipos de Turno</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('config.productos.index') }}"
                       class="nav-link {{ request()->routeIs('config.productos.*') ? 'active' : '' }}">
                        <i class="fas fa-box-open nav-icon"></i>
                        <p>Productos</p>
                    </a>
                </li>
            </ul>
        </li>

    @else
        {{-- USUARIO NORMAL --}}
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Perfil</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pedidos.index') }}" class="nav-link {{ request()->routeIs('pedidos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-box"></i>
                <p>Pedidos</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('turnos.index') }}" class="nav-link {{ request()->routeIs('turnos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Turnos</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vehiculos.index') }}"
               class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-car"></i>
                <p>Vehículos</p>
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
                <p>Cerrar Sesión</p>
            </button>
        </form>
    </li>

@else
    {{-- INVITADO --}}
    <li class="nav-item">
        <a href="{{ route('contacto') }}" class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Contacto</p>
        </a>
    </li>

    <li class="nav-header"></li>

    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link keep-text {{ request()->routeIs('login') ? 'active' : '' }}">
            <i class="nav-icon fas fa-sign-in-alt"></i>
            <p>Iniciar Sesión</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('register') }}" class="nav-link keep-text {{ request()->routeIs('register') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>Registrarse</p>
        </a>
    </li>
@endauth
