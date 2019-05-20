@extends('layouts.Agrupaciones')
@section('content')
<div class="row">
  @foreach($dato as $info)
  <div class="col-sm-4">
    <div class="card-border-danger">
      <div class="card-img-top">
        @if(is_null($info->ImagenC))
        <img src="{{asset('images/Inge.png')}}" class="img-responsive" width="100%" height="100%">
        @else
          <img src="{{asset('images/Noticias/'.$info->ImagenC)}}" class="img-responsive" width="100%" height="100%">
        @endif
      </div>
      <div class="card-body">
        <div class="card-title">
          <h3>{!! $info->Titulo !!}</h3>
        </div>
        <div class="card-text">
          <p>{!! $info->DescripcionCorta !!}</p>
        </div>
      </div>
      <div class="card-footer"style="text-align:right;" data-id="{{ $info->id }}">
        <a href="{{ route('editNoticia',['id'=> $info->id])}}"><button type="button" class="btn btn-primary">Editar</button></a>
        <button class="btn btn-danger EliminarNoticia">Eliminar</button>
      </div>
    </div>
  </div>
  @endforeach
</div>
@stop
