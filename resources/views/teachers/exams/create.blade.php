@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Create exam</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom:0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('teacher.exams.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('post')
                <div class="mb-3">
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title here" style="background-color:#fff">
                </div>
                <textarea id="editor" name="post"></textarea>
                <button id="submit" name="submit" type="submit" class="btn btn-success mt-5 float-end">
                    Save
                </button>
                <a  href="{{ route('student.index') }}" class="btn btn-info mt-5 float-end" style="margin-right: 10px">
                    Back
                </a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
            } )
            .catch( error => {
            } );
    </script>
@endsection
