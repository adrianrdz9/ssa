<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apoyo a la comunidad') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        nav.navbar {
            background-color: #CC1414;
        }
        body{
          background-color: #ecf0f1;
        }
      </style>
    </head>
    <body>
      @component('partials.navbar')
          @slot('underLogo')
            <label>Facultad de Ingeniería</label>
          @endslot

          @slot('leftSide')
            <li class="nav-item">
              <a class="nav-link" href="{{route('actividadesDeportivasIndex')}}">Actividades deportivas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('agrupacionesIndex')}}">Agrupaciones estudiantiles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('bolsaIndex')}}">Bolsa de trabajo</a>
            </li>
          @endSlot
      @endcomponent
      <div class='container-fluid' id="app">
        @yield('content')
      </div>
  </body>
</html>
