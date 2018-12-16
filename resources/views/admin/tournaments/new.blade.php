@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <create-tournament :s="{{$sports}}" :r="{{$requirements}}"></create-tournament>
    </div>
@endsection
