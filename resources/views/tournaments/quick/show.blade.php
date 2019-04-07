@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">
            {{$tournament->name}}
        </h1>
        <div class="row justify-content-around">
            <div class="card col-md-6 col-sm-12 p-4">
                <ul>
                    @forelse ($tournament->requirements as $requirement)
                        {{$requirement->requirement}}
                    @empty
                        <span>Este torneo no tiene requerimientos especiales</span>
                    @endforelse
                </ul>
            </div>
        </div>

        <create-quick-signup :id="{{$tournament->id}}" :u="{{ $tournament->quickUsers }}"></create-quick-signup>
    </div>
@endsection