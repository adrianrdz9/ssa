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
    <script src="{{ asset('js/Agrupaciones.js') }}" defer></script>
    <script src="{{ asset('js/modrnizer.min.js') }}" defer></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
          selector:'textarea',
          plugins: "link advlist code",
        });
    </script>
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
                @role('admiComunidad')
                    <span>Panel de admistrador general</span>
                @endrole
                @role('SSA')
                    <span>Panel de administrador</span>
                @endrole
                @role('Agrupacion')
                    <span>Panel de agrupacion</span>
                @endrole
            @endslot

            @slot('leftSide')
              @role('SSA')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('indexNoticia')}}">Noticias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('createNoticia')}}">Nueva noticia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('indexCarrusel') }}">Carrusel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('createCarrusel')}}">Nueva Imagen Carrusel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('AdmiPropuestas')}}">Propuestas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admiMsj')}}">Mensajes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('indexEvents')}}">Eventos Feria</a>
                </li>
                @else
                  @role('Agrupacion')
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('semiAdmi')}}">Información</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('createReclutamiento')}}s">Nuevo reclutamiento</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('indexReclutamiento')}}">Reclutamientos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('PropuestaSemi')}}">Propuestas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('cambioMesa')}}">Cambio de Mesa</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('semiMsj')}}">Mensajes</a>
                      </li>
                    @else
                      @role('admiComunidad')
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('indexComunidad')}}">Página principal</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('createEventC') }}">Nuevo evento</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('noticiasAgrupas')}}">Agrupaciones</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Actividades deportivas</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Bolsa de trabajo</a>
                        </li>
                        @else
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('agrupaciones')}}">Agrupaciones</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('ReclutaIndex')}}">Reclutamientos</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('Feria') }}">Feria de agrupaciones</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('agrupacionesIndex')}}">Inicio agrupaciones</a>
                          </li>
                      @endrole
                    @endrole
                 @endrole
              @endslot
        @endcomponent

        <main class="py-4 bg-white" style="margin:1%;">
            @yield('content')
        </main>
    </div>
</body>
</html>
