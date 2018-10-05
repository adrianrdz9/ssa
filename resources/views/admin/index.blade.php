@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger fixed-top">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <notices-carousel-editor :s="{{$slides}}"></notices-carousel-editor>
@endsection