@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AgrupaGnral.css')}}" rel="stylesheet"/>
<div class="row">
      <div class="col-sm-3" style="background-color:lavender;">
        <img src="{{asset('images/Logo.png')}}" class="img-responsive"
          style="max-width: 115%; max-height: 182%; align:left;">
      </div>
      <div class="col-sm-1 offset-sm-1"></div>
      <div class="col-sm-8">
        @foreach ($data as $Info)
        <div class="col" style="background-color:#e0e0e0;">
          <h3> {{ $Info->Siglas }} </h3> <hr/>
          <p>  {{ $Info->Nombre }}</p>
          <p>
            <button type="button" class="btn btn-info">
              Más información
            </button>
          </p>
        </div>
        @endforeach
      </div>
</div>

@stop
