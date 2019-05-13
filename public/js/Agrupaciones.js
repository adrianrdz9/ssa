//Administrador SSA
//Noticias
$('.Ocultar').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/agrupaciones/oNoticia/id/" + id,
    method: "get"
  }).done(()=>{
    swal(
        '¡Exito!',
        'Se oculto la noticia',
        'success'
    )
      $(this).parent().append(' <button type="button" class="btn btn-info Mostrar">Mostrar</button>');
      $(this).closest('.Ocultar').remove();
  }).fail(()=>{
    swal(
        '¡Error!',
        'No es posible ocultar esta noticia',
        'error'
    )
  });
});
$('.Mostrar').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/agrupaciones/mNoticia/id/" + id,
    method: "get"
  }).done(()=>{
    swal(
        '¡Exito!',
        'Se mostrara la noticia',
        'success'
    )
    $(this).parent().append(' <button type="button" class="btn btn-danger Ocultar">Ocultar</button>');
    $(this).closest('.Mostrar').remove();
  }).fail(()=>{
    swal(
        '¡Error!',
        'No es posible mostrar la noticia',
        'error'
    )
  });
});
$('.EliminarNoticia').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/agrupaciones/DNoticia/id/" + id,
    method: "get"
  }).done(()=>{
    $(this).closest('.row').remove();
    swal(
        '¡Exito!',
        'Se elimino la noticia',
        'success'
    )
  }).fail(()=>{
    swal(
        '¡Error!',
        'No es posible eliminar la noticia',
        'error'
    )
  });
});
//EventosFerias
$('.Eliminar').click(function () {
let id = $(this).parents('ul').data('id');
  $.ajax({
    url: "/agrupaciones/DEvento/id/" + id,
    method: "get",
  }).done(()=>{
    $(this).closest('tr').remove();
    swal(
        '¡Exito!',
        'Elimino el evento',
        'success'
    )
  }).fail(()=>{
    swal(
        '¡Error!',
        'No es posible eliminar este evento',
        'error'
    )
  });
});
//carrusel
//Mostrar imagen seleccionada
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
$('.OcultarC').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/agrupaciones/OImagenC/id/" + id,
    method: "get"
  }).done(()=>{
    $(this).closest('.OcultarC').remove();
    swal(
        '¡Exito!',
        'Se oculto la imagen',
        'success'
    )
  });
});
$('.MostrarC').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/agrupaciones/MImagenC/id/" + id,
    method: "get"
  }).done(()=>{
    $(this).closest('.MostrarC').remove();
    swal(
        '¡Exito!',
        'Se mostrara la imagen',
        'success'
    )
  });
});
$('.EliminarC').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/agrupaciones/DImagenC/id/" + id,
    method: "get"
  }).done(()=>{
    $(this).closest('.col-sm-4').remove();
    swal(
        '¡Exito!',
        'Se elimino la imagen',
        'success'
    )
  });
});
//Propuestas Administrador
$('.Aceptar').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/statusA/id/" + id,
    method: "get"
  }).done(()=>{
    swal(
      'Exito!',
      'Propuesta aceptada',
      'success'
      )
      $(this).closest('.card-footer').remove();
  });
});
$('.Comunicate').click(function () {
let id = $(this).parents('div').data('id');
  $.ajax({
    url: "/statusC/id/" + id,
    method: "get"
  }).done(()=>{
    swal(
        'Exito!',
        'Se enviara la notificaciòn correspondiente',
        'success'
      )
      $(this).closest('.btn-info').remove();
  });
});
//Eventos página principal
$('.EliminarEC').click(function () {
let id = $(this).parents('ul').data('id');
  $.ajax({
    url: "/comunidad/delete/" + id,
    method: "get",
  }).done(()=>{
    $(this).closest('tr').remove();
    swal(
        '¡Exito!',
        'Elimino el evento',
        'success'
    )
  }).fail(()=>{
    swal(
        '¡Error!',
        'No es posible eliminar este evento',
        'error'
    )
  });
});
