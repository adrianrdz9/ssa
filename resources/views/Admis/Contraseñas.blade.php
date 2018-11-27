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
          <div class="form-group row" style="margin: auto;">
            <div class="col-xs-3" style="margin-left:30%;">
              <input class="form-control" id="contra" type="text" placeholder="Nueva contraseña">
            </div>
            <div class="col-xs-4" style="margin-left:5%;" data-id="{{ $Info->id }}">
              <button type="button" class="btn btn-info Cambiar">
                Actualizar
              </button>
            </div>
          </div>
          <br/>
      </div>
    <br/>
  @endforeach
</div>
<script>
  $('.Cambiar').click(function () {
  let id = $(this).parents('div').data('id');
  var info = $(this).previousSibling.value;
  console.log(info);
    // $.ajax({
    //   url: "/list",
    //   method: "POST",
    //   data: {name: "Untitled"},
    // }).done((list) => {
    //   $clone.attr('data-id', list.id);
    //   $TABLE.find('table').append($clone);
    // });
  });
</script>
@stop
