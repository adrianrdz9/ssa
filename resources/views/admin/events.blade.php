@extends('layouts.app')

@section('content')
    <events-component :e="{{$events}}"></events-component>
    <form action="/admin/events" method="post">
        @csrf
        <input type="date" name="date" id="date">
        <input type="text" name="event" id="text">
        <input type="submit" value="Guardar">
    </form>
@endsection