<?php

namespace App\Services;

use App\Models\Answers;
use App\Models\Exams;

class AnswerService
{
    public function handleSaveAnswer($request, $question)
    {
        foreach ($request['answer']['value'] as $key => $item) {
            if ($question->question_type->blade_view == 'fill_the_blank') {
                $this->saveFillBlankAnswer($request, $question, $item, $key);
            } else {
                $this->storeAnswer($request, $question, $item, $key);
            }
        }
    }

    public function saveFillBlankAnswer($request, $question, $item, $key)
    {
        $singleValue = explode(', ', $item);
        foreach ($singleValue as $value) {
            $this->storeAnswer($request, $question, $value, $key);
        }
    }

    public function storeAnswer($request, $question, $item, $key)
    {
        return Answers::create([
            'question_id' => $question->id,
            'answer' => $item,
            'correct_answer' => (int)$request['answer']['correct_answer'][$key],
            'explanation' => $request['answer']['explanation'][$key]
        ]);
    }
}
