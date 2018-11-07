@extends('layouts.semiAdmi')
@section('title','Información de la agrupación')
@section('content')
<h3 style="text-align:center;">{{ auth()->user()->Nombre }}</h3>
<form method="post" action="{{ url('InfoGeneral') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="row" style="text-align:left;">
      <div class="col-md-6">
          <div class="form-group">
              <h5>Logo de la Agrupación:</h5>
              <input type="file" class="form-control-file border" name="Logo">
          </div>
          <div class="form-group">
             <h5>Fotografía representativa:</h5>
             <input type="file" class="form-control-file border" name="Foto">
          </div>
          <div class="form-group">
              <h5>Link red social:</h5>
              <input type="text" name="Link1" class="form-control" placeholder="" />
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            <h5>Descripción:</h5>
            <textarea name="Descripcion" class="form-control" placeholder="" style="width: 100%; height: 110px;" maxlength="500"></textarea>
        </div>
        <div class="form-group">
            <h5>Link red social:</h5>
            <input type="text" name="Link2" class="form-control" placeholder="" />
        </div>
        <div class="form-group" style="text-align:right;">
            <input type="submit" class="btn btn-primary" value="Actualizar"/>
        </div>
      </div>
   </div>
</form>

<form method="post" action="{{ url('Integrantes') }}">
  {{ csrf_field() }}
    <div class="row" style="text-align:left;">
      <div class="col-md-6">
          <div class="form-group">
              <input type="text" name="Cargo1" class="form-control" placeholder="Cargo" />
              <input type="text" name="Nombre1" class="form-control" placeholder="Nombre" />
          </div>
          <div class="form-group">
              <input type="text" name="Cargo2" class="form-control" placeholder="Cargo" />
              <input type="text" name="Nombre2" class="form-control" placeholder="Nombre" />
          </div>
          <div class="form-group">
              <input type="text" name="Cargo3" class="form-control" placeholder="Cargo" />
              <input type="text" name="Nombre3" class="form-control" placeholder="Nombre" />
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            <input type="text" name="Cargo4" class="form-control" placeholder="Cargo" />
            <input type="text" name="Nombre4" class="form-control" placeholder="Nombre" />
        </div>
        <div class="form-group">
            <input type="text" name="Cargo5" class="form-control" placeholder="Cargo" />
            <input type="text" name="Nombre5" class="form-control" placeholder="Nombre" />
        </div>
        <div class="form-group">
            <input type="text" name="Cargo6" class="form-control" placeholder="Cargo" />
            <input type="text" name="Nombre6" class="form-control" placeholder="Nombre" />
        </div>
        <div class="form-group" style="text-align:right;">
            <input type="submit" class="btn btn-primary" value="Actualizar"/>
        </div>
      </div>
   </div>
</form>
@stop