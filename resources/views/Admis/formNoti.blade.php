@extends('layouts.Admi')
@section('title','Nueva notica')
@section('content')
<form method="POST" action=" {{ route('logout') }} ">
  {{ csrf_field() }}
  <button class="btn btn-danger btn-block">Cerrar sesión</button>
</form>
<h3>Noticias</h3>
@if($msg=="Se guardo la notica con exito")
  <div class="alert alert-success" role="alert">
    {{ $msg }}
  </div>
@endif
<form method="post" action="{{ url('Admi') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-row">
    <div class="form-group col-md-6">
      <h4>Titulo</h4>
      <input class="form-control" name="Titulo" type="text">
    </div>
    <div class="form-group col-md-6">
      <h4>Fecha </h4>
      <input type="date" name="Fecha">
    </div>
  </div>
  <div class="form-group">
    <h4>Descripción corta:</h4>
    <textarea class="form-control" name="DescripcionCorta" type="text"></textarea>
  </div>
  <div class="form-group">
    <h4>Noticia completa:</h4>
    <textarea class="form-control" name="Descripcion"></textarea>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <h4 for="inputCity">Imagen cuadrada:</h4>
      <input type="file" class="form-control-file border" name="ImagenC">
    </div>
    <div class="form-group col-md-6">
      <h4 for="inputCity">Imagen rectangular:</h4>
      <input type="file" class="form-control-file border" name="ImagenR">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Publicar</button>
</form>
@stop
