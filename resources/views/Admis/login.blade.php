@extends('layouts.app')
@section('content')
  <div class="row"  style="margin-top:7%; margin-left:auto;">
      <div class="col-md-5 col-md-offset-5">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title"
                style="font-family: 'PT Serif', serif;
                text-align:center; ">Iniciar sesión</h1>
          </div>
          <div class="panel-body">
            <font size=4>
            <form method="POST" action="{{ route('Agrupa') }}">
              {{ csrf_field() }}
                <div class="form-group {{ $errors->has('Siglas') ? 'has-error' : '' }} " style="font-family: 'Inconsolata', monospace;">
                  <label for="Siglas">Siglas</label>
                  <input class="form-control"
                      type="text"
                      name="Siglas" required
                      value = "{{ old('Siglas')}}"
                      placeholder="Ingresa las siglas de tu agrupación">
                  <br/><p style="text-align:center;">
                    {!! $errors->first('Siglas', '<span class="alert alert-danger">:message</span>') !!}
                  </p>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} ">
                  <label for="password">Contraseña</label>
                  <input class="form-control"
                      type="password"
                      name="password"
                      required
                      placeholder="Ingresa tu contraseña">
                  {!! $errors->first('password', '<span class="help-block">:message</span>') !!}

                </font></div>
                <button class="btn btn-primary btn-block">Iniciar sesión</button>
            </form>
          </div>
        </div>
      </div>
  </div>
@endsection
