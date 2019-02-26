@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="d-block text-center">Descargar responsiva de alumno</h1>
        <hr>
        <responsive-finder :tournaments="{{$tournaments}}"></resposive-finder>
    </div>
@endsection