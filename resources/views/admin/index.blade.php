@extends('layouts.app')

@section('content')

    <notices-carousel-editor :s="{{$slides}}"></notices-carousel-editor>
@endsection