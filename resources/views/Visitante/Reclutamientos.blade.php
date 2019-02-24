@extends('layouts.visitantes')
@section('title','Reclutamientos')
@section('content')

  @if($num == 0)
  <div style="display:block; margin-top:5%; text-align:center;">
     <img src="{{asset('images/no_recluamientos.png' )}}" class="img-fluid">
     <h2>Aún no hay reclutamientos.</h2>
  </div>
  @endif
  @foreach ($data as $Info)
  <div class="row" style="margin-left:1%; margin-right:1%; margin-top:1%; margin-bottom:1%;">
    <div class="col-sm-12" style="background-color:#e0e0e0; border-radius: 10px; text-align:left;">
      <h3 style="margin-top:1%;"> {{ $Info->Cargo }} </h3> <hr/>
      <p>  {{ $Info->Descripcion }} </p>
      <p> Cita: <b>{{ $Info->Fecha }}</b> a las <b>{{ $Info->Hora }}</b> en <b>{{ $Info->Lugar }}</b>
      </p>
      <ul style="list-style-type:circle">
        <li><b>Semestre:</b> {{ $Info->Semestre }}</li>
        <li><b>Promedio:</b> {{ $Info->Promedio }}</li>
        <li><b>Conocimientos previos:</b> {{ $Info->Conocimientos }}</li>
      </ul>
      <div style="text-align:right; margin-bottom:1%;">
        <a href='Reclutamiento/id/{{ $Info->id }}'><button class="btn btn-card">Ver más</button></a>
      </div>
    </div>
  </div>
  @endforeach
@stop