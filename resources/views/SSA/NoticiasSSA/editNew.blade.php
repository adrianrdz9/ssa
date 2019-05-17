@extends('layouts.Agrupaciones')
@section('content')
<h3>Actualizar noticia</h3>
  <div class="container">
    <form method="post" action="{{ route('updateNew',['id'=> $new->id]) }}" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4>Titulo</h4>
          <input class="form-control" name="Titulo" type="text" value="{{ $new->Titulo }}">
        </div>
        <div class="form-group col-md-6">
          <h4>Fecha </h4>
          <input type="date" name="Fecha">
          <small>Fecha actual: {{ date('d/m/Y', strtotime($new->Fecha)) }}</small>
        </div>
      </div>
      <div class="form-group">
        <h4>Descripción corta:</h4>
        <textarea class="form-control" name="DescripcionCorta" type="text"maxlength="150">{{ $new->DescripcionCorta }}</textarea>
      </div>
      <div class="form-group">
        <h4>Noticia completa:</h4>
        <textarea class="form-control" name="Descripcion">{{ $new->Descripcion }}</textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen cuadrada:</h4>
          <input type="file" class="form-control-file border" name="ImagenC" accept=".jpg,.png">
          @if (is_null($new->ImagenC ))
            <small>No tiene imagen secundaria</small>
          @endif
            <img src="{{asset('images/Noticias/'. $new->ImagenC )}}" class="img-fluid" alt="No se puede cargar la imagen">
        </div>
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen rectangular:</h4>
          <input type="file" class="form-control-file border" name="ImagenR" accept=".jpg,.png">
          @if (is_null($new->ImagenR ))
            <small>No tiene imagen principal</small>
          @endif
            <img src="{{asset('images/Noticias/'. $new->ImagenR )}}" class="img-fluid" alt="No se puede cargar la imagen">
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </form>
  </div>
@stop
