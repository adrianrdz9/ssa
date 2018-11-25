@extends('layouts.visitantes')
@section('title','Noticias')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Inconsolata|PT+Sans+Narrow|PT+Serif" rel="stylesheet">
<h1 style="font-family: 'PT Serif', serif;">{{ $data[0]->Titulo }}</h1>
<label style="font-family: 'Inconsolata', monospace; text-align:left;">{{ $data[0]->Fecha }}</label>
   <img src="{{asset('images/Noticias/'. $data[0]->ImagenR )}}"
        class="img-responsive"
        style="display:block;
                margin:auto;">
    <br/>
    <div style="font-family: 'PT Sans Narrow', sans-serif;"><font size="5">
         {{ $data[0]->Descripcion }}
    </div></font>
@stop
