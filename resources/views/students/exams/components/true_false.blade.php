@section('style')
    <style>

    </style>
@endsection
<div class="multiple-choice">
    <div class="form-answer">
        <div class="w-100">
            <input type="radio" name="question_{{$value->id}}" value="1"/>
            <label for="question-1-answers-A">True </label>
        </div>
        <div class="w-100">
            <input type="radio" name="question_{{$value->id}}"  value="0"/>
            <label for="question-1-answers-B">False </label>
        </div>
    </div>
</div>
