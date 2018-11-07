<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/noticas.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Chakra+Petch|Playfair+Display|Roboto+Slab" rel="stylesheet">

  </head>
  <body>
  <div class='container-fluid'>
  <div class="container-fluid" id="DivLogo">
    <img src="{{asset('images/UNAM.png')}}" alt="Logo UNAM" width="90px" height="90px" style="margin-top:.5%;" align="left">
    <img src="{{asset('images/FI.png')}}" alt="Logo FI" width="90px" height="94px" style="margin-top:.2%;" align="left">
    <label id="In">Facultad de Ingeniería</label>
  </div>
  <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197" style="background-color:red;">
    <div class="container-fluid" style="background-color:white; border-color:red;">
      <div class="navbar-header"style="background-color:#fd4646;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      </div>
      <div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="Agrupaciones/public/">Inicio</a></li>
            <li><a href="#">Agrupaciones</a></li>
            <li><a href="#section3">Historial</a></li>
            <li><a href="#section3">Reclutamiento</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
      @yield('content')
  </div>
  </body>
</html>
