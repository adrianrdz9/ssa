@extends('layouts.Agrupaciones')
@section('content')
<div class="row">
  @foreach($dato as $info)
  <div class="col-sm-4">
    <div class="card border-danger" style="border-radius:2%;">
      <div class="card-img-top">
        @if(is_null($info->ImagenC))
        <img src="{{asset('images/Inge.png')}}" class="img-fluid" width="100%" height="100%" style="border-radius:2%;">
        @else
          <img src="{{asset('images/Noticias/'.$info->ImagenC)}}" class="img-fluid" width="100%" height="100%" style="border-radius:2%;">
        @endif
      </div>
      <div class="card-body">
        <h3>{{ $info->Titulo }}</h3>
        <p>{!! $info->DescripcionCorta !!}</p>
      </div>
      <div class="card-footer"style="text-align:right;" data-id="{{ $info->id }}">
        @if( $info->Disponible == "1")
            <button type="button" class="btn btn-warning Ocultar">Ocultar</button>
        @else
            <button type="button" class="btn btn-info Mostrar">Mostrar</button>
        @endif
        <a href="{{ route('editNoticia',['id'=> $info->id])}}"><button type="button" class="btn btn-primary">Editar</button></a>
        <button class="btn btn-danger EliminarNoticia">Eliminar</button>
      </div>
    </div>
  </div>
  @endforeach
</div>
@stop
