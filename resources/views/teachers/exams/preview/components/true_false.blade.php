@section('style')
    <style>

    </style>
@endsection
@foreach($value->answers as $item)
<div class="multiple-choice">
    <div class="form-answer">
        <div class="w-100">
            <input type="radio" name="question-1-answers" id="question-1-answers-A" value="{!! $item->id!!} "/>
            <label for="question-1-answers-A">True </label>
        </div>
        <div class="w-100">
            <input type="radio" name="question-1-answers" id="question-1-answers-B" value="{!! $item->id!!} "/>
            <label for="question-1-answers-B">False </label>
        </div>
    </div>
</div>
@endforeach
