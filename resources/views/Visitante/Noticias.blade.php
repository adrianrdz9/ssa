@extends('layouts.visitantes')
@section('title','Noticias')
@section('content')
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
                    <div style="text-align:right;">
                        <h6>{{ $dato->Fecha }}</h6>
                        <a href='Noticia/id/{{ $dato->Folio }}'><button class="btn btn-card">Ver más</button></a>
                    </div>
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
