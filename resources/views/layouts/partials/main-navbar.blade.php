<nav class="navbar navbar-expand-md navbar-meliar bg-meliar shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
                <ul class="navbar-nav mr-auto">
                    @can('index.revervations')
                        <li><a
                            class="nav-link @if(request()->is('home')) active @endif"
                            href="{{ route('home') }}"><i class="fas fa-calendar-week"></i> Sábana</a></li>
                    @endcan

                    @can('index.suites')
                        <li><a
                            class="nav-link @if(request()->routeIs('suites')) active @endif"
                            href="{{ route('suites') }}"><i class="fas fa-door-closed"></i> Habitaciones</a></li>
                    @endcan

                    @can('log.index')
                        <li><a
                            class="nav-link @if(request()->RouteIs('log')) active @endif"
                            href="{{ route('log') }}"><i class="fas fa-list-ul"></i> Historial</a></li>
                    @endcan

                    @can('index.users')
                        <li><a
                            class="nav-link @if(request()->routeIs('users')) active @endif"
                            href="{{ route('users') }}"><i class="fas fa-users"></i> Usuarios</a></li>
                    @endcan

                    @if(auth()->user()->hasRole('admin'))
                        <li><a
                            class="nav-link @if(request()->routeIs('dashboard')) active @endif"
                            href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Panel de Control</a></li>
                    @endif
                </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (!request()->routeIs('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        
                    @elseif (!request()->routeIs('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user-circle fa-lg mr-1"></i> {{ auth()->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">Mi Perfil</a>

                            @if (auth()->user()->has('reservations')->count())
                                <a class="dropdown-item" href="{{ route('auth.reservations') }}">Reservaciones</a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>