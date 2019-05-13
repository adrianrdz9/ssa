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
        <img src="{{asset('images/Feria.jpg')}}" alt="Welcome"class="img-fluid">
      </a>
      <div class="carousel-caption">
      </div>
    </div>
    @foreach($carrusel as $images)
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
<div class="table-responsive">
  <table class="table" style="margin-top:1%;">
    <thead class="thead-dark">
       <tr>
         <th scope="col">Evento</th>
         <th scope="col">Lugar</th>
         <th scope="col">Fecha</th>
         <th scope="col">Hora</th>
       </tr>
     </thead>
   <tbody>
     @foreach ($eventos as $evento)
       <tr>
         <td>{{ $evento->Evento }}</td>
         <td>{{ $evento->Lugar }}</td>
         <td>{{ date("d/m/Y", strtotime($evento->Dia)) }}</td>
         <td>{{ $evento->Hora }}</td>
       </tr>
     @endforeach
   </tbody>
  </table>
</div>
@stop
