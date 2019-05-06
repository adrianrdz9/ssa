@extends('layouts.Agrupaciones')
@section('content')
<div class="container" style="margin-top:1%;">
  <h2>Editar imagen del carusel</h2>
<form method="post" action="{{ url('agrupaciones/UImagenC') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="row" style="text-align:left;">
      <div class="col-md-6">
          <div class="form-group">
              <h5>Título:</h5>
              <input type="text" name="Titulo" class="form-control" placeholder="{{ $data[0]->Titulo }}" >
          </div>
          <div class="form-group">
            <h5>Descripción corta:</h5>
            <textarea class="form-control" name="Descripcion" type="text" maxlength="150" placeholder="{{ $data[0]->Descripcion }}"></textarea>
          </div>
          <div class="form-group">
              <h5>Link:</h5>
              <input type="text" name="Link" class="form-control" placeholder="{{ $data[0]->Link }}" />
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            <h5>Imagen:</h5>
            <input type="file" class="form-control-file border" name="Imagen" id="imgInp" >
            @if (is_null($data[0]->Imagen ))
              <small>No tiene imagen</small>
            @endif
              <img src="{{asset('images/Noticias/'. $data[0]->ImagenC )}}" class="img-fluid" alt="No se puede cargar la imagen">
        </div>
        <div class="form-group">
          <img id="preview" alt="Imagen seleccionada" width="100%" height="100%" />
        </div>
        <div class="form-group" style="text-align:right;">
            <input type="hidden" name="id" value="{{ $data[0]->id }}">
            <input type="submit" class="btn btn-primary" value="Actualizar"/>
        </div>
      </div>
   </div>
</form>
</div>
@stop
