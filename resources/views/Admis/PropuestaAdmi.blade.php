@extends('layouts.Admi')
@section('title','Propuestas')
@section('content')
<h3 style="margin-top:1%;">Propuestas para la Feria de Agrupaciones</h3>
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
            @foreach ($Presidente as $Info)
              Presidente: {{ $Info->Nombre }} <br/>
              Celular: {{ $Info->Numero }} <br/>
              Email: {{ $Info->Email }}
            @endforeach
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
       @if($Mensaje == "Ya no se recibiran propuestas." || $Mensaje == "Aún no hay fechas.")
         <div class="alert alert-danger">
           <h4> {{ $Mensaje }} </h4>
         </div>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#NFeria">
            Establece una nuevas fechas para la próxima feria
          </button>
      @else
        <div class="alert alert-danger">
          <h4> {{ $Mensaje }} </h4>
        </div>
      @endif
    </div>
   @endif
</div>

<div class="modal fade" id="NFeria">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Feria de Agrupaciones</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ url('agrupaciones/NFeria') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Titulo:</label>
            <input type="text" name="Nombre" class="form-control" required>
          </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Fecha inicio de propuestas:</label>
              <input type="date" name="FInicio" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Fecha fin de propuestas:</label>
              <input type="date" name="FLimite" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('.Aceptar').click(function () {
  let id = $(this).parents('div').data('id');
    $.ajax({
      url: "/statusA/id/" + id,
      method: "get"
    }).done(()=>{
      swal(
        'Exito!',
        'Propuesta aceptada',
        'success'
        )
        $(this).closest('.card-footer').remove();
    });
  });
  $('.Comunicate').click(function () {
  let id = $(this).parents('div').data('id');
    $.ajax({
      url: "/statusC/id/" + id,
      method: "get"
    }).done(()=>{
      swal(
          'Exito!',
          'Se enviara la notificaciòn correspondiente',
          'success'
        )
        $(this).closest('.btn-info').remove();
    });
  });
</script>
@stop
