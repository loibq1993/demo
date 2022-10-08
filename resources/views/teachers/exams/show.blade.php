@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mb-5">{{$data->title}}</h1>
            <div class="box-exam row">
                <table class="table table-striped mentors">
                    <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created date</th>
                        <th scope="col">
                            <a href="{{route('teacher.exams.question.create', $data->id)}}" class="btn btn-primary">
                                Create question
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->questions as $key => $question)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$question->question_type->name}}</td>
                            <td>{{$question->title}}</td>
                            <td>{{\Carbon\Carbon::parse($question->date)->format('Y-m-d')}}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('teacher.exams.question.edit', ['exam_id' => $data->id, 'id' => $question->id])}}"><i class="fa-solid fa-pen-to-square"></i> </a>
                                <form action="{{route('teacher.exams.question.delete', ['exam_id' => $data->id, 'id' => $question->id])}}" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a  href="{{ route('teacher.exams.index') }}" class="btn btn-info mt-5 float-end" style="margin-right: 10px">
            Back
        </a>
    </div>
@endsection
@section('scripts')

@endsection
