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
    <script src="{{ asset('js/modrnizer.min.js') }}" defer></script>

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
               <span>Super admin</span>
            @endslot

            @slot('leftSide')     
                <li class="nav-item">
                    <a class="nav-link" href="/s">Usuarios y roles</a>
                </li>
            @endslot
        @endcomponent

        <main class="py-4 bg-white">
            @yield('content')
        </main>
    </div>
</body>
</html>
