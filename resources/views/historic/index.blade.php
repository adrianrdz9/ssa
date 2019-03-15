@extends('layouts.app')

@section('content')

<div class="container ">
    <h1>Historico</h1>

    <div class="card mb-4" >
        <button class="card-header btn"  data-toggle="collapse" data-target="#generalInfo" aria-expanded="false" aria-controls="generalInfo">
            <h2>Información general</h2>
        </button>

        <div class="card-body collapse" id="generalInfo">
            <b>Total de torneos: </b>{{ $tournamentsCount }}<br>
            <b> Total de equipos creados:  </b> {{$teamsCount}} <br>

            <div class="row">
                <div class="col-6">
                    <div id="completed-signups"></div>
                </div>
                <div class="col-6 d-flex align-items-center" style="flex-wrap: wrap">
                    <div>
                        <b>Total de alumnos pre-inscritos: </b>{{ $userCount }}<br>
                        <b>Total de inscripciones completadas: </b>{{ $completedUserCount }} <br>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-6">
                    <div id="teams-per-branch"></div>
                </div>
                <div  class="col-6 d-flex align-items-center" style="flex-wrap: wrap;">
                    <div>
                        <b>Total de equipos en ramas varoniles: </b> {{$teamsPerBranch['varonil']}} <br>
                        <b>Total de equipos en ramas femeniles: </b>{{$teamsPerBranch['femenil']}}<br>
                        <b>Total de equipos en ramas mixtas: </b>{{$teamsPerBranch['mixto']}}<br>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="card">
        <button class="card-header btn" data-toggle="collapse" data-target="#specificInfo" aria-expanded="false" aria-controls="specificInfo">
            <h2>Información por torneo</h2>

        </button>

        <div class="card-body collapse" id="specificInfo"  style="transform: translateZ(0)">
            <tournament-historic :tournaments="{{$tournaments}}"></tournament-historic>
        </div>
    </div>
</div>

@endsection
@piechart('completed-signups', 'completed-signups')
@piechart('teams-per-branch', 'teams-per-branch')
