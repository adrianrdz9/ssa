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
    <script src="{{ asset('js/modrnizer.min.js') }}" defer></script>

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

        @component('partials.navbar')
            @slot('underLogo')
                @role('admin')
                    <span>Panel de administrador</span>
                @endrole
                @role('eval')
                    <span>Panel de evaluador</span>
                @endrole
                @role('SSA')
                    <span>Panel de administrador</span>
                @endrole
            @endslot

            @slot('leftSide')
                @role('admin')
                    <li class="navbar-item">
                        <a href="{{ route('actividadesDeportivasIndex') }}" class="nav-link">Carrusel</a>
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
                            <a href="{{ route('historicIndex') }}" class="dropdown-item">Historico</a>
                            <a href="{{ route('cedulaIndex') }}" class="dropdown-item">Cédulas de inscripciones</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('completeSignup') }}">Completar inscripción</a>
                            <a class="dropdown-item" href="{{ route('getResponsive') }}">Obtener responsiva de alumno</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('quickTournament') }}">Torneo rápido</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sportsIndex') }}" class="nav-link">Deportes</a>
                    </li>
                @else
                    @role('eval')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('actividadesDeportivasIndex') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sportsIndex') }}" class="nav-link">Deportes</a>
                        </li>
                      @else
                        @role('SSA')
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi">Nueva noticia</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi/Carusel">Carusel</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi/NICarusel">Nueva Imagen Carusel</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi/Contraseñas">Contraseñas</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi/Propuestas">Propuestas</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi/AdmiMsj">Mensajes</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../../agrupaciones/Admi/EventosFeria">Eventos Feria</a>
                          </li>
                        @else
                          @role('Agrupacion')
                              <li class="nav-item">
                                <a class="nav-link" href="../../agrupaciones/semiAdmi">Información</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../../agrupaciones/semiAdmi/Reclutamientos">Nuevo reclutamiento</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../../agrupaciones/semiAdmi/VerReclutamientos">Reclutamientos</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../../agrupaciones/semiAdmi/Propuesta">Propuestas</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../../agrupaciones/semiAdmi/CambioMesa">Cambio de Mesa</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="../../agrupaciones/semiAdmi/semiAdmiMsj">Mensajes</a>
                              </li>
                            @else
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('actividadesDeportivasIndex') }}">Inicio</a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('tournamentsIndex') }}" class="nav-link">Torneos</a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('teamsIndex') }}" class="nav-link">Equipos</a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('sportsIndex') }}" class="nav-link">Deportes</a>
                              </li>
                            @endrole
                        @endrole
                    @endrole
                @endrole
            @endslot
        @endcomponent

        <main class="py-4 bg-white">
            @yield('content')
        </main>
    </div>
</body>
</html>
