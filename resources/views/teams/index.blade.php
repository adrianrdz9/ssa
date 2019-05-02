@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @role('admin')
            <h2 class="ml-4">Equipos</h2>
        @else
            <h2 class="ml-4">Mis equipos</h2>
        @endrole
        <div class="row justify-content-around">
            @foreach ($teams as $team)
                <div class="col-lg-6 col-sm-6">
                    @role('admin')
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    {{$team->name}}
                                </h4>
                                <strong>Capitan: </strong>{{$team->captain->name}} {{$team->captain->last_name}}s
                            </div>

                            <div class="card-body">
                                <b>Torneo: </b>
                                {{$team->branch->tournament->name}} <br>
                                <b>Capitan:</b>
                                {{$team->captain->name}}
                                {{$team->captain->last_name}} <br>
                                <span>
                                    El equipo debe de ser de entre 
                                    {{$team->branch->tournament->min_per_team}}
                                    y
                                    {{$team->branch->tournament->max_per_team}}
                                </span><br>
                                <b>Integrantes del equipo:</b>
                                <div class="row">
                                    @foreach ($team->accepted_users as $user)
                                        <div class="col-6">
                                            <li>{{$user->user->name}} {{$user->user->last_name}}</li>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <span>
                                    Recuerda que no tu equipo no esta inscrito hasta que cierres inscripciones y lleves 
                                    el combrobante de inscripción a Actividades deportivas para que se valide tu equipo 
                                </span><br>
                                @if ($team->available)
                                    @if ($team->canClose())
                                        <form action="{{route('closeTeam', ['id' => $team->id])}}" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-warning" value="Cerrar inscripciones a este equipo"> <br>
                                        </form>
                                        <small>Ya nadie mas se podrá inscribir al torneo</small>    
                                    @else
                                        <button class="btn btn-warning" disabled>Cerrar inscripciones a este equipo</button> <br>
                                        <small>Le hacen falta integrantes a tu equipo</small> 
                                    @endif
                                
                                @else
                                    <span>Imprime tu comprobante y llevalo a actividades deportivas para completar la inscripcion</span><br>
                                    <a href="{{route('getVoucher', ['id' => $team->id])}}">Descargar comprobante</a>
                                @endif
                                <hr>
                                <b>Solicitudes</b>
                                @foreach ($team->requests as $request)
                                    @if (!$request->stateIs('accepted'))
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
                                    @endif
                                @endforeach                                
                            </div>
                        </div>
                    @else
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

                                @if ($team->stateIs('pending'))
                                    <span>Solicitud pendientee</span>
                                @endif
                            </div>

                            <div class="card-body">
                                <b>Torneo: </b>
                                {{$team->team->branch->tournament->name}} <br>
                                <b>Capitan:</b>
                                {{$team->team->captain->name}}
                                {{$team->team->captain->last_name}} <br>
                                <span>
                                    El equipo debe de ser de entre 
                                    {{$team->team->branch->tournament->min_per_team}}
                                    y
                                    {{$team->team->branch->tournament->max_per_team}}
                                </span><br>
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
                                    <span>
                                        Recuerda que no tu equipo no esta inscrito hasta que cierres inscripciones y lleves 
                                        el combrobante de inscripción a Actividades deportivas para que se valide tu equipo 
                                    </span><br>
                                    @if ($team->team->available)
                                        @if ($team->team->canClose())
                                            <form action="{{route('closeTeam', ['id' => $team->team->id])}}" method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-warning" value="Cerrar inscripciones a este equipo"> <br>
                                            </form>
                                            <small>Ya nadie mas se podrá inscribir al torneo</small>    
                                        @else
                                            <button class="btn btn-warning" disabled>Cerrar inscripciones a este equipo</button> <br>
                                            <small>Le hacen falta integrantes a tu equipo</small> 
                                        @endif
                                    
                                    @else
                                        <span>Imprime tu comprobante y llevalo a actividades deportivas para completar la inscripcion</span><br>
                                        <a href="{{route('getVoucher', ['id' => $team->team->id])}}">Descargar comprobante</a>
                                    @endif
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
                                                            <form action="{{route('updateUserTeam', ['id' => $team->team->id])}}" method="post">
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
                    @endrole
                </div>
            @endforeach
        </div>
    </div>
@endsection