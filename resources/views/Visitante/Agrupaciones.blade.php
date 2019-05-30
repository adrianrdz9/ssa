@extends('layouts.Agrupaciones')
@section('content')
<div class="card-columns">
  @foreach ($data as $Info)
    <div class="card border-primary">
        @if($Info->Logo == "")
          <img src="{{asset('images/Inge.png')}}" class="card-img-top">
        @else
          <img src="{{asset('images/Agrupaciones/Logos/'.$Info->Logo)}}" class="card-img-top">
        @endif
        <div class="card-body">
          <h5 class="card-title"> {{ $Info->Siglas }} </h5>
          <p class="card-text">{{ $Info->Nombre }}</p>
        </div>
        <div class="card-footer">
          <a href="{{ route('infoAgrupa',['id'=> $Info->id])}}"><button type="button" class="btn btn-info btn-block">
            Más información
          </button></a>
        </div>
    </div>
  @endforeach
</div>
@stop
