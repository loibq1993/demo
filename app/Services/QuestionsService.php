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

    public function getAll()
    {
        return  Questions::all();
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
