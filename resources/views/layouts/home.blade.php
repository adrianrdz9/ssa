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
    <link href="{{asset('css/noticas.css')}}" rel="stylesheet"/>
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
      <div class='container-fluid'>
        <div class="container-fluid" id="DivLogo">
          <img src="{{asset('images/logo_unam.png')}}" alt="Logo UNAM" width="90px" height="90px" style="margin-top:.5%;" align="left">
          <img src="{{asset('images/logo_fi.png')}}" alt="Logo FI" width="90px" height="94px" style="margin-top:.2%;" align="left">
          <label id="In">Facultad de Ingeniería</label>
        </div>
        <nav class="navbar navbar-expand-md navbar-dark">
          <a class="navbar-brand" href="">Inicio</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="navbar-brand" href="{{route('actividadesDeportivasIndex')}}">Actividades deportivas</a>
              </li>
              <li class="nav-item">
                <a class="navbar-brand" href="{{route('agrupacionesIndex')}}">Agrupaciones estudiantiles</a>
              </li>
              <li class="nav-item">
                <a class="navbar-brand" href="{{route('bolsaIndex')}}">Bolsa de trabajo</a>
              </li>
            </ul>
          </div>
        </nav>
    <div class='container-fluid' id="app">
      @yield('content')
    </div>
  </body>
</html>
