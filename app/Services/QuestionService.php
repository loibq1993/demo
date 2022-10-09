<?php

namespace App\Services;

use App\Models\Answers;
use App\Models\Exams;
use App\Models\Questions;

class QuestionService
{
    public function handleSaveQuestion($request, $examId)
    {
        return Questions::create([
            'title' => $request['title'] ?? 'Null',
            'type' => $request['type'],
            'description' => $request['description'],
            'exam_id' => $examId,
            'question' => $request['question']
        ]);
    }
}
