<!DOCTYPE HTML>
<html>
  <head>
    <meta charset='utf-8'/>
    <meta http-http-equiv='X-UA-Compatible' content='IE=edge'/>
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title>@yield('title')</title>
    <meta name='description' content='@yield('description')'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
  <div class='container'>
    <nav class="navbar navbar-expand-lg navbar-light bg-light nav-tabs">
        <a class="navbar-brand" href="#">Agrupaciones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Información<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reclutamientos</a>
                </li>
                <li class="nav-item">
                  <form method="POST" action=" {{ route('logout') }} ">
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-block">Cerrar sesión</button>
                  </form>
                </li>
            </ul>
        </div>
    </nav>
        @yield('content')
    </div>
  </body>
</html>
