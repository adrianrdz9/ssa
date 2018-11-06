<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante</title>
    <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}">
    <style>
        th{
            background-color: lightgray;
        }
        
        th, td{
            font-size: 10px;
            border: 1px solid black !important;
            padding: 3px 2px !important;
        }

        div.responsiva{
            padding: 0 1cm;
        }

        div.firmas{
            margin-top: 2cm;
        }

        div.firmas div{
            position: relative;
            width: 40%;
            display: inline;
            margin-left: 2cm;
        }
        div.firmas div:last{
            margin-left: 6cm;
        }

        div.firmas  div::after{
            position: absolute;
            width: 200px;
            border: 1px solid black;
            top: -10px;
            left: -10px;
            
        }
        .watermark {
            opacity: 0.3;
            position: absolute;
            top: 2cm;
            left: 37.5%;
            height: 7cm;
        }
    </style>
</head>
<body class="px-4">
    <div class="row justify-content-between " style="height: 90px">
        <div class="col">
            <img src="{{public_path('images/logo_unam.png')}}" alt="Logo UNAM" height="90" class="d-inline-block">
            <img src="{{public_path('images/logo_fi.png')}}" alt="Logo FI" height="90" class="d-inline-block">
        </div>
        <div class="col text-right">
            <img src="{{public_path('images/missing_avatar.png')}}" alt="Logo FI" height="90" class="d-inline-block">
        </div>
    </div>
    <div>
        <table class="table">
            <thead style="background-color: lightgray;">
                <tr>
                    <th style="border: 0;" colspan="6">
                        <h1>
                            {{$tournament->name}}
                        </h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Nombre:</th>
                    <td>{{$user->name.' '.$user->last_name}}</td>
                    <td>{{\Carbon\Carbon::parse($user->birthdate)->age}} años</td>
                    <th>{{$user->curp || 'Curp no disponible'}}</th>
                    <th style="background: white; border:0;">No. de cuenta</th>
                    <th>{{$user->account_number}}</th>
                </tr>
                <tr>
                    <th scope="row">Plantel:</th>
                    <td colspan="3">Facultad de ingenieria</td>
                    <td>Tipo de usuario: </td>
                    @role('student')
                        <th>Estudiante</th>
                    @endrole
                </tr>
                <tr>
                    <th scope="row">Carrera:</th>
                    <td>{{$user->career}}</td>
                    <th>Servicio: </th>
                    <td>{{$user->medical_service}}</td>
                    <th colspan="2">Carnet: {{$user->medical_card_no}}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="responsiva position-relative">
        <p class="text-justify">
            <span class="text-uppercase text-center d-block">Carta responsiva del evento</span>
            Declaro estar sano y apto para participar en el evento deportivo '{{$tournament->name}}' reconozco los riesgos inhertes a la práctica 
            deportiva, por lo que voluntariamente y con conocimiento pleno de esto, acepto y asumo la responsabilidad de mi integridad física y
            libero de toda responsabilidad a la <i class="text-uppercase">Universidad Nacional Autónoma de México</i>, a la 
            <i class="text-uppercase">Dirección General del Deporte Universitario</i> y al Comité Organizador.
        </p>
        <img src="{{public_path('images/logo_unam.png')}}" alt="" class="watermark">
    </div>
    <table class="w-100 text-center" style="margin-top: 4cm;">
        <thead>
            <tr>
                <td class="w-50 border-0" style="font-size:1em;">
                    <div style="width: 80%; display: block; margin: auto; border: 1px solid black;"></div>
                    Firma del alumno
                </td>
                <td class="w-50 border-0" style="font-size:1em;">
                    <div style="width: 80%; display: block; margin: auto; border: 1px solid black;"></div>
                    Firma del tutor (menor de edad)
                </td>
            </tr>
        </thead>
    </table>
    
    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($folio)) !!}" id="qr" class="mt-4" height="150">
    <span><b>Folio: </b> {{$folio}}</span>
</body>
</html>