@extends('sAdmin.layout')
@section('content')
<div class="row" style="margin:auto;">
    @foreach($data as $dato)
    <div class="col-sm-4">
        <div class="card border-info" style="border-radius:2%;">
            <div class="card-img-top" data-id="{{ $dato->id }}">
              @if (is_null($dato->Logo ))
                <img src="{{asset('images/Inge.png' )}}" alt="" class="img-fluid" style="border-radius:2%;">
              @else
                <img src="{{asset('images/Agrupaciones/Logos/'. $dato->Logo )}}" alt="" class="img-fluid" style="border-radius:2%;">
              @endif
            </div>
            <form method="post" action="{{ route('UPA',['id'=> $dato->id]) }}}">
              <div class="card-body">
                  <div class="card-title">
                      <h3>{{ $dato->Siglas }}</h3>
                      <p>{{ $dato->Nombre }}</p>
                  </div>
                  <div class="card-text">
                      {{ csrf_field() }}
                      @method('patch')
                      <div class="form-group row" style="margin: auto;">
                          <input class="form-control" name="password" type="text" placeholder="Nueva contraseña" required>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                  <input type="submit" class="btn btn-info btn-block" value="Actualizar">
              </div>
            </form>
          </div>
        </div>
   @endforeach
</div>
@stop
