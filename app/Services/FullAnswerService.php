<?php

namespace App\Services;

use App\Models\CorrectAnswerDetail;
use App\Models\CorrectAnswers;
use App\Models\DetailFullAnswers;
use App\Models\FullAnswers;
use App\Models\Questions;
use Illuminate\Support\Facades\Log;

class FullAnswerService
{
    public function getAll()
    {
        return Questions::all();
    }

    public function storeFillTheBlank($questionId, $data)
    {
        $fullAnswer = FullAnswers::create([
            'question_id' => $questionId,
            'explanation' => $data['explanation'][0]
        ]);
        $correctAnswer = CorrectAnswers::create([
            'full_answer_id' => $fullAnswer->id,
        ]);
        $saving = [];

        for ($i = 0; $i < count($data['answer_type']); $i++) {
            $saving[$i]['answer_type'] = $data['answer_type'][$i];
            $saving[$i]['limit_text'] = (int)$data['limit_text'][$i];
            $saving[$i]['full_text_answer'] = $data['full_text_answer'][$i];
        }
        foreach ($saving as $key => $value) {
            DetailFullAnswers::create([
                'full_answer_id' => $fullAnswer->id,
                'answer_type' => $value['answer_type'],
                'limit_text' => $value['limit_text'],
                'full_text_answer' => $value['full_text_answer']
            ]);

            CorrectAnswerDetail::create([
                'correct_answer_id' =>  $correctAnswer->id,
                'correct_answer' => $value['full_text_answer'],
            ]);
        }

        return $fullAnswer;
    }
}
