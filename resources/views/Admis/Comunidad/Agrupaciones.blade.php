@extends('layouts.Agrupaciones')
@section('content')
<div class="row">
    @foreach($data as $dato)
    <div class="col-sm-4" style="margin-top:1%;">
        <div class="card border-info" style="border-radius:2%;">
            <div class="card-img-top" data-id="{{ $dato->id }}">
              @if (is_null($dato->ImagenC ))
                <img src="{{asset('images/Inge.png' )}}" alt="" class="img-fluid" style="border-radius:2%;">
              @endif
                <img src="{{asset('images/Noticias/'. $dato->ImagenC )}}" alt="" class="img-fluid" style="border-radius:2%;">
            </div>
            <div class="card-body">
              <div class="card-title">
                  <h3>{{ $dato->Titulo }}</h3>
                  <p>{!! $dato->DescripcionCorta !!}</p>
              </div>
              <div class="card-text">
                  <h6>{{ date('d/m/Y', strtotime($dato->Fecha)) }}</h6>
                  @if($dato->Principal == 1)
                  <a href='Eliminar/id/{{ $dato->id }}'><button class="btn btn-block btn-info">Quitar de la página principal</button></a>
                  @else
                   <a href='Agregar/id/{{ $dato->id }}'><button class="btn btn-block btn-info">Agregar a la página principal</button></a>
                  @endif
              </div>
            </div>
        </div>
    </div>
   @endforeach
</div>
@stop
