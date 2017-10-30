<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">

    <!-- Branding Image -->
    <h1>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Corcel') }}
        </a>
    </h1>

    <!-- Center Side Of Navbar -->
    @if (isset($navLinks))
        <ul class="nav nav-pills ml-1">
            @foreach ($navLinks as $link => $text)
                <li class="nav-item">
                    <a class="nav-link" href="{{ $link }}">
                        {{ $text }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Right Side Of Navbar -->
    <ul class="nav nav-pills ml-auto">

        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    Entrar
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    Registrarse
                </a>
            </li>
        @else
            <li class="nav-item dropdown mr-4">
                <a class="dropdown-toggle" href="#" data-togle="dropdown">
                    Notificaciones <span class="caret"></span>
                </a>

                <notifications :user="{{ Auth::user()->id }}"></notifications>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @endguest

        <li class="nav-item">
            <form action="/message/search" method="POST">
                {{ csrf_field() }}

                <div class="input-group">
                    <input class="form-control" type="text" name="query" placeholder="Buscar..." required />

                    <span class="input-group-btn">
                        <button class="btn btn-outline-success">
                            Buscar
                        </button>
                    </span>
                </div>
            </form>
        </li>
    </ul>
</nav>
