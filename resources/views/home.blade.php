@extends('layouts.home')
@section('content')
     <div class="top clearfix"  style="margin-top:1%;">
       <div id="demo" class="carousel slide" style="width:100%; float:left; background-color:#E0E0E0;">
         <a class="carousel-control-prev" href="#demo" data-slide="prev" style="background-color:#E0E0E0;">
           <span class="carousel-control-prev-icon"></span>
         </a>
         <a class="carousel-control-next" href="#demo" data-slide="next"style="background-color:#E0E0E0;">
           <span class="carousel-control-next-icon"></span>
         </a>
         <ul class="carousel-indicators">
           <li data-target="#demo" data-slide-to="0" class="active"></li>
           <li data-target="#demo" data-slide-to="1"></li>
           <li data-target="#demo" data-slide-to="2"></li>
         </ul>
         <div class="carousel-inner container">
           <center>
             <div class="carousel-item active">
               <img style="margin:auto;"class="img-fluid" src="{{asset('images/agrupaciones.jpeg')}}" alt="Imagen" width="100%">
             </div>
             <div class="carousel-item">
               <img class="img-fluid" src="{{asset('images/deportes.jpeg')}}" alt="Imagen" width="100%">
             </div>
             <div class="carousel-item">
               <img class="img-fluid" src="{{asset('images/bolsa.jpeg')}}"alt="Imagen" width="100%">
             </div>
           </center>
         </div>
      </div>
        <div >
          <div class="table-responsive">
            <table class="table" style="margin-top:1%;">
              <thead class="thead-dark">
                 <tr>
                   <th scope="col">Evento</th>
                   <th scope="col">Lugar</th>
                   <th scope="col">Fecha</th>
                   <th scope="col">Hora</th>
                 </tr>
               </thead>
               @foreach ($events as $evento)
                 <tr>
                   <td>{{ $evento->Evento }}</td>
                   <td>{{ $evento->Lugar }}</td>
                   <td>{{ date("d/m/Y", strtotime($evento->Dia)) }}</td>
                   <td>{{ $evento->Hora }}</td>
                 </tr>
               @endforeach
             </tbody>
            </table>
          </div>
        </div>
   </div>
  <hr>
  <section class="details-card">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border-danger">
                <img class="card-img-top" src="{{asset('images/deportes.jpeg')}}" alt="">
                <div class="card-body" style="text-align:center;">
                    <h3 class="card-title">Alumna de Ingeniería, al mundial de natación</h3>
                    <p class="card-text">Teresa Alonso García, alumna de la Facultad de Ingeniería, se prepara como seleccionada
                       nacional de nado sincronizado para competir en el Campeonato Mundial de Natación que se
                       celebrará en Budapest, Hungría, en julio.</p>
                    <a href='#' class="btn btn-block btn-danger">Ver más</a>
                </div>
            </div>
            <br/>
        </div>
        <div class="col-sm-4">
          @foreach($data as $dato)
              <div class="card border-danger" style="border-radius:2%;">
                  <div class="card-img-top" data-id="{{ $dato->id }}">
                    @if (is_null($dato->ImagenC ))
                      <img src="{{asset('images/Inge.png' )}}" alt="" class="img-fluid" style="border-radius:2%;">
                    @endif
                      <img src="{{asset('images/Noticias/'. $dato->ImagenC )}}" alt="" class="img-fluid" style="border-radius:2%;">
                  </div>
                  <div class="card-body">
                    <div class="card-title">
                        <h3>{{ $dato->Titulo }}</h3>
                        <p>{!! $dato->DescripcionCorta !!}</p>
                    </div>
                    <div class="card-text">
                        <h6>{{ date('d/m/Y', strtotime($dato->Fecha)) }}</h6>
                        <a href='agrupaciones/Noticia/id/{{ $dato->id }}'><button class="btn btn-block btn-danger">Ver más</button></a>
                    </div>
                  </div>
              </div>
              <br/>
         @endforeach
       </div>
       <div class="col-sm-4">
           <div class="card border-danger">
               <img class="card-img-top" src="{{asset('images/bolsa.jpeg')}}" alt="">
               <div class="card-body"style="text-align:center;">
                   <h3 class="card-title">Oportunidad de alto crecimiento</h3>
                   <p class="card-text">Tras conseguir una certificación, el 23 % de tecnólogos certificados de Microsoft informó de haber recibido
                     un aumento de sueldo del 20 %. Además, a los empleados con certificación, a menudo, se les encarga que
                     supervisen a sus compañeros.</p>
                   <a href='#' class="btn btn-block btn-danger">Ver más</a>
               </div>
           </div>
           <br/>
       </div>
    </div>
  </section>
@stop
