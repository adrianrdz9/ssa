@extends('layouts.app')

@section('content')
  <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title">Iniciar sesión</h1>
          </div>
          <div class="panel-body">
            <form method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
                <div class="form-group {{ $errors->has('Siglas') ? 'has-error' : '' }} ">
                  <label for="Siglas">Siglas</label>
                  <input class="form-control"
                      type="text"
                      name="Siglas"
                      value = "{{ old('Siglas')}}"
                      placeholder="Ingresa las Siglas de tu agrupación">
                  {!! $errors->first('Siglas', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} ">
                  <label for="password">Contraseña</label>
                  <input class="form-control"
                      type="password"
                      name="password"
                      placeholder="Ingresa tu contraseña">
                  {!! $errors->first('password', '<span class="help-block">:message</span>') !!}

                </div>
                <button class="btn btn-primary btn-block">Iniciar sesión</button>
            </form>
          </div>
        </div>
      </div>
  </div>
@endsection
