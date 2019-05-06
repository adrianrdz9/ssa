@extends('layouts.Agrupaciones')
@section('content')
<h3>Actualizar noticia</h3>
  <div class="container">
    <form method="post" action="{{ url('agrupaciones/UNoticia') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4>Titulo</h4>
          <input class="form-control" name="Titulo" type="text" placeholder="{{ $data[0]->Titulo }}">
        </div>
        <div class="form-group col-md-6">
          <h4>Fecha </h4>
          <input type="date" name="Fecha">
          <small>Fecha actual: {{ date('d/m/Y', strtotime($data[0]->Fecha)) }}</small>
        </div>
      </div>
      <div class="form-group">
        <h4>Descripción corta:</h4>
        <textarea class="form-control" name="DescripcionCorta" type="text" placeholder="{{ $data[0]->DescripcionCorta }}"></textarea>
      </div>
      <div class="form-group">
        <h4>Noticia completa:</h4>
        <textarea class="form-control" name="Descripcion" placeholder="{{ $data[0]->Descripcion }}"></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen cuadrada:</h4>
          <input type="file" class="form-control-file border" name="ImagenC" accept=".jpg,.png">
          @if (is_null($data[0]->ImagenC ))
            <small>No tiene imagen secundaria</small>
          @endif
            <img src="{{asset('images/Noticias/'. $data[0]->ImagenC )}}" class="img-fluid" alt="No se puede cargar la imagen">
        </div>
        <div class="form-group col-md-6">
          <h4 for="inputCity">Imagen rectangular:</h4>
          <input type="file" class="form-control-file border" name="ImagenR" accept=".jpg,.png">
          @if (is_null($data[0]->ImagenR ))
            <small>No tiene imagen principal</small>
          @endif
            <img src="{{asset('images/Noticias/'. $data[0]->ImagenR )}}" class="img-fluid" alt="No se puede cargar la imagen">
        </div>
      </div>
      <input type="hidden" name="id" value="{{ $data[0]->id }}">
      <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
    </form>
  </div>
@stop
