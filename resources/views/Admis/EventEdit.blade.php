@extends('layouts.Agrupaciones')
@section('content')
<h3>Editar evento</h3>
 <div class="container">
   <form action="{{ route('UEvento') }}" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label>Agrupacion responsable</label>
        <input type="text" class="form-control col-md-8" name="Siglas" placeholder="{{ $data[0]->Siglas }}">
        <small class="form-text text-muted">Siglas de la agrupación</small>
      </div>
      <div class="form-group">
        <label>Titulo</label>
        <input type="text" class="form-control col-md-8" name="Titulo" placeholder="{{ $data[0]->Titulo }}">
      </div>
      <div class="form-group">
        <label>Ponente</label>
        <input type="text" class="form-control col-md-8" name="Por" placeholder="{{ $data[0]->Por }}">
      </div>
      <div class="form-group">
        <label>Día</label>
        <input type="date" class="form-control col-md-8" name="Dia">
        <small>Fecha actual : {{ date("d/m/Y", strtotime($data[0]->Dia)) }}</small>
      </div>
      <div class="form-group">
        <label>Lugar</label>
        <input type="text" class="form-control col-md-8" name="Lugar" placeholder="{{ $data[0]->Lugar }}">
      </div>
      <div class="form-group">
        <label>Hora</label>
        <input type="time" class="form-control col-md-8" name="Hora">
        <small>Hora actual : {{ $data[0]->Hora }}</small>
      </div>
      <input type="hidden" name="id" value="{{ $data[0]->id }}">
      <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </form>
  </div>
@stop
