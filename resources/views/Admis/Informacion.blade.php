@extends('layouts.semiAdmi')
@section('title','Información de la agrupación')
@section('content')
<h1 style="text-align:center;">Informacion general</h1>
<br/>
<form method="post" action="{{URL::to('/update')}}">
<div class="form-group row">
  <div class="col-xs-8" style="margin-left: 10%;">
    <label for="ex8">PRESIDENTE</label>
      <input type="text" name="presidente" required autofocus style="margin-left: 5%;"/>
    <p>
      <input type="text" name="cargo1" required placeholder="Cargo" />
      <input type="text" name="nombre1" required placeholder="Nombre" />
    </p>
    <p>
      <input type="text" name="cargo3" required placeholder="Cargo" />
      <input type="text" name="nombre3" required placeholder="Nombre" />
    </p>
    <label>Logo</label>
    <input type="file" class="form-control-file" style="margin-left: 10%;">
    <br/>
    <label>Descripción:</label>
    <textarea class="form-control" rows="5" id="comment"></textarea>
  </div>
  <div class="col-xs-8" style="margin-left: 20%;">
    <label for="ex2">VICEPRESIDENTE </label>
      <input type="text" name="vicepresidente" required style="margin-left: 5%;"/>
      <p>
        <input type="text" name="cargo2" required placeholder="Cargo" />
        <input type="text" name="nombre2" required placeholder="Nombre"/>
      </p>
      <p>
        <input type="text" name="cargo4" required placeholder="Cargo" />
        <input type="text" name="nombre4" required placeholder="Nombre" />
      </p>
      <label>Fotografía</label>
      <input type="file" class="form-control-file" style="margin-left: 10%;">
      <br/>
      <label for="ex8">Facebook</label>
        <input type="text" name="presidente" required autofocus style="margin-left: 5%;"/>
      <br/>
      <label for="ex8">Twitter</label>
        <input type="text" name="presidente" required autofocus style="margin-left: 11%;"/>
      <br/>
      <label for="ex8">Página</label>
        <input type="text" name="presidente" required autofocus style="margin-left: 11%;"/>
  </div>
  <div class="text-danger">
    @if($errors->any())
      <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>
  {{csrf_field()}}
  <button type="submit"class="btn btn-primary"style="margin-left: 50%;">Vale</button>
</form>
@stop
