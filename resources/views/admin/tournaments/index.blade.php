@extends('layouts.app')

@section('content')
    <nav class="py-2 px-4 row">
        <h1 class="col-12 text-center">Torneos</h1>
    </nav>
    <div class="row">
        @foreach ($tournaments as $tName=>$branches)
            <div class="col-12 p-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>
                            {{$tName}}
                            -
                            <date-format :date="'{{$branches[0]->date}}'" :format="'dddd D [de] MMMM [de] YYYY'"></date-format>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="h3 ml-4">Ramas disponibles</span>
                            </div>
                            @foreach ($branches as $branch)
                                <div class="col p-3">
                                    <div class="card">
                                        <div class="card-header bg-green">
                                            {{ucfirst($branch->branch)}}
                                        </div>

                                        <div class="card-body">
                                            <p>
                                                <b>Máximo: </b>
                                                {{$branch->max_room}}
                                            </p>
                                            <p>
                                                <b>Lugares disponibles: </b>
                                                {{ $branch->roomLeft() }}
                                            </p>
                                            <p>
                                                <b>Registros completados: </b>
                                                {{$branch->completedSignups()->count()}}
                                            </p>
                                            <p>
                                                <a href="{{ route('cedula', ['id' => Crypt::encrypt($branch->id)])}}" class="btn btn-info" target="blank">Ver cédula de registro</a>
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <form action="{{route('deleteTournament', ['id' => Crypt::encrypt($branch->id)])}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="submit" value="Eliminar" class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        @endforeach 
    </div>


    <br>
@endsection