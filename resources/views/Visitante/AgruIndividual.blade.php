@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AIndivi.css')}}" rel="stylesheet"/>
  <h2>{{ $data[0]->Nombre }}</h2>
    <h6>{{ $data[0]->Siglas }}</h6>
  <div class="row">
    <div class="col-sm-4">
      <img src="{{asset('images/Agrupaciones/Fotos/'. $data[0]->Foto )}}" class="img-responsive">
      <br/>
      <div>
          Descripcion: <br/>
          <p>{{ $data[0]->Descripcion }}</p>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <h3>Integrantes</h3>
        <div class="col-sm-6">
          @foreach ($inte as $Nom)
          <p>
            <h4>{{ $Nom->Cargo }}</h4>
                {{ $Nom->Nombre }}
          </p>
          <br/>
          @endforeach
       </div>
      <div align="center">
        <img src="{{asset('images/Agrupaciones/Logos/'. $data[0]->Logo )}}" class="img-responsive" width="50%" height="95%">
      </div>
    </div>
  </div>
</div>
<div>
  <h6>Contacto</h6>
  {{ $data[0]->Link1 }}
  <br/>
  {{ $data[0]->Link2 }}
</div>
@stop
