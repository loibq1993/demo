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
                        @foreach($value->answers as $item)
                            @switch($value->type)
                                @case(0)
                                    @include('teachers.exams.preview.components.multiple_choice', ['item' => $item, 'question' => $value->question])
                                    @break
                                @case(1)
                                    @include('teachers.exams.preview.components.fill_the_blank',  ['item' => $item, 'question' => $value->question])
                                    @break
                                @case(2)
                                    @include('teachers.exams.preview.components.one_choice',  ['item' => $item, 'question' => $value->question])
                                    @break
                                @case(3)
                                    @include('teachers.exams.preview.components.true_false',  ['item' => $item, 'question' => $value->question])
                                    @break
                                @default
                                    @break
                            @endswitch
                        @endforeach
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
