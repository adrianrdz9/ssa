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
        <form class="form-inline" method="post" action="{{ url('agrupaciones/AdmiMsjG') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-group">
            <textarea rows="2" cols="57" class="form-control" name="Mensaje"></textarea>
          </div>
          <div class="form-group" style="margin:auto;">
            <input type="file" class="form-control-file" name="Archivo" accept=".pdf,.jpg,.png">
          </div>
          <button type="submit" class="btn btn-primary mb-1" style="margin-top:1%;">Enviar</button>
        </form>
      </div>
    </div>
  </div>
    <!-- For each para chats con mensajes no leidos -->
  <div class="col-6 col-md-3" style="background-color:pink;">
  </div>
</div>
@stop
