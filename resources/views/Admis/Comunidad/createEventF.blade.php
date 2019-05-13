@extends('layouts.Agrupaciones')
@section('content')
<div class="container">
  <h3>Agregar evento a la página principal</h3>
  <form action="{{ route('storeEventC') }}" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label>Titulo</label>
        <input type="text" class="form-control col-md-11" name="Evento">
      </div>
      <div class="form-group">
        <label>Día</label>
        <input type="date" class="form-control col-md-11" name="Dia">
      </div>
      <div class="form-group">
        <label>Lugar</label>
        <input type="text" class="form-control col-md-11" name="Lugar">
      </div>
      <div class="form-group">
        <label>Hora</label>
        <input type="time" class="form-control col-md-11" name="Hora">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
</div>
@stop
