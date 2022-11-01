<?php

namespace App\Services;

use App\Models\ExamQuestions;
use App\Models\Questions;

class QuestionsService
{
    protected FullAnswerService $fullAnswerService;

    public function __construct(FullAnswerService $fullAnswerService)
    {
        $this->fullAnswerService = $fullAnswerService;
    }

    public function getAllWithExamId($examId)
    {
        return ExamQuestions::join('questions', 'questions.id', '=', 'exam_questions.question_id')
            ->where('exam_questions.exam_id', $examId)->with([
                'questions' => ['fullAnswers' => [
                    'detailFullAnswers',
                    'correctAnswers' => ['correctAnswerDetail']
                ]]
            ])->get();
    }

    public function store($data)
    {
        return Questions::create($data);
    }

    public function getOne($id)
    {
        return Questions::with(['fullAnswers' => [
            'detailFullAnswers',
            'correctAnswers' => ['correctAnswerDetail']
        ]])->where('id', $id)->first();
    }

    public function createExamQuestion($data)
    {
        return ExamQuestions::create($data);
    }
}
