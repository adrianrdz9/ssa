@extends('layouts.visitantes')
@section('title','Noticias')
@section('content')
<div id="demo" class="carousel slide container" data-ride="carousel" style="margin-top: 1%;">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    @for ($c = 1; $c <= $numero; $c++)
      <li data-target="#demo" data-slide-to="{{ $c }}"></li>
    @endfor
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="https://www.youtube.com/watch?v=Ad3St7UJ9p0" target="_blank">
        <img src="{{asset('images/carucero.jpeg')}}" alt="Welcome" width="1100" height="566" class="img-fluid">
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
          width="1100" height="500" class="img-fluid">
        </a>
        <div class="carousel-caption">
          <h3>{{ $images->Titulo}}</h3>
          <p>{{ $images->Descripcion}}</p>
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
<section class="details-card container">
        <div class="row">
            @foreach($data as $dato)
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img" data-id="{{ $dato->Folio }}">
                      @if (is_null($dato->ImagenC ))
                        <img src="{{asset('images/Inge.png' )}}" alt="">
                      @endif
                        <img src="{{asset('images/Noticias/'. $dato->ImagenC )}}" alt="">
                    </div>
                    <div class="card-desc">
                        <h3>{{ $dato->Titulo }}</h3>
                        <p>{{ $dato->DescripcionCorta }}</p>
                    <div style="text-align:right;">
                        <h6>{{ $dato->Fecha }}</h6>
                        <a href='Noticia/id/{{ $dato->Folio }}'><button class="btn btn-card">Ver más</button></a>
                    </div>
                    </div>
                </div>
                 <br/>
            </div>
           @endforeach
        </div>
</section>
@stop
