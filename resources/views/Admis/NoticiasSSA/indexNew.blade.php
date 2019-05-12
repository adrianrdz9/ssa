@extends('layouts.Agrupaciones')
@section('title','Noticias')
@section('content')
  @foreach ($data as $Info)
  <div class="row" style="margin-left:1%; margin-right:1%; margin-top:1%; margin-bottom:1%;">
  <div class="col-sm-3">
    @if($Info->ImagenC=="")
    <img src="{{asset('images/Inge.png')}}" class="img-responsive" width="100%" height="100%">
    @else
      <img src="{{asset('images/Noticias/'.$Info->ImagenC)}}" class="img-responsive" width="100%" height="100%">
    @endif
  </div>
  <div class="offset-sm-1"></div>
    <div class="col-sm-8" style="background-color:#e0e0e0; border-radius: 10px; text-align:center;">
      <h3 style="margin-top:1%;"> {{ $Info->Titulo }} </h3> <hr/>
      <p>  {!! $Info->DescripcionCorta !!}</p>
      <div style="margin-top:1%; margin-bottom:1%; text-align:right;" data-id="{{ $Info->id }}">
        @if( $Info->Disponible == "1")
            <button type="button" class="btn btn-warning Ocultar">Ocultar</button>
        @else
            <button type="button" class="btn btn-info Mostrar">Mostrar</button>
        @endif
            <button type="button" class="btn btn-danger btn-block EliminarNoticia">Eliminar</button>
            <a href="{{ route('editNew',['id'=> $Info->id])}}"><button type="button" class="btn btn-primary">Editar</button></a>
      </div>
    </div>
  </div>
  @endforeach
@stop
