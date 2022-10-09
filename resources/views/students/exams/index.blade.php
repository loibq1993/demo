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
            <form method="POST" action="{{route('student.exam.post', $exam->id)}}">
                @csrf
                @method('POST')
                <input type="hidden" name="start_time" value="{{$start_time }}">
                @if (!\Illuminate\Support\Facades\Auth::user())
                    <input type="text" name="email" id="email" class="form-control col-3 bg-white mb-3" placeholder="email" required/>
                @else
                    <div class="container border mb-2 bg-white">
                        <div class="row">
                            <label class="col-1">Name:</label>
                            <div class="col-3">{{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                        </div>
                        <div class="row">
                            <label class="col-1">Email:</label>
                            <div class="col-3">{{\Illuminate\Support\Facades\Auth::user()->email}}</div>
                        </div>
                    </div>
                @endif
                <div class="questions border px-lg-5 py-lg-5 bg-white">
                    @foreach($exam->questions as $key => $value)
                        <div class="title mt-5">{!! $value->title !!}</div>
                        @include('students.exams.components.'.$value->question_type->blade_view, ['value' => $value])
                    @endforeach
                </div>
                <div class="submit mt-5 float-end">
                    <button class="btn btn-info">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
