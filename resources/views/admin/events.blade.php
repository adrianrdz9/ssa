@extends('layouts.app')

@section('content')
    <h2>Eventos</h2>
    <admin-events :e="{{$events}}"></admin-events>
    <h2>Avisos</h2>
    <admin-notices :n="{{$notices}}"></admin-notices>

@endsection