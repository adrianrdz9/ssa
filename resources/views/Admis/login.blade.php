@extends('layouts.app')
@section('content')
  <link href="{{asset('css/login.css')}}" rel="stylesheet"/>
  <div class="row login-box">
    <!-- <img src="{{asset('images/FI.png')}}" class="avatar" alt="Avatar Image"> -->
      <div class="col-md-12">
            <form method="POST" action="{{ route('Agrupa') }}">
              {{ csrf_field() }}
                <div class="form-group {{ $errors->has('Siglas') ? 'has-error' : '' }} ">
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

                </div>
                <input type="submit" value="Iniciar sesión">
            </form>
      </div>
  </div>
@endsection
