<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">

    <!-- Branding Image -->
    <h1>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Corcel') }}
        </a>
    </h1>

    <!-- Center Side Of Navbar -->
    <ul class="nav nav-pills ml-1">
        @foreach ($navLinks as $link => $text)
            <li class="nav-item">
                <a class="nav-link" href="{{ $link }}">
                    {{ $text }}
                </a>
            </li>
        @endforeach
    </ul>

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
    </ul>
</nav>
