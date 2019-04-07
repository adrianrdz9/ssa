@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <h3>Nuevo torneo</h3>
            </div>
            <div class="card-body">
                <form action="/actividades-deportivas/torneos/nuevo" method="post">
                    @csrf
                    <input type="text" name="name" id="name" class="form-control my-2" placeholder="Nombre del torneo" required value="{{ old('name') }}">
                    <input type="text" name="responsable" id="responsable" class="form-control my-2" placeholder="Responsable del torneo" required value="{{ old('responsable') }}">
                    <input type="text" name="place" id="place" class="form-control my-2" placeholder="Sede" required value="{{ old('place') }}">
                    <input type="text" name="semester" id="semester" class="form-control my-2" placeholder="Semestre del torneo" required value="{{ old('semester') }}">
                    
                    
                    <div class="w-100 px-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                                <label for="date" class="mb-0"><small>Fecha del torneo</small></label>
                                <input type="date" name="date" id="date" class="form-control" required value="{{ old('date') }}">
                            </div>
    
                            <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                                <label for="technic_meeting" class="mb-0"><small>Fecha de la reunion técnica</small></label>
                                <input type="date" name="technic_meeting" id="technic_meeting" class="form-control" required value="{{ old('technic_meeting') }}">
                            </div>
    
                            <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                                <label for="signup_close" class="mb-0"><small>Cierre de inscripciones</small></label>
                                <input type="date" name="signup_close" id="signup_close" class="form-control" required value="{{ old('signup_close') }}">
                            </div>
    
                            <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                                <label for="max_teams"></label>
                                <input type="number" name="max_teams" id="max_teams" min="1" class="form-control" placeholder="Máximo de equipos" required value="{{ old('max_teams') }}">
                            </div>
    
                            <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                                <label for="min_per_team"></label>
                                <input type="number" name="min_per_team" id="min_per_team" min="1" class="form-control" placeholder="Mínimo de integrantes" required value="{{ old('min_per_team') }}">
                            </div>
    
                            <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                                <label for="max_per_team"></label>
                                <input type="number" name="max_per_team" id="max_per_team" min="1" class="form-control" placeholder="Máximo de integrantes" required value="{{ old('max_per_team') }}">
                            </div>
                        </div>

                        <create-tournament :s="{{$sports}}" :r="{{$requirements}}"></create-tournament>
            
                        <div class="row mt-2">
                            <div class="col-12 text-center">
                                <span>Ramas disponibles</span>
                                <div class="row">
                                    <div class="col checkbox-group form-check">
                                        <input type="checkbox" name="branch[]" id="branch-varonil"  value="varonil">
                                        <label for="branch-varonil">Varonil</label>
                                    </div>
                                    <div class="col checkbox-group">
                                        <input type="checkbox" name="branch[]" id="branch-femenil"  value="femenil">
                                        <label for="branch-femenil">Femenil</label>
                                    </div>
                                    <div class="col checkbox-group">
                                        <input type="checkbox" name="branch[]" id="branch-mixto"  value="mixto">
                                        <label for="branch-mixto">Mixto</label>
                                    </div>
    
                                    <div class="text-red col-12 text-left d-none" id="checkbox-error">
                                        Debes de elegir al menos una opcion
                                    </div>
                                </div>
                            </div>
                        </div>
    

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="row justify-content-around">
                                    <div class="col-sm-12 col-md-6 col-lg-4 checkbox-group form-check">
                                        <input type="checkbox" name="only_representative" id="only_representative"  value="true" {{old('only_representative') ? "checked" : "" }}>
                                        <label for="only_representative" >Solo equipos representativos  </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-75 mx-auto d-block mt-4" >Crear</button>
                </form>
            </div>
        </div>

    </div>
@endsection
