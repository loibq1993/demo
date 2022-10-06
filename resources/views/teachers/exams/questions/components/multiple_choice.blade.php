@section('style')
    <style>
        .btn-circle {
            width: 50px;
            height: 50px;
            padding: 10px 16px!important;
            font-size: 18px!important;
            line-height: 1.33!important;
            border-radius: 50%!important;
            margin-left:50%;
        }
        .checkbox{
            text-align: right;
        }
    </style>
@endsection
<div class="form-control mb-4">
    <div class="label-form mb-1">
        <span>Question *</span>
    </div>
    <div class="content-input">
        <textarea id="editor_1" name="question" class="editor"></textarea>
    </div>
</div>
@include('teachers.exams.questions.components.multiple_input')
<div class="add-form-control w-100" >
    <button href="#" class="btn btn-success btn-circle" type="button"><i class="fa fa-plus"></i></button>
</div>
