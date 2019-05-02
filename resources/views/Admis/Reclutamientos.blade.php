@extends('layouts.app')
@section('title','Reclutamientos')
@section('content')
<h3>Crea un nuevo reclutamiento</h3>
<div class="container">
<form method="post" action="{{ url('agrupaciones/reclutamientoF') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-row">
    <div class="form-group col-md-6">
      <h4>Cargo</h4>
      <input class="form-control" name="Cargo" type="text" required>
    </div>
    <div class="form-group col-md-6">
      <h4>Descripción:</h4>
      <textarea class="form-control" name="Descripcion" type="text" required></textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <h4>Fecha:</h4>
      <input class="form-control" type="date" name="Fecha" required>
    </div>
    <div class="form-group col-md-3" style="margin-left:1.5%;">
      <h4>Hora:</h4>
      <input class="form-control" type="time" name="Hora" required>
    </div>
    <div class="form-group col-md-5" style="margin-left:1.5%;">
      <h4>Lugar:</h4>
      <input class="form-control" type="text" name="Lugar" required>
    </div>
  </div>
  <h3>Requisitos</h3>
  <div class="form-row" style="text-align:left;">
    <div class="form-group col-md-6">

      <div class="checkbox">
        <h4>Semestre</h4>
      </div>
      <div class="form-group">
        <select class="form-control" name="Semes">
          <option>Primero-Segundo</option>
          <option>Tercero-Cuarto</option>
          <option>Quinto-Sexto</option>
          <option>Septimo-Octavo</option>
          <option>No es necesario</option>
        </select>
      </div>

      <div class="checkbox">
        <h4>Promedio</h4>
      </div>
      <div class="form-group">
        <select class="form-control" name="Pro">
          <option>10 - 9.5</option>
          <option>9.5 - 9</option>
          <option>9 - 8.5</option>
          <option>8.5 - 8</option>
          <option>No es necesario</option>
        </select>
      </div>
      <h4>Disponibilidad de horario</h4>
        <label class="radio-inline">
          <input type="radio" name="Disponibilidad" value="S" required>  Sí
        </label>
        <label class="radio-inline">
          <input type="radio" name="Disponibilidad"  value="N" checked required>  No
        </label>
    </div>
    <div class="form-group col-md-5" style="margin-left:1.5%;">

      <div class="checkbox disabled">
        <h4>Conocimientos previos</h4>
      </div>
      <div class="form-group">
        <textarea class="form-control" rows="5" name="Cono"></textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Crear</button>
    </div>
  </div>
</form>
</Div>
@stop
