<div class="form-control mb-4">
    <div class="label-form mb-1">
        <span>Question *</span>
    </div>
    <div class="content-input">
        <textarea id="editor_1" name="question"></textarea>
    </div>
    <div class="label-form mb-1 mt-3">
        <span>Explanation for answer</span>
    </div>
    <div class="content-input">
        <textarea name="answer[explanation][]" class="w-100"></textarea>
    </div>
    <div class="correct-field">
        <input type="hidden" name="answer[correct_answer][]" value="1" class="correct-answer">
        <div class="d-none checkbox p-1">
            <span>Correct Answer?</span>
            <input type="checkbox" class="correct-check">
        </div>
    </div>
    <div class="content-input">
        <input type="hidden" name="answer[value][]" value="1">
    </div>
</div>
