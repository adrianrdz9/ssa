@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AIndivi.css')}}" rel="stylesheet"/>
  <h2>{{ $data[0]->Nombre }}</h2>
    <h6>{{ $data[0]->Siglas }}</h6>
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;">
      <img src="{{asset('images/FI.png')}}" class="img-responsive">
      <br/>
      <div>
          Descripcion: <br/>
          <p>{{ $data[0]->Descripcion }}</p>
      </div>
    </div>
    <div class="col-sm-7" style="background-color:lavenderblush;">
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
        <div class="col-sm-6">
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
        </div>
      </div>
      <div align="center">
        <img src="{{asset('images/Logo.png')}}" class="img-responsive" width="50%" height="95%">
      </div>
    </div>
  </div>
</div>
@stop
