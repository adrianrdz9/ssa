<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/noticas.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Chakra+Petch|Playfair+Display|Roboto+Slab" rel="stylesheet">
    <style>
      nav.navbar {
          background-color: #CC1414;
          color: white;
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
    <img src="{{asset('images/logo_fi.png')}}" alt="Logo FI" width="90px" height="94px" style="margin-top:.2%; margin-left:.5%;" align="left">
    <label id="In">Facultad de Ingeniería</label>
  </div>
  <nav class="navbar navbar-expand-md navbar-dark">
    <a class="navbar-brand" href="../../">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="/agrupaciones/Agrupaciones">Agrupaciones</a>
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="/agrupaciones/Historial">Historial</a>
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="/agrupaciones/Reclutamientos">Reclutamientos</a>
        </li>
        {{-- @guest --}}
          {{-- Todo lo que este dentro del @guest solo se mostrará si el usuario NO ha iniciado sesión. --}}
          {{-- 
            Este es el link para iniciar sesión, debe ser este link ya que el hecho de tener dos rutas que daban a la misma acción
            (LoginController) estaba generando un problema al obtener la ruta anterior (lo que permite que se redirija a la pagina 
            de la que se viene -agrupaciones o actividades-deportivas- despues del login). Ahora ya debería de funcionar, pero este es 
            el link que se debe de utilizar en cualquier lado que se quiera dirigir al inicio de sesión. Le puedes dar el estilo que quieras
            y el texto que sea mientras se conserve la ruta.
          --}}
          <a href="{{ route('login') }}">
            Login
          </a>
        {{-- @else --}}
          {{-- Todo lo que este dentro del @else solo se mostrará si el usuario YA inicio sesión. --}}
          {{-- 
            Como recomendación, es buena practica tener siempre disponibles los botones de login/logout segun corresponda,
            Si quieres implementarlo descomenta el "@guest", "@else" y "@endguest".
          --}}
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="submit" value="Cerrar sesión">
          </form>
        {{-- @endguest --}}
      </ul>
    </div>
  </nav>
      @yield('content')
  </div>
  </body>
</html>
