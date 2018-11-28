@extends('layouts.visitantes')
@section('title','Historial')
@section('content')
  @foreach ($data as $Info)
  <div class="row" style="margin-left:1%; margin-right:1%; margin-top:1%; margin-bottom:1%;">
  <div class="col-sm-3">
    <img src="{{asset('images/Noticias'.$Info->ImagenC)}}" class="img-responsive" width="100%" height="100%">
  </div>
  <div class="offset-sm-1"></div>
  <div class="col-sm-8" style="background-color:#e0e0e0; border-radius: 10px; text-align:center;">
    <h3> {{ $Info->Titulo }} </h3> <hr/>
    <p>  {{ $Info->DescripcionCorta }}</p>
    <div style="text-align:right; margin-bottom:1%;">
        <a href='Noticia/id/{{ $Info->Folio }}'><button class="btn btn-card">Ver más</button></a>
    </div>
  </div>
  </div>
  @endforeach
@stop
