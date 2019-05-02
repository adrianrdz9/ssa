@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h2>Crear equipo</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('teamsAdminIndex') }}" method="post">
                    @csrf

                    <input name="name" type="text" class="form-control" placeholder="Nombre del equipo" value="{{ old('name') }}">

                    <label for="branch_id"  class="mt-3"> Torneo</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                        @foreach (App\Branch::with('tournament')->get()->sortBy('tournament.name') as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->tournament->name }} - rama {{ $branch->branch }}</option>
                        @endforeach
                    </select>

                    <select-team-members></select-team-members>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="row justify-content-around">
                                <div class="col-sm-12 col-md-6 col-lg-4 checkbox-group form-check">
                                    <input type="checkbox" name="isRepresentative" id="isRepresentative"  value="true" {{old('isRepresentative') ? "checked" : "" }}>
                                    <label for="isRepresentative" >Equipo representativo  </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Crear" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection