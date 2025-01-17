@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header text-center">
                <h2>
                    {{$tournament->name}}
                    - rama 
                    {{ ucfirst($branch->branch)}}
                </h2>
            </div>

            <div class="card-body">
                <div class="row">
                    @role('student')
                    <div class="col-sm-12 col-md-6 p-2 text-center">
                    @else
                    <div class="col-sm-12 col-md-12 p-2 text-center">
                    @endrole
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
                            <b>Máximo de integrantes por equipo: </b>
                            {{$tournament->max_per_team}} <br>
                            <b>Minimo de integrantes por equipo: </b>
                            {{$tournament->min_per_team}} <br>
                            <b>Máximo de equipos: </b>
                            {{$tournament->max_teams}}
                        </p>
                        <p>
                            <b>Número de equipos que aun se pueden inscribir: </b>
                            {{$branch->roomLeft()}}
                        </p>

                        <p>
                            <b>Fecha: </b>
                            <date-format :date="'{{$tournament->date}}'" :format="'dddd D [de] MMMM [de] YYYY'"></date-format>
                        </p>
                    </div>
                    @role('student')
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
                    @endrole
                </div>
            </div>
            @role('student')
                @if ($branch->userSignedUp($user->id))
                    <p class="d-block text-center">
                        Ya estas inscrito a este torneo
                        <a href="{{route('teamsIndex')}}">Ver mis equipos</a>
                    </p>
                @else
                    <a href="{{route('teamSelect', ['id' => $branch->id ])}}" class="card-footer btn btn-info bg-info w-100">Elegir/crear equipo para inscribirme</a>
                @endif
            @endrole
        </div>
    </div>
@endsection