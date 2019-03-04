@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Credencial de {{$user->name}} {{$user->last_name}}</h1>
        @if($user->credencial->exists())

        <img src="{{$user->credencialUrl()}}" alt="Credencial de {{$user->name}}" height="400">
        <a href="{{$user->credencialUrl()}}" title="Credencial de {{$user->name}}" download="credencial-{{$user->name}}-{{$user->last_name}}.{{explode('.', $user->credencial->url())[1]}}">    
            Descargar
        </a>
        @else
            <h3>El usuario no ha subido su credencial</h3>
        @endif
    </div>
@endsection