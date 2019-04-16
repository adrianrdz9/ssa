@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Crear torneo rápido</h1>
        <span>Los torneos rápidos permiten agregar participantes a torneos ya creados usando solo el número de cuenta y nombre del participante</span>
        

        <div class="row">
            @foreach ($tournaments as $tournament)
                <div class="col-sm-12 col-md-6 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{ $tournament->name }}</h1>
                        </div>
                        <div class="card-body">
                            <h3>Requisitos</h3>
                            <ul>
                                @forelse ($tournament->requirements as $requirement)
                                    <li>{{$requirement->requirement}}</li>
                                @empty
                                    <span>Este torneo no tiene requerimientos especiales</span>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('quickShow', ['id' => $tournament->id]) }}" class="btn btn-info">
                                Agregar inscripciones rapidas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
   
   
    </div>
@endsection