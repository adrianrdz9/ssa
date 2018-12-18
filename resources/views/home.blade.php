@extends('layouts.home')
@section('title','Apoyo a la comunidad')
@section('content')
     <br/>
     <div class="top clearfix">
       <div id="demo" class="carousel slide" style="width:68%; float:left;">
         <ul class="carousel-indicators">
           <li data-target="#demo" data-slide-to="0" class="active"></li>
           <li data-target="#demo" data-slide-to="1"></li>
           <li data-target="#demo" data-slide-to="2"></li>
         </ul>
         <div class="carousel-inner container">
           <div class="carousel-item active">
             <img style="margin:auto;"class="img-fluid" src="{{asset('images/agrupaciones.jpeg')}}" alt="Imagen" >
           </div>
           <div class="carousel-item">
             <img class="img-fluid" src="{{asset('images/deportes.jpeg')}}" alt="Imagen" >
           </div>
           <div class="carousel-item">
             <img class="img-fluid" src="{{asset('images/bolsa.jpeg')}}"alt="Imagen" >
           </div>
         </div>
         <a class="carousel-control-prev" href="#demo" data-slide="prev">
           <span class="carousel-control-prev-icon"></span>
         </a>
         <a class="carousel-control-next" href="#demo" data-slide="next">
           <span class="carousel-control-next-icon"></span>
         </a>
      </div>
        <div style="float:left; margin-left:3%;">
          <div class="card text-white bg-secondary mb-3" style="max-width: 18rem; margin:auto;">
            <div id="fecha" class="card-header" style="text-align:right;"></div>
            <div class="card-body">
              <h5 class="card-title">Examen de inglés</h5>
              <p class="card-text">Auditorio principal</p>
            </div>
              <div id="hora" class="card-footer" style="text-align: right;"></div>
          </div>
          <br/>
          <div class="table-responsive-sm">
            <table class="table">
              <thead class="thead-dark">
                 <tr>
                   <th scope="col">Evento</th>
                   <th scope="col">Fecha</th>
                   <th scope="col">Hora</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <th scope="row">Comida SEFI</th>
                   <td>10/11/2018</td>
                   <td>16:30 pm</td>
                 </tr>
                 <tr>
                   <th scope="row">Examen TOEFL</th>
                   <td>12/11/2018</td>
                   <td>10:20 am</td>
                 </tr>
                 <tr>
                   <th scope="row">Conf. NASA</th>
                   <td>30/11/2018</td>
                   <td>11:00 am</td>
                 </tr>
               </tbody>
            </table>
          </div>
        </div>
   </div>
      <br/>
      <section class="details-card">
              <div class="row">
                  <div class="col-sm-4">
                      <div class="card-content">
                          <div class="card-img">
                              <img src="{{asset('images/deportes.jpeg')}}" alt="">
                          </div>
                          <div class="card-desc" style="text-align:center;">
                              <h3>Alumna de Ingeniería, al mundial de natación</h3>
                              <p>Teresa Alonso García, alumna de la Facultad de Ingeniería, se prepara como seleccionada
                                 nacional de nado sincronizado para competir en el Campeonato Mundial de Natación que se
                                 celebrará en Budapest, Hungría, en julio.</p>
                              <!-- <h6>Un día</h6> -->
                              <a href='#'><button class="btn btn-danger">Ver más</button></a>
                          </div>
                      </div>
                      <br/>
                  </div>
                  <div class="col-sm-4">
                      <div class="card-content">
                          <div class="card-img">
                              <img src="{{asset('images/agrupaciones.jpeg')}}" alt="">
                          </div>
                          <div class="card-desc"style="text-align:center;">
                              <h3>Tricampeonato en el PetroBowl Internacional</h3>
                              <p>Estudiantes de la Facultad de Ingeniería (FI) ganaron el primer lugar del PetroBowl
                                 Internacional  2018, organizado por la Society of Petroleum Engineers, agrupación mundial que congrega
                                 a ingenieros y científicos de la industria del gas y el petróleo.</p>
                              <!-- <h6>Un día</h6> -->
                              <a href='#' style="margin:auto;"><button class="btn btn-warning">Ver más</button></a>
                          </div>
                      </div>
                      <br/>
                  </div>
                  <div class="col-sm-4">
                      <div class="card-content">
                          <div class="card-img">
                              <img src="{{asset('images/bolsa.jpeg')}}" alt="">
                          </div>
                          <div class="card-desc" style="text-align:center;">
                              <h3>Oportunidad de alto crecimiento</h3>
                              <p>Tras conseguir una certificación, el 23 % de tecnólogos certificados de Microsoft informó de haber recibido
                                un aumento de sueldo del 20 %. Además, a los empleados con certificación, a menudo, se les encarga que
                                supervisen a sus compañeros.
                              </p>
                              <!-- <h6>Un día</h6> -->
                              <a href='#'><button class="btn btn-primary">Ver más</button></a>
                          </div>
                      </div>
                      <br/>
                  </div>
              </div>
      </section>
@stop