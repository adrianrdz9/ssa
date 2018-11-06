@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header text-center">
                <h2>
                    {{$tournament->name}}
                    - rama 
                    {{ ucfirst($tournament->branch)}}
                </h2>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 p-2 text-center">
                        <h5>Datos del torneo: </h5>
                        <p>
                            <b>Nombre: </b>
                            {{$tournament->name}}
                        </p>

                        <p>
                            <b>Deporte: </b>
                                {{$tournament->sport->name}}
                            </p>
                        <p>
                            <b>Máximo disponibles: </b>
                                {{$tournament->max_room}}
                            </p>
                        <p>
                            <b>Lugares disponibles: </b>
                            {{$tournament->roomLeft()}}
                        </p>

                        <p>
                            <b>Fecha: </b>
                            <date-format :date="'{{$tournament->date}}'" :format="'dddd D [de] MMMM [de] YYYY'"></date-format>
                        </p>
                    </div>

                    <div class="col-sm-12 col-md-6 p-2 text-center">
                        <h5 >Datos del alumno:</h5>
                        <small>Si hay algun error en tus datos ve a <a href="{{ route('updateAccount') }}">editar cuenta</a> para corregirlo</small>
                        
                        <p>
                            <b>Nombre: </b>
                            {{$user->name.' '.$user->last_name}}
                        </p>
                        <p>
                            <b>Correo electróncico</b>
                            {{$user->email}}
                        </p>
                        <p>
                            <b>Altura: </b>
                            {{$user->height}}
                            cm
                        </p>
                        <p>
                            <b>Peso: </b>
                            {{$user->weight}}
                            kg
                        </p>

                        <p>
                            <b>Edad: </b>
                            {{$user->age}}
                            años
                        </p>

                        <p>
                            <b>Carrera: </b>
                            {{$user->career}}
                            {{$user->semester}}
                        </p>

                        <p>
                            <b>Servicio médico: </b>
                            {{$user->medical_service}}
                        </p>
                        <p>
                            <b>Tipo sanguineo: </b>
                            {{$user->blood_type}}
                        </p>
                        <p>
                            <b>Número de carnet: </b>
                            {{$user->medical_card_no}}

                        </p>

                        <p>
                            <b>Número telefonico: </b>
                            {{$user->phone_number}}
                        </p>
                    
                    </div>

                </div>
            </div>
            @if ($isSignedUp)
                <p class="d-block text-center">
                    Ya estas inscrito a este torneo
                    <br>
                    <a href="{{ route('tournamentVoucher', ['id' => Crypt::encrypt($tournament->id)] )}}">Descargar comprobante</a>
                </p>
            @else
                <form action="{{ route('signUpTournament', ['id' => Crypt::encrypt($tournament->id)])}}" method="post">
                    @csrf
                    <button type="submit" class="card-footer btn btn-info bg-info w-100">Inscribirme</button>
                </form>
            @endif
        </div>
    </div>
@endsection