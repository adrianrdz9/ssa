@extends('layouts.Agrupaciones')
@section('title','Nueva notica')
@section('content')
<h3>Nueva noticia</h3>
  <div class="container">
    <form method="post" action="{{ url('agrupaciones/AdmiP') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4>Titulo</h4>
          <input class="form-control" name="Titulo" type="text" required>
        </div>
        <div class="form-group col-md-6">
          <h4>Fecha </h4>
          <input type="date" name="Fecha" required>
        </div>
      </div>
      <div class="form-group">
        <h4>Descripción corta:</h4>
        <textarea class="form-control" name="DescripcionCorta" type="text"></textarea>
      </div>
      <div class="form-group">
        <h4>Noticia completa:</h4>
        <textarea class="form-control" name="Descripcion" ></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen cuadrada:</h4>
          <input type="file" class="form-control-file border" name="ImagenC" accept=".pdf,.jpg,.png">
        </div>
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen rectangular:</h4>
          <input type="file" class="form-control-file border" name="ImagenR" accept=".pdf,.jpg,.png">
        </div>
      </div>
      <h4 for="inputCity">¿Mostrar en el carusel?</h4>
      <p>
        <label class="radio-inline">
          <input type="radio" name="carusel" value="S" required>Sí
        </label>
        <label class="radio-inline">
          <input type="radio" name="carusel"  value="N" checked required>No
        </label>
     </p>
      <button type="submit" class="btn btn-primary btn-block">Publicar</button>
    </form>
  </div>
@stop