@extends('layouts.Admi')
@section('title','Restablecer contraseñas')
@section('content')
<link href="{{asset('css/AgrupaGnral.css')}}" rel="stylesheet"/>
<div class="row">
  @foreach ($data as $Info)
    <div class="col-sm-4"style=" border-radius: 10px; margin:auto;">
      <img src="{{asset('images/Agrupaciones/Logos/'.$Info->Logo)}}" class="img-responsive"
      width="80%" height="50%">
    </div>
      <div class="col-sm-7"style="background-color:#e0e0e0; border-radius: 10px; margin:auto; margin-top:1%;">
          <h3> {{ $Info->Siglas }} </h3> <hr/>
          <p>  {{ $Info->Nombre }}</p>
          <p>
            <a href="Agrupacion/id/{{ $Info->Siglas }}"><button type="button" class="btn btn-info">
              Más información
            </button></a>
          </p>
          <br/>
      </div>
    <br/>
  @endforeach
</div>
@stop
