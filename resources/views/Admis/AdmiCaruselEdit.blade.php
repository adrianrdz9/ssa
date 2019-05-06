@extends('layouts.Agrupaciones')
@section('title','Editar carusel')
@section('content')
<section class="details-card">
        <div class="row">
            @foreach($data as $dato)
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{asset('images/Carusel/'. $dato->Imagen )}}" alt="" class="img-fluid">
                    </div>
                    <div class="card-desc">
                          <h3>{!! $dato->Titulo !!}</h3>
                          <p>{!! $dato->Descripcion !!}</p>
                      <div style="text-align:right;" data-id="{{ $dato->id }}">
                         @if($dato->Estado == "1")
                          <button class="btn btn-warning OcultarC">Ocultar</button>
                         @else
                          <button class="btn btn-info MostrarC">Mostrar</button>
                         @endif
                          <a href="/agrupaciones/EImagenC/id/{{ $dato->id }}"><button type="button" class="btn btn-primary">Editar</button></a>
                          <button class="btn btn-danger EliminarC">Eliminar</button>
                      </div>
                    </div>
                </div>
                 <br/>
            </div>
           @endforeach
        </div>
</section>
@stop
