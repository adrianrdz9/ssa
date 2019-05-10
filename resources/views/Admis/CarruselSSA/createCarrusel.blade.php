@extends('layouts.Agrupaciones')
@section('content')
<div class="container" style="margin-top:1%;">
  <h2>Imagenes para el carusel</h2>
<form method="post" action="{{ route('storeCarrusel') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="row" style="text-align:left;">
      <div class="col-md-6">
          <div class="form-group">
              <h5>Título:</h5>
              <input type="text" name="Titulo" class="form-control" value="{{ old('Titulo')}}" />
          </div>
          <div class="form-group">
            <h5>Descripción corta:</h5>
            <textarea class="form-control" name="Descripcion" type="text" maxlength="150">{{ old('Descripcion')}}</textarea>
          </div>
          <div class="form-group">
              <h5>Link:</h5>
              <input type="text" name="Link" class="form-control" value="{{ old('Link')}}" />
          </div>
          <h5>¿Qué es?</h5>
          <div class="form-check">
              <input class="form-check-input" type="radio" name="Tipo" value="A" checked required>
              <label class="form-check-label" for="tipo1">
                Aviso
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="Tipo" value="N" required>
              <label class="form-check-label" for="tipo2">
                Noticia
              </label>
            </div>
            <div class="form-check disabled">
              <input class="form-check-input" type="radio" name="Tipo" value="F" required>
              <label class="form-check-label" for="tipo3">
                Para feria de agrupaciones
              </label><br/>
              <small>Se mostrara SOLAMENTE en la página de feria de agrupaciones</small>
            </div>
            <div class="form-check disabled">
              <input class="form-check-input" type="radio" name="Tipo" value="O" required>
              <label class="form-check-label" for="tipo4">
                Otro
              </label>
            </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            <h5>Imagen:</h5>
            <input type="file" class="form-control-file border" name="Imagen" id="imgInp" required>
        </div>
        <div class="form-group">
          <img id="preview" alt="Imagen seleccionada" width="100%" height="100%" />
        </div>
        <div class="form-group" style="text-align:right;">
            <input type="submit" class="btn btn-primary" value="Subir"/>
        </div>
      </div>
   </div>
</form>
</div>
@stop
