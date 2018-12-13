@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="ml-4">Mis equipos</h2>
        <div class="row justify-content-around">
            @foreach ($teams as $team)
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div 
                            class="
                                card-header 
                                {{$team->stateIs('accepted') ? 'bg-success' : ''}}
                                {{$team->stateIs('pending') ? 'bg-warning' : ''}}
                                {{$team->stateIs('denied') ? 'bg-danger' : ''}}
                            "
                        >
                            <h4>
                                {{$team->team->name}}
                            </h4>
                            @if ($team->isCaptain())
                                <span>Eres el capitan</span>
                            @endif
                        </div>

                        <div class="card-body">
                            <b>Torneo: </b>
                            {{$team->team->branch->tournament->name}} <br>
                            <b>Capitan:</b>
                            {{$team->team->captain->name}}
                            {{$team->team->captain->last_name}} <br>
                            <b>Integrantes del equipo:</b>
                            <div class="row">
                                @foreach ($team->team->accepted_users as $user)
                                    <div class="col-6">
                                        <li>{{$user->user->name}} {{$user->user->last_name}}</li>
                                    </div>
                                @endforeach
                            </div>
                            @if ($team->isCaptain())
                                <hr>
                                <b>Solicitudes</b>
                                @foreach ($team->team->requests as $request)
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-4">
                                                    {{$request->user->name}}
                                                    {{$request->user->last_name}}
                                                </div>

                                                <div class="col-4">
                                                    Teléfono: <br>
                                                    {{$request->user->phone_number}}
                                                </div>

                                                <div class="col-4">
                                                    Correo electrónico: <br>
                                                    <a href="mailto:{{$request->user->email}}">
                                                        {{$request->user->email}}
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                    
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-block text-right">
                                                        <form action="{{route('updateUserTeam', ['id' => $team->id])}}" method="post">
                                                            @method('put')
                                                            @csrf
                                                            <input type="hidden" name="request_id" value="{{$request->id}}">
                                                            <input class="btn btn-success" type="submit" value="Aceptar" name="action">
                                                            <input class="btn btn-danger" type="submit" value="Rechazar" name="action">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach                                
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection