@extends('layouts.visitantes')
@section('title','Agrupaciones')
@section('content')
<link href="{{asset('css/AIndivi.css')}}" rel="stylesheet"/>
  <h2>Nombre de la Agrupación</h2>
    <h6>SIGLAS</h6>
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;">
      <img src="{{asset('Images/FI.png')}}" class="img-responsive">
      <br/>
      <div>
          Descripcion: <br/>
          <p>
            Somos una agrupacion que hace tal y tal, para que promer el desarrollo
            Somos una agrupacion que hace tal y tal, para que promer el desarrollo
            Somos una agrupacion que hace tal y tal, para que promer el desarrollo
            Somos una agrupacion que hace tal y tal, para que promer el desarrollo
            Somos una agrupacion que hace tal y tal, para que promer el desarrollo
          </p>
      </div>
    </div>
    <div class="col-sm-7" style="background-color:lavenderblush;">
      <div class="row">
        <h3>Integrantes</h3>
        <div class="col-sm-6">
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
        </div>
        <div class="col-sm-6">
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
          <br/>
          <p>
            <h4>Cargo</h4>
                Nombre
          </p>
        </div>
      </div>
      <div align="center">
        <img src="{{asset('Images/Logo.png')}}" class="img-responsive" width="50%" height="95%">
      </div>
    </div>
  </div>
</div>
@stop
