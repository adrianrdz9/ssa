@extends('layouts.app')

@section('content')
<notices-carousel :slides="{{$slides}}"></notices-carousel>
<h2>Eventos</h2>
<events-component :e="{{$events}}"></events-component>
@endsection