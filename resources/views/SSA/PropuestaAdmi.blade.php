@extends('layouts.Agrupaciones')
@section('title','Propuestas')
@section('content')
<h3 style="margin-top:1%;">Propuestas para la Feria de Agrupaciones</h3>
<div class="row">
  @if($Propuestas != [])
    @for ($i = 0; $i < $Contar; $i++)
      @if($Propuestas["\x00*\x00items"][$i]->Estado == "Pendiente")
          @component('SSA._propuestaTile', [ 'propuesta' => $Propuestas["\x00*\x00items"][$i]])
              <button type="button" class="btn btn-success Aceptar">Aceptar</button>
              <button type="button" class="btn btn-info Comunicate">Comunicate con nosotros</button>
          @endcomponent
      @endif
      @if($Propuestas["\x00*\x00items"][$i]->Estado == "Aprobada")
          @component('SSA._propuestaTile', [ 'propuesta' => $Propuestas["\x00*\x00items"][$i]])
          @endcomponent
      @endif
      @if($Propuestas["\x00*\x00items"][$i]->Estado == "Comunicate")
          @component('SSA._propuestaTile', [ 'propuesta' => $Propuestas["\x00*\x00items"][$i]])
              <button type="button" class="btn btn-success Aceptar">Aceptar</button>
          @endcomponent
      @endif
    @endfor
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
        <form method="post" action="{{ route('NFeria') }}">
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

@stop
