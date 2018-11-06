@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($sports as $sport)
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        {{$sport->name}}
                    </div>
                    <div class="col-3 text-right">
                        <a href="#" data-toggle="modal" data-target="#edit-{{$sport->id}}">Editar</a>
                        <div class="modal fade" id="edit-{{$sport->id}}" tabindex="-1" role="dialog" >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Editar deporte
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('updateSport', ['id' => $sport->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="text" name="name" placeholder="Nombre" value="{{$sport->name}}">
                                            <input type="submit" value="Actualizar" class="btn btn-success">
                                        </form>
                                        <form action="{{ route('deleteSport', ['id' => $sport->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
