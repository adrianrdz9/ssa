<<<<<<< HEAD
@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AgrupaGnral.css')}}" rel="stylesheet"/>
<div class="row">
  @foreach ($data as $Info)
  <div class="col-sm-12" style="margin-top:1%;">
      <div class="col-sm-3">
        <img src="{{asset('images/Agrupaciones/Logos/'.$Info->Logo)}}" class="img-responsive">
      </div>
      <div class="col-sm-1 offset-sm-1"></div>
      <div class="col-sm-8"style="background-color:#e0e0e0; border-radius: 10px;">
          <h3> {{ $Info->Siglas }} </h3> <hr/>
          <p>  {{ $Info->Nombre }}</p>
          <p>
            <a href="Agrupacion/id/{{ $Info->Siglas }}"<button type="button" class="btn btn-info">
              Más información
            </button></a>
          </p>
      </div>
   </div>
  @endforeach
</div>

@stop
=======
@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AgrupaGnral.css')}}" rel="stylesheet"/>
  @foreach ($data as $Info)
  <div class="row" style="margin-left:1%; margin-right:1%; margin-top:1%; margin-bottom:1%;">
  <div class="col-sm-3">
    <img src="{{asset('images/Agrupaciones/Logos/'.$Info->Logo)}}" class="img-responsive" width="100%" height="100%">
  </div>
  <div class="offset-sm-1"></div>
  <div class="col-sm-8" style="background-color:#e0e0e0; border-radius: 10px; text-align:center;">
    <h3> {{ $Info->Siglas }} </h3> <hr/>
    <p>  {{ $Info->Nombre }}</p>
    <p>
      <a href="Agrupacion/id/{{ $Info->Siglas }}"><button type="button" class="btn btn-info">
        Más información
      </button></a>
    </p>
  </div>
</div>
  @endforeach
@stop
>>>>>>> Propuestas
