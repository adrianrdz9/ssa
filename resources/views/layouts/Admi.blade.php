<!DOCTYPE HTML>
<html>
  <head>
    <meta charset='utf-8'/>
    <meta http-http-equiv='X-UA-Compatible' content='IE=edge'/>
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
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
  @include('sweet::alert')
  <div class='container-fluid'>
    <div class="container-fluid" id="DivLogo">
      <img src="{{asset('images/UNAM.png')}}" alt="Logo UNAM" width="90px" height="90px" style="margin-top:.5%;" align="left">
      <img src="{{asset('images/FI.png')}}" alt="Logo FI" width="90px" height="94px" style="margin-top:.2%;" align="left">
      <label id="In">Facultad de Ingeniería</label>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark">
      <a class="navbar-brand" href="../ANoticias">{{ auth()->user()->Siglas }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand" href="../ANoticias">Noticias</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="../Admi">Nueva noticia</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="../Admi/Carusel">Carusel</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="../Admi/NICarusel">Nueva Imagen Carusel</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="../Admi/Contraseñas">Contraseñas</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="../Admi/Propuestas">Propuestas</a>
          </li>
          <li class="nav-item">
            <form method="POST" action=" {{ route('logout') }} ">
              {{ csrf_field() }}
              <button class="btn btn-danger">Cerrar sesión</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
      @yield('content')
  </div>
  </body>
</html>
