@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <edit-tournament :r="{{$requirements}}" :s="{{$sports}}" :t="{{$tournament}}"></edit-tournament>
    </div>
@endsection