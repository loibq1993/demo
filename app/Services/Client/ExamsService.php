<?php

namespace App\Services\Client;

use App\Models\Exams;

class ExamsService
{
    public function getAllExams()
    {
        return Exams::all()->toArray();
    }

    public function getExamToClient($id)
    {
        return Exams::with(['examQuestions' => [
            'questions' => [
                'fullAnswers' => [
                    'detailFullAnswers',
                    'correctAnswers' => ['correctAnswerDetail']
                ]
            ]
        ]])->where('id', $id)->first();
    }
}
