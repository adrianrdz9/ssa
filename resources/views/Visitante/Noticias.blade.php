@extends('layouts.visitantes')
@section('title','Noticias')
@section('content')
<div class="col-md-20 col-md-offset-0">
  <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
    <div class="carousel-inner">
      <div class="item active">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('Images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
  </div>
</div>
<section class="details-card">
        <div class="row">
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{asset('Images/Petro.jpg')}}" alt="">
                    </div>
                    <div class="card-desc">
                        <h3>Titulo</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                        <h6>Fecha </h6>
                            <a href="#" class="btn-card">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{asset('Images/Inge.jpg')}}" alt="">
                    </div>
                    <div class="card-desc">
                        <h3>Titulo</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                        <h6>Fecha </h6>
                            <a href="#" class="btn-card">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{asset('Images/Petro.jpg')}}" alt="">
                    </div>
                    <div class="card-desc">
                        <h3>Titulo</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                            voluptas totam</p>
                        <h6>Fecha </h6>
                            <a href="#" class="btn-card">Ver más</a>
                    </div>
                </div>
            </div>
    </div>
</section>
<script>
    $('.carousel[data-type="multi"] .item').each(function(){
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i=0;i<4;i++) {
      next=next.next();
      if (!next.length) {
      	next = $(this).siblings(':first');
    	}

      next.children(':first-child').clone().appendTo($(this));
    }
  });
</script>
@stop
