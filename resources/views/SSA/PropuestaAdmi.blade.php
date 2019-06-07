@extends('layouts.Agrupaciones')
@section('title','Propuestas')
@section('content')
<h3 style="margin-top:1%;">Propuestas para la Feria de Agrupaciones</h3>
   @if($Mensaje == "Ya no se recibiran propuestas." || $Mensaje == "Aún no hay fechas.")
   <div class="container">
     <div class="alert alert-danger">
       <h4> {{ $Mensaje }} </h4>
     </div>
      <h1>Establece una nuevas fechas para la próxima feria</h1>
        <h4>Feria de Agrupaciones</h4>
            <form method="post" action="{{ route('NFeria') }}">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="form-group col-md-10">
                  <h4>Titulo</h4>
                  <input class="form-control" name="Nombre" type="text" value="{{ old('Nombre')}}" required>
                </div>
                <div class="form-group col-md-6">
                  <h4>Aceptar propuestas desde:</h4>
                  <input class="form-control" type="date" name="FechaI" value="{{ old('FechaI')}}" required>
                </div>
                <div class="form-group col-md-6">
                  <h4>Aceptar propuestas hasta:</h4>
                  <input class="form-control" type="date" name="FechaL" value="{{ old('FechaL')}}" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </form>
    </div>
  @else
    @if($Mensaje!= "")
        <div class="alert alert-danger">
          <h4> {{ $Mensaje }} </h4>
        </div>
    @endif
    @if($Propuestas != [])
    <div class="row">
      @for ($i = 0; $i < $Contar; $i++)
        @if($Propuestas["\x00*\x00items"][$i]->Estado == "Pendiente")
            @component('SSA._propuestaTile', [ 'propuesta' => $Propuestas["\x00*\x00items"][$i]])
                <button type="button" class="btn btn-success AceptarP">Aceptar</button>
                <button type="button" class="btn btn-info Comunicate">Comunicate con nosotros</button>
            @endcomponent
        @endif
        @if($Propuestas["\x00*\x00items"][$i]->Estado == "Aprobada")
            @component('SSA._propuestaTile', [ 'propuesta' => $Propuestas["\x00*\x00items"][$i]])
            @endcomponent
        @endif
        @if($Propuestas["\x00*\x00items"][$i]->Estado == "Comunicate")
            @component('SSA._propuestaTile', [ 'propuesta' => $Propuestas["\x00*\x00items"][$i]])
                <button type="button" class="btn btn-success AceptarP">Aceptar</button>
            @endcomponent
        @endif
      @endfor
    @endif
  </div>
 @endif
@stop
