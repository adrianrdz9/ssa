@extends('layouts.semiAdmi')
@section('title','Cambio de Mesa')
@section('content')
<div class="row" style="margin:auto;">
  <div class="col-md-6" style="margin-top:2%; text-align:left;">
  <h3>MESA DIRECTIVA SALIENTE</h3>
    <ul>
      <li>
        Realizar el <b>informe</b> de actividades de su gestión en una presentación de
        Power Point con un máximo de 8 diapositivas.
      </li>
      <li>
          Enviar el <b>informe</b> para la toma de protesta, al M. I. Miguel Figueroa Bustos,
          Secretario de Servicios Académicos al correo electrónico <a href="mailto:miguelfb@unam.mx">miguelfb@unam.mx</a>,
          con copia al Lic. Carlos Vences Espinosa, Jefe del Departamento de Apoyo a la Comunidad
          <a href="mailto:carlos_vences@comunidad.unam.mx">carlos_vences@comunidad.unam.mx</a>,
          con la finalidad de hacer la revisión y en su caso, las correcciones necesarias.
      </li>
      <li>
          <b>Solicitar fecha</b> para cambio de mesa al M.I. Miguel Figueroa Bustos y
          acordar con él, el <b>lugar y la hora</b> dónde se realizará.
      </li>
      <li>
        Una vez conocida la fecha, el lugar y la hora, invitar, mediante oficio, a los
        funcionarios correspondientes (Director, Jefe de División, Asesor Académico,
        etc.) al menos una semana antes de la fecha de cambio de mesa.
      </li>
      <li>
        Confirmar, al menos 2 días antes, la asistencia de los funcionarios invitados
      </li>
      <li>
        <b>Elaborar orden del día</b> de la toma de protesta.<br/>
        Enviarlo por correo al Maestro Miguel Figueroa Bustos con copia al Lic. Carlos Vences
        Espinosa.
      </li>
      <li>
        <b>Acudir 30 minutos antes</b> de su evento al lugar programado para el cambio
        de mesa y toma de protesta (aula magna, auditorio, sala de juntas, Dirección
        o División correspondiente) <b>llevando computadora personal</b> con la
        presentación cargada para instarla y <b>probar el funcionamiento del cañón</b>.
      </li>
    </ul>
    <button style="margin-top:5%;"type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ejemplo">
        ORDEN DEL DÍA SUGERIDO
    </button>
    <a href="{{asset('PDF/Cambio de Mesa - procedimiento 2018')}}" download="Cambio_Mesa">
      <button style="margin-top:3%;" type="button" class="btn btn-danger btn-block">
        DESCARGAR ARCHIVO
      </button>
   </a>
  </div>
  <div class="col-md-6" style="margin-top:2%; text-align:left;">
  <h3>NUEVA MESA DIRECTIVA</h3>
    <ul>
      <li>
        Realizar una presentación de su <b>plan de trabajo</b> para su gestión en una
        presentación de Power Point con un <b>máximo de 8 diapositivas</b>.
      </li>
      <li>
        Enviar el <b>plan de trabajo</b> para la toma de protesta, al M. I. Miguel Figueroa
        Bustos, Secretario de Servicios Académicos al correo electrónico
        <a href="mailto:miguelfb@unam.mx">miguelfb@unam.mx</a>, con copia al Lic. Carlos Vences Espinosa, Jefe del
        Departamento de Apoyo a la Comunidad
        <a href="carlos_vences@comunidad.unam.mx">carlos_vences@comunidad.unam.mx</a>, con la finalidad de hacer la revisión y
        en su caso, las correcciones necesarias.
      </li>
      <li>
        <b>Solicitar fecha y hora</b> para cambio de mesa al M.I. Miguel Figueroa Bustos y
        acordar con él, <b>lugar</b> para la toma de protesta.
          <ul style="list-style-type:square;">
            <li>Enviar al correo el directorio de la nueva mesa en un archivo
              de Excel, con los campos siguientes: <i>Nombre</i>
            </li>
            <li>Número de cuenta</li>
            <li>Cargo en la mesa directiva</li>
            <li>Correo electrónico</li>
            <li> Teléfono celular</li>
          </ul>
      </li>
      <li>
        Hacer orden del día (se anexa ejemplo) con las personas que confirmaron
        asistencia y enviarla al Jefe del Departamento de Apoyo a la Comunidad
        (<a href="carlos_vences@comunidad.unam.mx">carlos_vences@comunidad.unam.mx</a>)
        quién fungirá como maestro de ceremonias el día del cambio.
      </li>
      <li>
        Acudir en compañía del presidente saliente, <b>30 minutos antes de su evento</b>
        al lugar programado (aula magna, auditorio, sala de juntas, Dirección o
        División correspondiente) llevando <b>computadora personal</b> con la
        presentación para instalarla y <b>probar el funcionamiento del cañón</b>.
      </li>
      <li>
        Toma de protesta siguiendo el protocolo establecido en la orden del día.
      </li>
      <li>
        Al concluir su toma de protesta, acudir al Departamento de Apoyo a la
        Comunidad para que el nuevo presidente, obtenga la contraseña para
        actualización de datos en la página de las agrupaciones en
        <a target="_blank" href="http://servacad.ingenieria.unam.mx/~dagrupe/">http://servacad.ingenieria.unam.mx/~dagrupe/</a>.
      </li>
      <li>
        Enviar lo antes posible, su Estatuto o Reglamento Interno de la Agrupación.
      </li>
    </ul>
  </div>
</div>
  <!-- Modal con ejemplo de ORDEN DEL DÍA -->
  <div class="modal fade" id="ejemplo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">ORDEN DEL DÍA SUGERIDO</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div style="text-align:center;">
            <h6>ORDEN DEL DÍA SUGERIDO: (poner su logotipo o membrete)</h6>
            <h6>NOMBRE DE LA SOCIEDAD O AGRUPACIÓN ESTUDIANTIL DE LA FACULTAD DE INGENIERÍA</h6>
            <b style="color:red;">Orden del día</b><br/>
            <b>(Fecha, hora y lugar)</b><br/>
          </div>
          <div style="text-align:left">
          <ol>
            <li>
              Agradecimiento por la asistencia a este cambio de mesa
              directiva de la Sociedad de Alumnos de ...
            </li>
            <br/>
            <li>
              Presentación del Presídum (Puede ser variable depende de quién confirmaron asistencia)
              <dl>
                <dt>Dr. Carlos Escalante Sandoval</dt>
                <dd>Director de la Facultad</dd>
                <dt>M. en I. Migel Figuero Bustos</dt>
                <dd>Secretario de Servicios Académicos</dd>
                <dt>Jefe la División de ingeniería y/o Coordinador de la carrera</dt>
                <dt>Asesor Académico</dt>
                <dt>Presidente de la mesa saliente</dt>
                <dt>Presidente de la mesa entrante</dt>
              </dl>
            </li>
            <li>
              Informe de Actiidades por parte de ... Presidente saliente
              de la mesa directiva de la ...
            </li>
            <br/>
            <li>
              Presentación del Programa de trabajo de la nueva mesa directiva, a cargo de ...
              Presidente entrante de la ...
            </li>
            <br/>
            <li>
              Toma de protesta de la nueva mesa directica de la S... de Alumnos de ...por el
              Dr. Carlos Agustín Escalante Sandoval, Director de la Facultad o M.I. Migel
              Figueroa Bustos, Secretario de Servicios Académicos de la Faculatad.
            </li>
            <br/>
            <li>
              Agradecimiento a los asistentes y fin de la Ceremonia.
            </li>
          </ol>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@stop
