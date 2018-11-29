@extends('layouts.visitantes')
@section('title','Noticias')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Inconsolata|PT+Sans+Narrow|PT+Serif" rel="stylesheet">
<h1 style="font-family: 'PT Serif', serif; text-align:center; margin-top:1%;">{{ $data[0]->Titulo }}</h1>
<div style="text-align:right; margin-right:5%;"><label style="font-family: 'Inconsolata', monospace;">{{ $data[0]->Fecha }}</label></div>
<div style="display:block; margin:auto; text-align:center;">
   <img src="{{asset('images/Noticias/'. $data[0]->ImagenR )}}"
        class="img-responsive">
</div>
    <br/>
    <div style="font-family: 'PT Sans Narrow', sans-serif; text-align:left; margin-left:7%;"><font size="5">
         {{ $data[0]->Descripcion }}
    </div></font>
@stop
