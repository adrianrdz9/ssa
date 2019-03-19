@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($sports as $sport)
        <div class="card mb-4">
            <div class="card-header">{{$sport->name}}</div>
            <div class="card-body">
                {{$sport->tournaments->count()}}
                torneo(s) de este deporte:

                @foreach ($sport->tournaments as $tournament)
                    <div class="accordion" id="sport-{{$sport->id}}">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tournament-info-{{$tournament->id}}" aria-expanded="false" aria-controls="#tournament-info-{{$tournament->id}}">
                                        {{$tournament->name}}
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse" id="tournament-info-{{$tournament->id}}">
                                <div class="card-body">
                                    Fecha: {{$tournament->date}}
                                    <br>
                                    Ramas: 
                                    @foreach ($tournament->branches as $branch)
                                        <div class="card">
                                            <div class="card-header">
                                                @switch($branch->branch)
                                                    @case('varonil')
                                                        <h4>Varonil</h4>                                            
                                                        @break
                                                    @case('femenil')
                                                        <h4>Femenil</h4>                                            
                                                        @break
                                                    @case('mixto')
                                                        <h4>Mixto</h4>
                                                        @break   
                                                @endswitch
                                            </div>
                                            <div class="card-body">
                                                @if ($branch->roomLeft() > 0)
                                                    <span class="badge badge-success">Lugares disponibles</span>
                                                    @auth
                                                        <a href="{{route('signUpTournament', ['id' => $branch->id])}}" class="btn btn-info">
                                                            @role('student')
                                                                Inscribirme
                                                            @else
                                                                Ver
                                                            @endrole
                                                        </a>
                                                    @else
                                                        <a href="{{route('login')}}">Inicia sesion</a>
                                                        para inscribirte al torneo
                                                    @endauth
                                                @else
                                                    <span class="badge badge-danger" style="font-size: 0.9em;">Ya no hay lugares</span>
                                                @endif
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
