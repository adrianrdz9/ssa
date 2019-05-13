@extends('layouts.Agrupaciones')
@section('content')
<div id="demo" class="carousel slide" data-ride="carousel" style="width:100%;">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    @for ($c = 1; $c <= $numero; $c++)
      <li data-target="#demo" data-slide-to="{{ $c }}"></li>
    @endfor
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="https://www.youtube.com/watch?v=Ad3St7UJ9p0" target="_blank">
        <img src="{{asset('images/carucero.jpeg')}}" alt="Welcome"class="img-fluid">
      </a>
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
      @foreach($images as $images)
      <div class="carousel-item">
        <a href="{{ $images->Link }}" target="_blank">
          <img src="{{asset('images/Carusel/'. $images->Imagen )}}" alt="{{ $images->Titulo}}"
          width="100%" height="10%" class="img-fluid">
        </a>
        <div class="carousel-caption">
          <h3>{!! $images->Titulo !!}</h3>
          <p>{!! $images->Descripcion !!}</p>
        </div>
      </div>
      @endforeach
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
</div>
  <div class="row">
      @foreach($data as $dato)
      <div class="col-sm-4"  style="margin-top:1%;">
          <div class="card border-primary" style="border-radius:2%;">
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
                    <a href='/agrupaciones/Noticia/id/{{ $dato->id }}'><button class="btn btn-block btn-primary">Ver más</button></a>
                </div>
              </div>
          </div>
      </div>
     @endforeach
  </div>
@stop
