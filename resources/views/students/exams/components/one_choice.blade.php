@section('style')
    <style>

    </style>
@endsection
@foreach($value->answers as $item)
<div class="multiple-choice">
    <div class="form-answer">
        <input type="radio" name="question_{{$value->id}}" id="question-1-answers-A" value="{!! $item->id!!} " />
        <label for="question-1-answers-A">{!! $item->answer!!} </label>
    </div>
</div>
@endforeach
