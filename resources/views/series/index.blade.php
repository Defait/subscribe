@extends('layouts.content')

@section('content')
    @foreach($series as $serie)
        <a href="{{$serie->slug}}">{{$serie->title}}</a> <br>
    @endforeach
@endsection