@extends('layouts.Agrupaciones')
@section('content')
<div class="container">
  <h3>Editar evento</h3>
  <form action="{{ route('updateEventC',['id'=> $event->id])}}" method="post">
     {{ csrf_field() }}
     @method('patch')
      <div class="form-group">
        <label>Titulo</label>
        <input type="text" class="form-control col-md-11" name="Evento" value = "{{ $event->Evento }}">
      </div>
      <div class="form-group">
        <label>Día</label>
        <input type="date" class="form-control col-md-11" name="Dia" value = "{{ $event->Dia }}">
      </div>
      <div class="form-group">
        <label>Lugar</label>
        <input type="text" class="form-control col-md-11" name="Lugar" value = "{{ $event->Lugar }}">
      </div>
      <div class="form-group">
        <label>Hora</label>
        <input type="time" class="form-control col-md-11" name="Hora" value = "{{ $event->Hora }}">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </form>
</div>
@stop
