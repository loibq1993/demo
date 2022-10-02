@extends('layouts.app')
@section('style')
    <style>
        .row-click:hover{

        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{$exam->title}}</h1>
            <div class="questions">
                @foreach($exam->questions as $key => $value)
                    <div class="title">{{$value->title}}</div>
                    @foreach($value->answers as $item)
                        <div class="answer">{!! $item->answer !!}</div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
