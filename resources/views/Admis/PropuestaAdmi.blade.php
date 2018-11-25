@extends('layouts.Admi')
@section('title','Propuestas')
@section('content')
<h3>Propuestas para la Feria de Agrupaciones</h3>
<div>
  <div class="card">
    <div class="card-header">Conferencia X por SiK</div>
    <div class="card-body" style="text-align:left;">
      <p class="card-text">
        Reunión de autoridades políticas o intelectuales para tratar un tema importante,
        en especial si se trata de representantes de países, organismos o entidades.
      </p>
      <b>Contacto:</b> <br/>
      <p style="margin-left:3%;">
        Presidente: Pablo Neruda <br/>
        Celular: 5528072878 <br/>
        Email: pablo@comunidad.unam.mx <br/>
      </p>
    </div>
     <div class="card-footer" style="text-align:right;">
      <button type="button" class="btn btn-success Aceptar">Aceptar</button>
      <button type="button" class="btn btn-info">Comunicate con nosotros</button>
    </div>
  </div>
  <BR/>
  <div class="card">
    <div class="card-header">Conferencia Z por SiK</div>
    <div class="card-body" style="text-align:left;">
      <p class="card-text">
        Reunión de autoridades políticas o intelectuales para tratar un tema importante,
        en especial si se trata de representantes de países, organismos o entidades.
      </p>
      <b>Contacto:</b> <br/>
      <p style="margin-left:3%;">
        Presidente: Pablo Neruda <br/>
        Celular: 5528072878 <br/>
        Email: pablo@comunidad.unam.mx <br/>
      </p>
    </div>
     <div class="card-footer" style="text-align:right;">
      <button type="button" class="btn btn-success">Aceptar</button>
      <button type="button" class="btn btn-info">Comunicate con nosotros</button>
    </div>
  </div>
</div>
<script>
$('.Aceptar').click(function () {
  swal({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      swal(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    }
  })

});
</script>
@stop
