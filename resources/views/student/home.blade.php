@extends('layouts.app')

@section('content')
<notices-carousel :slides="{{$slides}}"></notices-carousel>
<h2>Eventos</h2>
<events-component :e="{{$events}}"></events-component>
<h2>Avisos</h2>
<notices-component :n="{{$notices}}"></notices-component>
@endsection