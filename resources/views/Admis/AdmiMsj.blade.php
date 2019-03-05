@extends('layouts.Admi')
@section('title','Mensajes')
@section('content')
<div class="row" style="margin:auto;margin-top:1%;">
  <!-- Chats -->
  <div class="col-12 col-md-8" style="background-color:red;">
    <div class="card">
      <div class="card-header">
        Siglas de la agripacion
      </div>
      <div class="card-body">
        <!-- Mensajes -->
      </div>
      <div class="card-footer">
        <form class="form-inline" name="formulario" method="post" action="" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" class="form-control" size="55">
          </div>
          <div class="form-group" style="margin:auto;">
            <input type="file" class="form-control-file" name="adjunto" accept=".pdf,.jpg,.png" multiple>
          </div>
          <button type="submit" class="btn btn-primary mb-1" style="margin:auto;">Enviar</button>
        </form>
      </div>
    </div>
  </div>
    <!-- For each para chats con mensajes no leidos -->
  <div class="col-6 col-md-3" style="background-color:pink;">
  </div>
</div>
@stop
