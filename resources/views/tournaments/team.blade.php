@extends('layouts.app')

@section('content')
    <h1 class="d-block text-center">{{$tournament->name}} - {{$branch->branch}}</h1>
    <h2 class="d-block text-center">Equipos de entre {{$tournament->min_per_team}} y {{$tournament->max_per_team}}</h2>
    <team-index :t="{{$branch->teams}}" :tr="{{$tournament}}" :branch="{{$branch}} "></team-index>
@endsection