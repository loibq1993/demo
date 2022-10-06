@extends('layouts.app')
@section('style')
    <style>
        .row-click:hover{

        }
    </style>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <h2>Exams</h2>
            <table class="table table-striped mentors">
                <thead class="thead">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created date</th>
                    <th scope="col">Question</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createExam">
                            Launch demo modal
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $post)
                    <tr onclick="location.href='{{ route('teacher.exams.show', $post->id) }}'" class="row-click">
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{\Carbon\Carbon::parse($post->post_date)->format('Y-m-d')}}</td>
                        <td>{{count($post->questions)}}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('teacher.exams.preview', $post->id)}}"><i class="fa-solid fa-pen-to-square"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="createExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('teacher.exams.store')}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a new exam</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="title" placeholder="Title *" class="border-0 border-bottom w-100 p-2 mb-4" style="background-color: #fff">
                        <textarea name="description" placeholder="Description *" class="border-0 border-bottom w-100 p-2" style="background-color: #fff"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
