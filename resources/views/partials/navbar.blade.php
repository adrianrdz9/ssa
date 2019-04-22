{{-- 
    Componente de navegación
    Utilizar donde se quiera incluir la navegación
    * Ya incluye siempre los logos
    * El texto del lado derecho se cambia dependiendo de la pagina en la que se este
    * El boton de "Volver al inicio SSA" esta disponible siempre menos en "/"
    * Los botones de Inicio de sesion, Registrarse / Editar cuenta, Cerrar sesión siempre estan disponibles
    * El boton Editar cuenta solo esta disponible para alumnos no para agrupaciones
    Uso:
       
        @component('partials.narvbar')
            @slot('underLogo')
                <!-- Se inserta debajo del texto que indica la seccion en la que se está (Actividades deportivas, Agrupaciones, etc.) -->
            @endslot

            @slot('leftSide')
                <!-- Se inserta del lado izquierdo de la navegacion, al lado del botón "Volver al inicio SSA" -->
            @endslot

            @slot('rightSide')
                <!-- Se inserta del lado derecho de la navegación, antes de los botones de inicio de sesión -->
            @endslot
        @endcomponent

    Notas: 
        * Los slots son opcionales
        * Se puede agregar cualquier instruccion que se usaria normalmente dentro de los slots sin problema
    
--}}


<div class="row bg-grey p-2">
    <div class="col-sm-7 col-md-8">
        <a class="mx-4" href="https://www.unam.mx/">
            <img src="{{asset('images/logo_unam.png')}}" alt="Logo UNAM" height="120" >
        </a>
        <a href="http://www.ingenieria.unam.mx/">
            <img src="{{asset('images/logo_fi.png')}}" alt="Logo FI" height="120" >
        </a>
    </div>
    <div class="col-sm-5 col-md-4 text-right">
        @if(Route::getFacadeRoot()->current()->uri() == "/")
            <h1>Secretaría de Servicios Académicos</h1>
        @elseif(Request::is('actividades-deportivas*'))
            <h1>Actividades Deportivas</h1>
        @elseif(Request::is('agrupaciones*'))
            <h1>Agrupaciones</h1>
        @elseif(Request::is('bolsa*'))
            <h1>Bolsa de Trabajo</h1>
        @else
            <h1>Secretaría de Servicios Académicos</h1>
        @endif
        @if(isset($underLogo))
            {{$underLogo}}
        @endif
    </div>
</div>
<nav class="navbar navbar-expand-md navbar-dark bg-grey">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Route::getFacadeRoot()->current()->uri() != "/")
                    <li class="nav-item">
                        <a href="/" class="nav-link">Volver al inicio SSA</a>
                    </li>
                @endif
                @if(isset($leftSide))
                    {{$leftSide}}
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @if(isset($rightSide))
                    {{$rightSide}}
                @endif
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::user()->name)
                                {{ Auth::user()->name }} 
                            @else 
                                {{ Auth::user()->Siglas }} 
                            @endif
                            
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->account_number)
                                <a href="{{ route('updateAccount') }}" class="dropdown-item">Editar cuenta</a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>