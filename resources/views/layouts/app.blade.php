<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @if (session('notice'))
        <div class="alert alert-info fixed-top">
           {{session('notice')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger fixed-top">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="app">
        <div class="row bg-grey p-2">
            <div class="col-sm-7 col-md-8">
                <a class="mx-4" href="https://www.unam.mx/">
                    <img src="{{asset('images/logo_unam.png')}}" alt="Logo UNAM" height="120" >
                </a>
                <a href="http://www.ingenieria.unam.mx/">
                    <img src="{{asset('images/logo_fi.png')}}" alt="Logo FI" height="120" >
                </a>
            </div>

            <div class="col-sm-5 col-md-4 text-right">
                <h1>Secretaria de Servicios Academicos</h1>
                @role('admin')
                    <span>Panel de administrador</span>
                @endrole
                @role('eval')
                    <span>Panel de evaluador</span>
                @endrole
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-grey">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        

                        @role('admin')
                            <li class="navbar-item">
                                <a href="{{ route('home') }}" class="nav-link">Carrusel</a>
                            </li>
                            <li class="navbar-item">
                                <a href="{{ route('events') }}" class="nav-link">Eventos y avisos</a>
                            </li>
                            <li class="navbar-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="tournamentDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Torneos
                                </a>
                                <div class="dropdown-menu" aria-labelledby="tournamentDropdown">
                                    <a class="dropdown-item" href="{{ route('newTournament') }}">Crear torneo</a>
                                    <a class="dropdown-item" href="{{ route('tournamentsIndex') }}">Ver todos los torneos</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('completeSignup') }}">Completar inscripción</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tournamentsIndex') }}" class="nav-link">Torneos</a>
                            </li>
                        @endrole
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <main class="py-4 bg-white">
            @yield('content')
        </main>
    </div>
</body>
</html>
