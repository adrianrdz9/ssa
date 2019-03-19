@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Obtener cédula de inscripciones</h1>
        @foreach ($sports as $sport)
            <hr>
            <div class="card">
                @if($sport->hasSignups())
                <div class="card-header bg-warning">
                @else
                <div class="card-header bg-secondary">
                @endif
                    <h2>
                        {{$sport->name}}
                        {{$sport->hasSignups() ? "" : "(Nadie se ha inscrito a un torneo de este deporte)"}}
                    </h2>
                </div>

                <div class="card-body">
                    <h3>
                        Torneos:
                    </h3>
                    
                    @foreach ($sport->tournaments as $tournament)
                        <div class="accordion" id="a{{$tournament->id}}">
                            <div class="card">
                                <button class="card-header btn bg-primary " 
                                        {{$tournament->hasSignups() ?: "disabled"}}
                                        id="th{{$tournament->id}}"
                                        type="button" data-toggle="collapse" data-target="#c{{$tournament->id}}"
                                        aria-expanded="false" aria-controls="c{{$tournament->id}}">
                                    {{$tournament->name}}
                                    {{$tournament->hasSignups() ? "" : "(Sin inscripciones)"}}
                                </button>
                                <div id="c{{$tournament->id}}" class="collapse" data-parent="#a{{$tournament->id}}"
                                    aria-labelledby="th{{$tournament->id}}">
                                    <div class="card-body">
                                        <div class="d-block text-right">
                                            @if($tournament->hasSignups())
                                            <a href="{{route('tournamentCedula', ['id'=>$tournament->id])}}">Generar cedula de este torneo</a>
                                            @endif
                                        </div>
                                        <h3>
                                            Ramas:
                                        </h3>
                                        @foreach ($tournament->branches as $branch)
                                            <div class="accordion" id="ab{{$branch->id}}">
                                                <div class="card">
                                                    <button class="card-header btn bg-info" id="hb{{$branch->id}}"
                                                            {{$branch->hasSignups() ?: "disabled"}}
                                                            type="button" data-toggle="collapse" data-target="#bc{{$branch->id}}"
                                                            aria-expanded="false" aria-controls="bc{{$branch->id}}">
                                                            {{$branch->branch}}
                                                            {{$branch->hasSignups() ? "" : "(Sin inscripciones)"}}
                                                    </button>
                                                    <div class="collapse" id="bc{{$branch->id}}" data-parent="#ab{{$branch->id}}"
                                                        aria-labelledby="hb{{$branch->id}}">
                                                        <div class="card-body">
                                                            <h4>
                                                                Equipos:
                                                            </h4>
                                                            @foreach ($branch->teams as $team)
                                                                <div class="accordion" id="at{{$team->id}}">
                                                                    <div class="card">
                                                                        <button class="card-header btn bg-success" id="ht{{$team->id}}"
                                                                                {{$branch->hasSignups() ?: "disabled"}}
                                                                                type="button" data-toggle="collapse" data-target="#tc{{$team->id}}"
                                                                                aria-expanded="false" aria-controls="tc{{$team->id}}">
                                                                                {{$team->name}}
                                                                        </button>
                    
                                                                        <div class="collapse" id="tc{{$team->id}}" data-parent="#at{{$team->id}}"
                                                                            aria-labelledby="ht{{$team->id}}">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        @if ($team->available)
                                                                                            <span>Este equipo sigue aceptando inscripciones</span>
                                                                                        @else
                                                                                            <span>Este equipo ya se cerro</span>
                                                                                        @endif

                                                                                        @if ($team->completed)
                                                                                            <br><span>Este equipo ya completo la inscripcion al torneo</span>
                                                                                        @endif
                                                                                    </div>

                                                                                    <div class="col-6">
                                                                                        <div class="d-block text-right">
                                                                                            <a href="{{route('teamCedula', ['id'=>$team->id])}}">Generar cedula de este equipo</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    @foreach ($team->accepted_users as $user)
                                                                                        <?php $user = $user->user ?>
                                                                                        <div class="col-auto">
                                                                                            <div class="card">
                                                                                                <div style="min-width: 270;">
                                                                                                    <img class="card-img-top mx-auto d-block" src="{{$user->avatarPath()}}" style="height: 100px; width: auto;">
                                                                                                </div>
                                                                                                <div class="card-header">
                                                                                                    <h5>
                                                                                                        {{$user->name}}
                                                                                                        {{$user->last_name}}
                                                                                                    </h5>
                                                                                                </div>

                                                                                                <div class="card-body">
                                                                                                    <b>Carrera: </b> {{$user->career}} <br>
                                                                                                    <b>Edad: </b> {{$user->age}} <br>
                                                                                                    <b>Curp: </b> {{$user->curp}} <br>
                                                                                                    <b>Servicio medico: </b> {{$user->medical_service}} <br>
                                                                                                    <b>Numero de carnet: </b> {{$user->medical_card_no}} <br>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection