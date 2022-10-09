@section('style')
    <style>

    </style>
@endsection
@foreach($value->answers as $item)
    <div class="multiple-choice">
        <div class="form-answer">
            <input type="checkbox" name="question_{{$value->id}}[]" value="{!! $item->id!!} " />
            <label for="question-1-answers-A">{!! $item->answer!!} </label>
        </div>
    </div>
@endforeach
