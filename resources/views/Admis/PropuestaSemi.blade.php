@extends('layouts.semiAdmi')
@section('title','Propuestas')
@section('content')
<h3>Propuestas para la Feria de Agrupaciones Esdiantiles</h3>
@if($Mensaje != "Ya no es posible enviar propuestas.")
  <div style="text-align:right; margin-right:3%;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NPropuesta">
        Realizar una propuesta
    </button>
  </div>
@else
  <h3>{{ $Mensaje }}</h3>
@endif
<h5>Estado de propuestas</h5>
<div>
  @foreach ($data as $value)
    @if($value->Estado == "Pendiente")
    <div class="alert alert-info">
      <label>{{ $value->Titulo }}</label><br/>
      <strong>En proceso.</strong>
    </div>
    @endif
    @if($value->Estado == "Aprobada")
    <div class="alert alert-success">
      <label>{{ $value->Titulo }}</label><br/>
      <strong>Aprobada.</strong>
    </div>
    @endif
    @if($value->Estado == "Comunicate")
    <div class="alert alert-warning">
      <label>{{ $value->Titulo }}</label><br/>
      <strong>Comunicate con la Secretaria de Servicios Academicos a la brevedad.</strong>
    </div>
    @endif
  @endforeach
</div>

  <div class="modal fade" id="NPropuesta">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nueva propuesta para la Feria de Agrupaciones</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ url('NPropuesta') }}">
            {{ csrf_field() }}
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" name="Titulo">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Descripción:</label>
                <textarea class="form-control" name="Descripcion"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
