@extends('layouts.Agrupaciones')
@section('title','Editar carusel')
@section('content')
<div class="row">
    @foreach($data as $dato)
    <div class="col-sm-4">
        <div class="card border-danger" style="border-radius:2%;">
            <div class="card-img-top">
                <img src="{{asset('images/Carusel/'.$dato->Imagen )}}" alt="" class="img-fluid" style="border-radius:2%;">
            </div>
            <div class="card-body">
                  <h3>{!! $dato->Titulo !!}</h3>
                  <p>{!! $dato->Descripcion !!}</p>
            </div>
            <div class="card-footer" style="text-align:right;" data-id="{{ $dato->id }}">
               @if($dato->Estado == "1")
                <button class="btn btn-warning OcultarC">Ocultar</button>
               @else
                <button class="btn btn-info MostrarC">Mostrar</button>
               @endif
                <a href="{{ route('editCarrusel',['id'=> $dato->id]) }}"><button type="button" class="btn btn-primary">Editar</button></a>
                <button class="btn btn-danger EliminarC">Eliminar</button>
            </div>
        </div>
         <br/>
    </div>
   @endforeach
</div>
@stop
