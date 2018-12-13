@extends('layouts.app')

@section('content')
    <nav class="py-2 px-4 row">
        <h1 class="col-12 text-center">Torneos</h1>
    </nav>
    <div class="row">
        @foreach ($tournaments as $tournament)
            <div class="col-12 p-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>
                            {{$tournament->name}}
                            -
                            <date-format :date="'{{$tournament->date}}'" :format="'dddd D [de] MMMM [de] YYYY'"></date-format>
                        </h2>
                        @role('admin')
                            <a href="{{route('editTournament', ['id' => $tournament->id])}}">Editar</a>
                        @endrole
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="h3 ml-4">Responsable: {{$tournament->responsable}}</span><br>
                                <span class="h3 ml-4">Sede: {{$tournament->place}}</span><br>
                                <span class="h3 ml-4">Deporte: {{$tournament->sport->name}}</span><br>
                                @if(!$tournament->only_representative)
                                    <span class="h4 ml-4">Fecha máxima de inscripción: <date-format :date="'{{$tournament->signup_close}}'" :format="'D [de] MMMM [de] YYYY'"></date-format></span>
                                @endif
                            </div>

                            @if (!$tournament->only_representative)
                                <div class="col-12">
                                    <span class="h3 ml-4">Ramas disponibles</span>
                                </div>
                                @foreach ($tournament->branches as $branch)
                                    <div class="col p-3">
                                        <div class="card">
                                            <div class="card-header bg-green">
                                                {{ucfirst($branch->branch)}}
                                            </div>

                                            <div class="card-body">
                                                <p>
                                                    <b>Deporte: </b>
                                                    {{$tournament->sport->name}}
                                                </p>
                                                <p>
                                                    <b>Máximo de equipos: </b>
                                                    {{$tournament->max_teams}} <br>
                                                    <b>Mínimo de integrantes por equipo: </b>
                                                    {{$tournament->min_per_team}} <br>
                                                    <b>Máximo de integrantes por equipo: </b>
                                                    {{$tournament->max_per_team}} <br>
                                                </p>
                                                <p>
                                                    <b>Lugares para equipos disponibles: </b>
                                                    {{ $branch->roomLeft() }}
                                                </p>
                                                <p>
                                                    <b>Requisitos: </b><br>
                                                    <ul>
                                                        @foreach ($tournament->requirements as $requirement)
                                                            <li>{{$requirement->name}}</li>
                                                        @endforeach
                                                    </ul>
                                                </p>
                                                @auth
                                                    <a href="{{route('signUpTournament', ['id' => $branch->id])}}" class="btn btn-info">
                                                        @role('admin')
                                                            Ver
                                                        @else
                                                            Inscribirme
                                                        @endrole
                                                    </a>
                                                @else
                                                    <a href="{{route('login')}}">Inicia sesion</a>
                                                    para inscribirte al torneo
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span class="h3 mt-4 d-block mx-auto">Torneo exclusivo para equipos representativos.</span>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach 
    </div>
@endsection