@extends('layouts.Agrupaciones')
@section('content')
<h3>Editar evento</h3>
 <div class="container">
   <form action="{{ route('updateEvent',['id'=> $event->id]) }}" method="post">
     {{ csrf_field() }}
     @method('patch')
      <div class="form-group">
        <label>Agrupacion responsable</label>
        <input type="text" class="form-control col-md-8" name="Siglas" value="{{ $event->Siglas }}">
        <small class="form-text text-muted">Siglas de la agrupación</small>
      </div>
      <div class="form-group">
        <label>Titulo</label>
        <input type="text" class="form-control col-md-8" name="Titulo" value="{{ $event->Titulo }}">
      </div>
      <div class="form-group">
        <label>Ponente</label>
        <input type="text" class="form-control col-md-8" name="Por" value="{{ $event->Por }}">
      </div>
      <div class="form-group">
        <label>Día</label>
        <input type="date" class="form-control col-md-8" name="Dia" value="{{ $event->Dia }}">
      </div>
      <div class="form-group">
        <label>Lugar</label>
        <input type="text" class="form-control col-md-8" name="Lugar" value="{{ $event->Lugar }}">
      </div>
      <div class="form-group">
        <label>Hora</label>
        <input type="time" class="form-control col-md-8" name="Hora" value="{{ $event->Hora }}">
      </div>
      <input type="hidden" name="id" value="{{ $event->id }}">
      <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </form>
  </div>
@stop
