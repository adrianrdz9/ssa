@extends('layouts.semiAdmi')
@section('title','Información de la agrupación')
@section('content')
<h1 style="text-align:center;">Informacion general</h1>
<h3> {{ auth()->user()->Nombre }} </h3>
<br/>
<form method="post" action="{{URL::to('/update')}}">
  <div class="form-group row">
    <div class="col-xs-8" style="margin-left: 10%;">
      @foreach ($Inte as $value)
        <p>
          <input type="text" name="cargo0" required placeholder="{{ $value->Cargo }}" />
          <input type="text" name="nombre0" required placeholder="{{ $value->Nombre }}" />
        </p>
      @endforeach
      <p>
        <input type="text" name="cargo1" required placeholder="Cargo" />
        <input type="text" name="nombre1" required placeholder="Nombre" />
      </p>
      <p>
        <input type="text" name="cargo3" required placeholder="Cargo" />
        <input type="text" name="nombre3" required placeholder="Nombre" />
      </p>
      <p>
        <input type="text" name="cargo2" required placeholder="Cargo" />
        <input type="text" name="nombre2" required placeholder="Nombre"/>
      </p>
      <p>
        <input type="text" name="cargo4" required placeholder="Cargo" />
        <input type="text" name="nombre4" required placeholder="Nombre" />
      </p>
        <button type="submit"class="btn btn-primary"style="margin-left:23%;">Actualizar integrantes</button>
</form>
    <br/>
    <br/>
<form method="post" action="{{URL::to('/General')}}">
      <label>Descripción:</label>
      <textarea class="form-control" rows="5" name="Descripcion" maxlength="500" placeholder="{{ $Info[0]->Descripcion }}"></textarea>
      <br/>
  </div>
  <div class="col-xs-8" style="margin-left: 20%;">
    <label>Logo</label>
      <input type="file" class="form-control-file" style="margin-left: 10%;" name="Logo">
    <br/>
    <label>Fotografía</label>
      <input type="file" class="form-control-file" style="margin-left: 10%;" name="Foto">
    <br/>
    <p>
    <label for="ex8">Link</label>
      <input type="text" style="margin-left: 5%;" name="Link1"/>
    </p>
    <p>
    <label for="ex8">Link</label>
      <input type="text" style="margin-left: 11%;" name="Link2"/>
    </p>
    <p>
    <label for="ex8">Link</label>
      <input type="text" style="margin-left: 11%;" name="Link3"/>
    </p>
      <button type="submit"class="btn btn-primary"style="margin-left:25%; margin-top:27%;">Actualizar Información</button>
  </div>
</form>
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
@stop
