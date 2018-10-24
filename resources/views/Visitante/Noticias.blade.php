@extends('layouts.visitantes')
@section('title','Noticias')
@section('content')
<div class="col-md-20 col-md-offset-0">
  <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
    <div class="carousel-inner">
      <div class="item active">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/FI.png')}}" class="img-responsive"></a></div>
      </div>
      <div class="item">
        <div class="col-md-2 col-sm-6 col-xs-12"><img src="{{asset('images/UNAM.png')}}" class="img-responsive"></a></div>
      </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
  </div>
</div>
<section class="details-card">
        <div class="row">
            @foreach($data as $dato)
            <div class="col-sm-4">
                <div class="card-content">
                    <div class="card-img" data-id="{{ $dato->Folio }}">
                      @if (is_null($dato->ImagenC ))
                        <img src="{{asset('images/Inge.png' )}}" alt="">
                      @endif
                        <img src="{{asset('images/Noticias/'. $dato->ImagenC )}}" alt="">
                    </div>
                    <div class="card-desc">
                        <h3>{{ $dato->Titulo }}</h3>
                        <p>{{ $dato->DescripcionCorta }}</p>
                        <h6>{{ $dato->Fecha  }}</h6>
                        <a href='Noticia/id/{{ $dato->Folio }}'><button class="btn btn-card">Ver más</button></a>
                    </div>
                </div>
                 <br/>
            </div>
           @endforeach
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
