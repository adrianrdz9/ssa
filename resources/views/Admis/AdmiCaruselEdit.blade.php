@extends('layouts.app')
@section('title','Editar carusel')
@section('content')
<section class="details-card">
        <div class="row">
            @foreach($data as $dato)
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{asset('images/Carusel/'. $dato->Imagen )}}" alt="" class="img-fluid">
                    </div>
                    <div class="card-desc">
                          <h3>{{ $dato->Titulo }}</h3>
                          <p>{{ $dato->Descripcion}}</p>
                      <div style="text-align:right;" data-id="{{ $dato->id }}">
                         @if($dato->Estado == "1")
                          <button class="btn btn-danger Ocultar">Ocultar</button>
                         @else
                          <button class="btn btn-info Mostrar">Mostrar</button>
                         @endif
                      </div>
                    </div>
                </div>
                 <br/>
            </div>
           @endforeach
        </div>
</section>
<script>
  $('.Ocultar').click(function () {
  let id = $(this).parents('div').data('id');
    $.ajax({
      url: "/OImagenC/id/" + id,
      method: "get"
    }).done(()=>{
      swal(
          '¡Exito!',
          'Se oculto la imagen',
          'success'
      )
        $(this).closest('.Ocultar').remove();
    });
  });
  $('.Mostrar').click(function () {
  let id = $(this).parents('div').data('id');
    $.ajax({
      url: "/MImagenC/id/" + id,
      method: "get"
    }).done(()=>{
      swal(
          '¡Exito!',
          'Se mostrara la imagen',
          'success'
      )
        $(this).closest('.Mostrar').remove();
    });
  });
</script>
@stop
