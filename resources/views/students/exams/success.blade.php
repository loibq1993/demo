@extends('layouts.app')
@section('style')
    <style>
        .row-click:hover{

        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center container">
            <h2 class="">Your score</h2>
            <div class="col-5 offset-2 p-3 border">
                <div class="container">
                    @if(!$userExam->user_id)
                        <div class="user row">
                            <label class="col-3">Email:</label>
                            <div class="email col-3" >{{$userExam->email}}</div>
                        </div>
                    @else
                        <div class="user row">
                            <label class="col-3">Name:</label>
                            <div class="email col-3">{{$userExam->user->name}}</div>
                        </div>
                    @endif
                    <div class="exam row">
                        <label class="col-3">Exam:</label>
                        <div class="exam_title col-3">{{$userExam->exam->title}}</div>
                    </div>
                    <div class="date row">
                        <label class="col-3">Test date:</label>
                        <div class="test_date col-3">{{\Carbon\Carbon::parse($userExam->test_date)->format('Y-m-d')}}</div>
                    </div>
                    <div class="duration row">
                        <label class="col-3">Duration:</label>
                        <div class="duration_time col-3">{{gmdate("H:i:s", $userExam->duration)}}</div>
                    </div>
                    <div class="score row">
                        <label class="col-3">Score:</label>
                        <div class="user_score col-3">{{$userExam->score}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
