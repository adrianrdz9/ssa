<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
    <link href="{{asset('css/noticas.css')}}" rel="stylesheet"/>

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
              @role('Agrupacion')
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('semiAdmi') }}">Información</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('createReclutamiento') }}">Nuevo reclutamiento</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('indexReclutamiento') }}">Reclutamientos</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('PropuestaSemi') }}">Propuestas</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="{{ route('cambioMesa') }}">Cambio de Mesa</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="{{ route('semiMsj') }}">Mensajes</a>
                  </li>
              @endrole
            @endslot
          @endcomponent
          <main class="py-4 bg-white" style="margin:1%;">
              @yield('content')
          </main>
      </div>
  </body>
</html>
