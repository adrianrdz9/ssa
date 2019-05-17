@extends('layouts.Agrupaciones')
@section('title','Reclutamientos')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Inconsolata|PT+Sans+Narrow|PT+Serif" rel="stylesheet">
  <h1 style="font-family: 'PT Serif', serif; text-align:center; margin-top:1%;">
    {{ $data[0]->Cargo }}
  </h1>
  <h3 style="font-family: 'PT Serif', serif;margin-top:1%;">
    {{ $Agrupa[0]->Nombre }}
  </h3>
  <div class="row" style="margin:auto;">
    <div class="col-sm-4" style="margin-left: auto; text-align:center;">
      <img src="{{asset('images/logo_fi.png' )}}" class="img-fluid">
    </div>
    <div class="col-sm-8" style="margin-left: auto; text-align:center;">
      <div style="margin-top:3%;">
           {!! $data[0]->Descripcion !!}
      </div>
      <p>Cita el día <b>{{ $data[0]->Fecha }}</b> a las <b>{{ $data[0]->Hora }}</b> en el <b>{{ $data[0]->Lugar }}</b></p>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
              <th>Requisitos</th>
          </thead>
          <tbody>
            <tr>
              <td>Semestre</td>
              <td>{{ $data[0]->Semestre }}</td>
            </tr>
            <tr>
              <td>Promedio</td>
              <td>{{ $data[0]->Promedio }}</td>
            </tr>
            <tr>
              <td>Conocimientos previos</td>
              <td>{{ $data[0]->Conocimientos }}</td>
            </tr>
            @if($data[0]->Disponibilidad != "No")
            <tr>
              <td>Disponibilidad de horario</td>
              <td>Requerida</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
@stop
