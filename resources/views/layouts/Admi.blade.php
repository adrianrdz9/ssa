<!DOCTYPE HTML>
<html>
  <head>
    <meta charset='utf-8'/>
    <meta http-http-equiv='X-UA-Compatible' content='IE=edge'/>
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title>@yield('title')</title>
    <meta name='description' content='@yield('description')'/>
    <link href="{{asset('css/noticas.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
  <div class="container-fluid" id="DivLogo">
    <img src="{{asset('Images/UNAM.png')}}" alt="Logo UNAM" width="90px" height="90px" style="margin-top:.5%;" align="left">
    <img src="{{asset('Images/FI.png')}}" alt="Logo FI" width="90px" height="94px" style="margin-top:.2%;" align="left">
    <label id="In">Facultad de Ingeniería</label>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">Noticas</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Nueva Noticia<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contraseñas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Salir</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class='container'>
      @yield('content')
  </div>
  </body>
</html>
