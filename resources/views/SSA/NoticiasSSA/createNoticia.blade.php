@extends('layouts.Agrupaciones')
@section('title','Nueva notica')
@section('content')
<h3>Nueva noticia</h3>
  <div class="container">
    <form method="post" action="{{ route('storeNew') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4>Titulo</h4>
          <input class="form-control" name="Titulo" type="text" value="{{ old('Titulo')}}" required>
        </div>
        <div class="form-group col-md-6">
          <h4>Fecha </h4>
          <input class="form-control" type="date" name="Fecha" value="{{ old('Fecha')}}" required>
        </div>
      </div>
      <div class="form-group">
        <h4>Descripción corta:</h4>
        <textarea class="form-control" name="DescripcionCorta" type="text">{{ old('DescripcionCorta')}}</textarea>
      </div>
      <div class="form-group">
        <h4>Noticia completa:</h4>
        <textarea class="form-control" name="Descripcion">{{ old('Descripcion')}}</textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen cuadrada:</h4>
          <input type="file" class="form-control-file border" name="ImagenC" accept=".jpg,.png">
        </div>
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen rectangular:</h4>
          <input type="file" class="form-control-file border" name="ImagenR" accept=".jpg,.png">
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
