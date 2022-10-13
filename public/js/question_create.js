$(document).ready(function () {
    let form = $('#form');
    $('#type').change(function () {
        let content = $('.content-form-exam');
        let view;
        content.empty();
        console.log(parseInt($(this).val()))
        switch (parseInt($(this).val())) {
            case 0  :
                view = `@include('teachers.exams.questions.components.multiple_choice')`;
                break;
            case 1:
                view = `@include('teachers.exams.questions.components.fill_the_blank')`;
                break;
            case 2:
                view = `@include('teachers.exams.questions.components.free_text')`;
                break;
            case 3:
                view = `@include('teachers.exams.questions.components.true_false')`;
                break;
            default:
                console.log('not selected')
                break;
        }
        content.append(view)
        ClassicEditor
            .create(document.querySelector('#editor_1'))
            .then(editor => {
            })
            .catch(error => {
            });
    })

    function changeInput(type) {
        if ([0, 3].indexOf(type) >= 0) {
            $('.correct-answer').each(function () {
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
        let view = `@include('teachers.exams.questions.components.multiple_input')`;
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
