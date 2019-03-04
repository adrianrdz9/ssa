@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Carnet de {{$user->name}} {{$user->last_name}}</h1>
        @if($user->carnet->exists())

        <img src="{{$user->carnetUrl()}}" alt="Carnet de {{$user->name}}" height="400">
        <a href="{{$user->carnetUrl()}}" title="Carnet de {{$user->name}}" download="carnet-{{$user->name}}-{{$user->last_name}}.{{explode('.', $user->carnet->url())[1]}}">    
            Descargar
        </a>
        @else
            <h3>El usuario no ha subido su carnet</h3>
        @endif
    </div>
@endsection