@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($sports as $sport)
        <div class="card mb-4">
            <div class="card-header">{{$sport->name}}</div>
            <div class="card-body">
                {{$sport->uniqueTournaments()->count()}}
                torneo(s) de este deporte:

                @foreach ($sport->uniqueTournaments() as $tournamentName=>$tournamentGroup)
                    <div class="accordion" id="sport-{{$sport->id}}">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#tournament-info-{{$tournamentGroup[0]->id}}" aria-expanded="false" aria-controls="#tournament-info-{{$tournamentGroup[0]->id}}">
                                        {{$tournamentName}}
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse" id="tournament-info-{{$tournamentGroup[0]->id}}">
                                <div class="card-body">
                                    Fecha: {{$tournamentGroup[0]->date}}
                                    <br>
                                    Ramas: 
                                    @foreach ($tournamentGroup as $branch)
                                        @switch($branch->branch)
                                            @case('varonil')
                                                <span class="badge badge-pill badge-primary">Varonil</span>                                            
                                                @break
                                            @case('femenil')
                                                <span class="badge badge-pill badge-success">Femenil</span>                                            
                                                @break
                                            @case('mixto')
                                                <span class="badge badge-pill badge-warning">Mixto</span>
                                                @break   
                                        @endswitch
                                    @endforeach
                                    <br>
                                    @if ($tournamentGroup[0]->roomLeft() > 0)
                                        <span class="badge badge-success" style="font-size: 0.9em;">Lugares disponibles</span>
                                        @auth
                                            <a href="{{route('signUpTournament', ['id' => Crypt::encrypt($branch->id)])}}" class="btn btn-info">Inscribirme</a>
                                        @else
                                            <a href="{{route('login')}}">Inicia sesion</a>
                                            para inscribirte al torneo
                                        @endauth
                                    @else
                                        <span class="badge badge-danger" style="font-size: 0.9em;">Ya no hay lugares</span>
                                    @endif
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
