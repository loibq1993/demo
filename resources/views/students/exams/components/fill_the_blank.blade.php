@section('style')
    <style>
        .replaced-input {
            width: 50px!important;
        }
    </style>
@endsection

<div class="fill-the-blank">
        {!! $value->question !!}
</div>
@section('scripts')
    <script>
        $( document ).ready(function () {
            let someVar;
            someVar = $('.fill-the-blank').html();
            someVar = someVar.replaceAll('___', '<input type="text" name="question_{{$value->id}}[]" class="replaced-input" style="width: 50px"/>');
            $('.fill-the-blank').html(someVar);
        })
    </script>
@endsection
