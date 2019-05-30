@extends('layouts.Agrupaciones')
@section('title','Reclutamientos')
@section('content')

  @if($num == 0)
  <div style="display:block; margin-top:5%; text-align:center;">
     <img src="{{asset('images/no_recluamientos.png' )}}" class="img-fluid">
     <h2>Aún no hay reclutamientos.</h2>
  </div>
  @endif
  <div class="row" style="margin:auto;">
    @foreach ($data as $Info)
    <div class="col-sm-4" style="margin-top:1%;">
        <div class="card border-primary" style="border-radius:2%;">
          <div class="card-header" data-id="{{ $Info->id }}">
            <h3 style="margin-top:1%;"> {{ $Info->Cargo }} </h3>
            <strong> {{ $Info->Siglas }} </strong>
          </div>
          <div class="card-body">
            <p>  {!! $Info->Descripcion !!} </p>
            <p> Cita: <b>{{ $Info->Fecha }}</b> a las <b>{{ $Info->Hora }}</b> en <b>{{ $Info->Lugar }}</b></p>
            <h4>Requisitos</h4>
            <ul style="list-style-type:circle">
              <li>Semestre: {{ $Info->Semestre }}</li>
              <li>Propmedio: {{ $Info->Promedio }}</li>
              <li>Conocimientos: {{ $Info->Conocimientos }}</li>
            </ul>
          </div>
          <div class="card-footer" style="text-align:right;">
              <a href="{{ route('reclutamiento',['id'=> $Info->id])}}"><button class="btn btn-primary btn-block">Ver más</button></a>
          </div>
      </div>
    </div>
    @endforeach
  </div>
@stop
