<div class=" col-sm-4">
<div class="card border-primary" data-id="{{ $propuesta->id }}">
  <div class="card-header">{{ $propuesta->Titulo }} por {{ $propuesta->Siglas}}</div>
    <div class="card-body" style="text-align:left;">
      <div class="card-text">{{ $propuesta->Descripcion }}</div>
      <b>Contacto:</b> <br/>
        <p style="margin-left:3%;">
            Presidente: {{ $propuesta->PNombre }} <br/>
            Celular: {{ $propuesta->PNumero }} <br/>
            Email: {{ $propuesta-PPEmail }}
        </p>
    </div>
    {{ $propuesta }}
   <div class="card-footer" style="text-align:right;" data-id="{{ $propuesta->id }}">
     {{ $slot }}
   </div>
</div>
</div>
