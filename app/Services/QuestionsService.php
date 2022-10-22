<?php

namespace App\Services;

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
        return Questions::find($id);
    }
}
