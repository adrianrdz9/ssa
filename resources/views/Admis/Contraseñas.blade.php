@extends('layouts.Admi')
@section('title','Restablecer contraseñas')
@section('content')
<link href="{{asset('css/AgrupaGnral.css')}}" rel="stylesheet"/>
<div class="row">
  @foreach ($data as $Info)
    <div class="col-sm-4"style=" border-radius: 10px; margin:auto;">
      <img src="{{asset('images/Agrupaciones/Logos/'.$Info->Logo)}}" class="img-responsive"
      width="80%" height="50%">
    </div>
      <div class="col-sm-7"style="background-color:#e0e0e0; border-radius: 10px; margin:auto; margin-top:1%;">
          <h3> {{ $Info->Siglas }} </h3> <hr/>
          <p>  {{ $Info->Nombre }} </p>
          <form method="post" action="{{ url('NPassword') }}">
            {{ csrf_field() }}
            <div class="form-group row" style="margin: auto;">
              <div class="col-xs-3" style="margin-left:30%;">
                <input type="hidden" name="Id" value="{{ $Info->id }}">
                <input class="form-control" name="pass" type="text" placeholder="Nueva contraseña" required>
              </div>
              <div class="col-xs-4" style="margin-left:5%;">
                <button type="submit" class="btn btn-info">
                  Actualizar
                </button>
              </div>
            </div>
          </form>
          <br/>
      </div>
    <br/>
  @endforeach
</div>
@stop
