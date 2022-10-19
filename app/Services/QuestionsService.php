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
        return Questions::create([
            'title'=> $data['title'],
            'type' => $data['type'],
            'question' => $data['question']
        ]);
    }

    public function getOne($id)
    {
        return Questions::find($id);
    }
}
