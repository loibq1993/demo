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
            <form>
                <div class="questions">
                    @foreach($exam->questions as $key => $value)
                        <div class="title mt-5">{!! $value->title !!}</div>
                        @include('teachers.exams.preview.components.'.$value->question_type->blade_view, ['value' => $value])
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
