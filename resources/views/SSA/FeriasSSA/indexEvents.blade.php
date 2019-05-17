@extends('layouts.Agrupaciones')
@section('content')
<div class="row">
  <div class="table-responsive col-sm-8">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th>Agrupación</th>
          <th>Evento</th>
          <th>Ponente</th>
          <th>Lugar</th>
          <th>Horario</th>
          <th>...</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($eventos as $evento)
          <tr>
            <td>{{ $evento->Siglas }}</td>
            <td>{{ $evento->Titulo }}</td>
            <td>{{ $evento->Por }}</td>
            <td>{{ $evento->Lugar }}</td>
            <td>
              <strong>Día:</strong> {{ date("d/m/Y", strtotime($evento->Dia)) }} <br/>
              <strong>Hora:</strong> {{ $evento->Hora }}
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"> ...
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1"  data-id="{{ $evento->id }}">
                  <li> <button type="button" name="button" class="btn btn-danger btn-block Eliminar">Eliminar</button> </li>
                  <li><a class="btn btn-info btn-block" href="{{ route('editEvent',['id'=> $evento->id])}}">Editar</a></li>
                </ul>
              </div>
            </div>
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-sm-4">
   <form action="{{ route('storeEventF') }}" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label>Agrupacion responsable</label>
        <input type="text" class="form-control col-md-11" name="Siglas" value="{{ old('Siglas')}}">
        <small class="form-text text-muted">Siglas de la agrupación</small>
      </div>
      <div class="form-group">
        <label>Titulo</label>
        <input type="text" class="form-control col-md-11" name="Titulo" value="{{ old('Titulo')}}">
      </div>
      <div class="form-group">
        <label>Ponente</label>
        <input type="text" class="form-control col-md-11" name="Por" value="{{ old('Por')}}">
      </div>
      <div class="form-group">
        <label>Día</label>
        <input type="date" class="form-control col-md-11" name="Dia" value="{{ old('Dia')}}">
      </div>
      <div class="form-group">
        <label>Lugar</label>
        <input type="text" class="form-control col-md-11" name="Lugar" value="{{ old('Lugar')}}">
      </div>
      <div class="form-group">
        <label>Hora</label>
        <input type="time" class="form-control col-md-11" name="Hora" value="{{ old('Hora')}}">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
  </div>
</div>
@stop
