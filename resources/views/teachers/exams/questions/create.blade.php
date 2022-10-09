@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Create questions</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom:0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('teacher.exams.question.store', $examId)}}" enctype="multipart/form-data" method="post" id="form">
                @csrf
                @method('post')
                <div class="mb-4 row">
                    <div class="col-9">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title here" style="background-color:#fff">
                    </div>
                    <div class="col-3">
                        <select class="form-control" style="background-color:#fff" name="type" id="type">
                            <option>Select an option</option>
                            @foreach($type as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="content-form-exam"></div>
                <button id="submit" name="submit" type="submit" class="btn btn-success mt-5 float-end">
                    Save
                </button>
                <a  href="{{ url()->previous() }}" class="btn btn-info mt-5 float-end" style="margin-right: 10px">
                    Back
                </a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/35.1.0/ckeditor.min.js"></script>
    <script>
        $( document ).ready(function () {
            let form =  $('#form');
            $('#type').change(function() {
                let content = $('.content-form-exam');
                let view;
                content.empty();
                console.log(parseInt($(this).val()))
                switch (parseInt($(this).val())) {
                    case 0  : view = `@include('teachers.exams.questions.components.multiple_choice')` ;
                        break;
                    case 1: view=`@include('teachers.exams.questions.components.fill_the_blank')`;
                        break;
                    case 2: view =`@include('teachers.exams.questions.components.free_text')` ;
                        break;
                    case 3: view =`@include('teachers.exams.questions.components.true_false')` ;
                        break;
                    default: console.log('not selected')
                        break;
                }
                content.append(view)
                ClassicEditor
                    .create( document.querySelector( '#editor_1' ) )
                    .then( editor => {
                    } )
                    .catch( error => {
                    } );
            })
            function changeInput(type) {
                if ([0, 3].indexOf(type) >= 0) {
                    $('.correct-answer').each(function() {
                        if (!$(this).parent().find('.correct-check').prop("checked")) {
                            $(this).val(0)
                        }
                    });
                    $('.checkbox').removeClass('d-none')
                } else {
                    $('.checkbox').addClass('d-none')
                    $('.correct-answer').val(1)
                }
            }

            form.on('click', '.btn-circle', function () {
                let content = $('.content-form-exam .multiple-input').last();
                let view = `@include('teachers.exams.questions.components.multiple_input')` ;
                content.after(view)
                let type = parseInt($('#type').val());
                changeInput(type);
            })


            form.on('change', '#type', function () {
                let type = parseInt($(this).val());
                changeInput(type)
            })

            form.on('click', '.correct-field', function () {
                if ($(this).find('.correct-check').is(":checked")) {
                    $(this).find('.correct-answer').val(1)
                } else {
                    $('.correct-answer').val(0)
                }
            })
        })
    </script>
@endsection
