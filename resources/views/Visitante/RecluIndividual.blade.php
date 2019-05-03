@extends('layouts.Agrupaciones')
@section('title','Reclutamientos')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Inconsolata|PT+Sans+Narrow|PT+Serif" rel="stylesheet">
  <h1 style="font-family: 'PT Serif', serif; text-align:center; margin-top:1%;">
    {{ $data[0]->Cargo }}
  </h1>
  <h3 style="font-family: 'PT Serif', serif; text-align:center; margin-top:1%;">
    {{ $Agrupa[0]->Nombre }}
  </h3>
  <div class="row">
    <div class="col-sm-4" style="margin-left: auto; text-align:center;">
      <img src="{{asset('images/FI.png' )}}" class="img-fluid">
    </div>
    <div class="col-sm-6" style="margin-left: auto; text-align:center;">
      <div style="margin-left:7%;">
           {{ $data[0]->Descripcion }}
      </div>
      <p><b>{{ $data[0]->Fecha }}</b> a las <b>{{ $data[0]->Hora }}</b> en <b>{{ $data[0]->Lugar }}</b>
      </p>
      <h4>Requisitos</h4>
      <dl style="text-align:left;">
        <dt>Semestre:</dt>
          <dd>{{ $data[0]->Semestre }} semestre</dd>
        <dt>Promedio:</dt>
          <dd>{{ $data[0]->Promedio }}</dd>
        <dt>Conocimientos previos:</dt>
            <dd>{{ $data[0]->Conocimientos }}</dd>
        @if($data[0]->Disponibilidad != "No")
            <dt>Disponibilidad de horario.</dt>
        @endif
      </dl>
    </div>
  </div>
@stop
