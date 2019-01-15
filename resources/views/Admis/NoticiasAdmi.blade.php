@extends('layouts.Admi')
@section('title','Noticias')
@section('content')
  @foreach ($data as $Info)
  <div class="row" style="margin-left:1%; margin-right:1%; margin-top:1%; margin-bottom:1%;">
  <div class="col-sm-3">
    @if($Info->ImagenC=="")
    <img src="{{asset('images/Inge.png')}}" class="img-responsive" width="100%" height="100%">
    @else
      <img src="{{asset('images/Noticias/'.$Info->ImagenC)}}" class="img-responsive" width="100%" height="100%">
    @endif
  </div>
  <div class="offset-sm-1"></div>
  <div class="col-sm-8" style="background-color:#e0e0e0; border-radius: 10px; text-align:center;">
    <h3> {{ $Info->Titulo }} </h3> <hr/>
    <p>  {{ $Info->DescripcionCorta }}</p>
    @if( $Info->Disponible == "1")
      <div style="margin-top:1%; margin-bottom:1%; text-align:right;" data-id="{{ $Info->Folio }}">
        <button type="button" class="btn btn-danger Ocultar">Ocultar</button>
      </div>
    @else
      <div style="margin-top:1%; margin-bottom:1%; text-align:right;" data-id="{{ $Info->Folio }}">
        <button type="button" class="btn btn-info Mostrar">Mostrar</button>
      </div>
    @endif
  </div>
  </div>
  @endforeach
  <script>
    $('.Ocultar').click(function () {
    let id = $(this).parents('div').data('id');
      $.ajax({
        url: "/oNoticia/id/" + id,
        method: "get"
      }).done(()=>{
        swal(
            '¡Exito!',
            'Se oculto la noticia',
            'success'
        )
          $(this).parent().append('<button type="button" class="btn btn-info Mostrar">Mostrar</button>');
          $(this).closest('.Ocultar').remove();
      });
    });
    $('.Mostrar').click(function () {
    let id = $(this).parents('div').data('id');
      $.ajax({
        url: "/mNoticia/id/" + id,
        method: "get"
      }).done(()=>{
        swal(
            '¡Exito!',
            'Se mostrara la noticia',
            'success'
        )
        $(this).parent().append('<button type="button" class="btn btn-danger Ocultar">Ocultar</button>');
        $(this).closest('.Mostrar').remove();
      });
    });
  </script>
@stop
