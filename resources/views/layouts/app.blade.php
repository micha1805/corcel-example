<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--


            W     W EEEEEE  010   010   DDDD  EEEEE  SSSS I GGGGG N     N
            W     W E      00110 01100  D   D E     S     I G     NN    N
            W     W E     0110110110110 D   D E     S     I G     N N   N
            W     W EEE   1100110110011 D   D EEE    SSS  I G  GG N  N  N
            W     W E      10110101101  D   D E         S I G   G N   N N
            W  W  W E        1110111    D   D E         S I G   G N    NN
             WW WW  EEEEEE     010      DDDD  EEEEE SSSS  I GGGGG N     N
                                1

        # COMPANY

            Binalogue - We love design - https://binalogue.com

        # SITE

            Language: Español
            Doctype: HTML5
            Standards: HTML5 / CSS3
            Frameworks: Laravel / Sage / jQuery / Bootstrap / Modernizr
            IDE: Coda / Atom / BitBucket / FileZilla / Photoshop / Illustrator

        # THANKS

            Humans TXT: We Are People, Not Machines.
            http://humanstxt.org/

        -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', config('app.name', 'Corcel'))
    </title>


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}" />

    @yield('meta')

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/7278816/7082992/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="{{ mix('styles/app.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- [if lt IE 9] >
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <! [endif] -->
</head>
<body class="@yield('slug')">
    <div id="app" class="container">
        @include('layouts.header')

        <main id="app-wrapper">
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

    @if (!isset($_COOKIE['acceptance']))
        {{--  <div class="container-fluid">
            <div class="o-cookies-warning">
                <p class="o-text-cookies">
                    {{ trans('messages.cookies.text') }}
                </p>

                <button class="a-button j-acceptance">
                    {{ trans('messages.cookies.cta') }}
                </button>
            </div>
        </div>  --}}
    @endif

    @yield('scripts')

    <!-- Hotjar Tracking Code for https://visitandorra-spotify.com/ -->
    {{--  <script></script>  --}}

    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    {{--  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-78980442-5"></script>  --}}
    {{--  <script></script>  --}}

    <script type="text/javascript" src="{{ mix('scripts/app.js') }}"></script>

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
