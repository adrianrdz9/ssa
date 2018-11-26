@extends('layouts.Admi')
@section('title','Propuestas')
@section('content')
<h3>Propuestas para la Feria de Agrupaciones</h3>
<div>
  @if($Propuestas != [])
    @foreach ($Propuestas as $value)
      @if($value->Estado == "Pendiente")
      <div class="card" data-id="{{ $value->id }}">
        <div class="card-header">{{ $value->Titulo }} por {{ $value->Siglas}}</div>
        <div class="card-body" style="text-align:left;">
          <p class="card-text">{{ $value->Descripcion }}</p>
          <b>Contacto:</b> <br/>
          <p style="margin-left:3%;">
            Presidente: Pablo Neruda <br/>
            Celular: 5528072878 <br/>
            Email: pablo@comunidad.unam.mx <br/>
          </p>
        </div>
         <div class="card-footer" style="text-align:right;" data-id="{{ $value->id }}">
          <button type="button" class="btn btn-success Aceptar">Aceptar</button>
          <button type="button" class="btn btn-info Comunicate">Comunicate con nosotros</button>
        </div>
      </div>
      @endif
      @if($value->Estado == "Aprobada")
      <div class="card" data-id="{{ $value->id }}">
        <div class="card-header">{{ $value->Titulo }} por {{ $value->Siglas}}</div>
        <div class="card-body" style="text-align:left;">
          <p class="card-text">{{ $value->Descripcion }}</p>
          <b>Contacto:</b> <br/>
          <p style="margin-left:3%;">
            Presidente: Pablo Neruda <br/>
            Celular: 5528072878 <br/>
            Email: pablo@comunidad.unam.mx <br/>
          </p>
        </div>
      </div>
      @endif
      @if($value->Estado == "Comunicate")
      <div class="card" data-id="{{ $value->id }}">
        <div class="card-header">{{ $value->Titulo }} por {{ $value->Siglas}}</div>
        <div class="card-body" style="text-align:left;">
          <p class="card-text">{{ $value->Descripcion }}</p>
          <b>Contacto:</b> <br/>
          <p style="margin-left:3%;">
            Presidente: Pablo Neruda <br/>
            Celular: 5528072878 <br/>
            Email: pablo@comunidad.unam.mx <br/>
          </p>
        </div>
         <div class="card-footer" style="text-align:right;" data-id="{{ $value->id }}">
          <button type="button" class="btn btn-success Aceptar">Aceptar</button>
        </div>
      </div>
      @endif
    @endforeach
   @else
     <div>
       @if($Mensaje == "Ya no se recibiran propuestas" )
          <h4> {{ $Mensaje }} </h4>
          <button type="button" class="btn btn-success Crear">
            Establece una nuevas fechas para la próxima feria
          </button>
      @else
        <h4> {{ $Mensaje }} </h4>
      @endif
    </div>
   @endif
</div>
<script>
  $('.Aceptar').click(function () {
  let id = $(this).parents('div').data('id');
    $.ajax({
      url: "/statusA/id/" + id,
      method: "get"
    }).done(()=>{
        $(this).closest('.card-footer').remove();
    });
  });
  $('.Comunicate').click(function () {
  let id = $(this).parents('div').data('id');
    $.ajax({
      url: "/statusC/id/" + id,
      method: "get"
    }).done(()=>{
        $(this).closest('.btn-info').remove();
    });
  });
</script>
@stop
