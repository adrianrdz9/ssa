@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AIndivi.css')}}" rel="stylesheet"/>
  <h2 style="margin-top:1%;">{{ $data[0]->Nombre }}</h2>
    <h6>{{ $data[0]->Siglas }}</h6>
  <div class="row">
    <div class="col-sm-4" style="margin-left: auto; text-align:center;">
      @if($data[0]->Foto == "")
        <img style="margin-left:5%;"src="{{asset('images/FI.png')}}"
             class="img-responsive" width="80%" height="85%"/>
      @else
        <img style="margin-left:5%;"src="{{asset('images/Agrupaciones/Fotos/'. $data[0]->Foto )}}"
             class="img-responsive" width="80%" height="85%"/>
      @endif
      <br/>
      <div  style="text-align:center; margin-top:5%;">
        <h6>Contacto</h6>
        <a href="{{ $data[0]->Link1 }}" target="_blank"><button class=" btn btn-danger">Visitanos</button></a>
        <a href="{{ $data[0]->Link2 }}" target="_blank" style="margin-left:10%;"><button class=" btn btn-danger">Visitanos</button></a>
      </div>
    </div>
    <div class="col-sm-7" style=" margin-right: auto;">
      <div class="row" style="text-align:center; margin-top:3%;">
        <div class="col-sm-6">
          @foreach ($Inte1 as $Nom)
          <p>
            <h4>{{ $Nom->Nombre }}</h4>
            {{ $Nom->Cargo }}
          </p>
          <br/>
          @endforeach
       </div>
       <div class="col-sm-6">
         @foreach ($Inte2 as $Nom)
         <p>
           <h4>{{ $Nom->Nombre }}</h4>
           {{ $Nom->Cargo }}
         </p>
         <br/>
         @endforeach
      </div>
      <div align="center">
        <img src="{{asset('images/Agrupaciones/Logos/'. $data[0]->Logo )}}"
            class="img-responsive" style="margin:auto;"
            width="30%" height="100%">
      </div>
    </div>
    <div style="margin-top:5%;">
      {{ $data[0]->Descripcion }}
    </div>
  </div>
</div>
@stop
