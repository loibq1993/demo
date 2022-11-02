<?php

namespace App\Services\Client;

use App\Models\Exams;
use App\Models\FullAnswers;
use App\Models\Questions;
use App\Models\UserExamAnswers;
use App\Models\UserExamQuestion;
use App\Models\UserExams;
use Carbon\Carbon;

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

    public function saveUserExam($request)
    {
        $exam = Exams::find($request['exam_id']);
        $duration = gmdate("H:i:s", strtotime($exam->count_down) - strtotime($request['count_down']));

        $userExam = UserExams::create([
            'email' => $request['email'] ?? null,
            'user_id' => $request['user_id'] ?? null,
            'exam_id' => $request['exam_id'],
            'test_date' => Carbon::now(),
            'duration' => $duration
        ]);
        foreach ($request as $key => $item) {
            if (str_contains($key, 'answers')) {
                $fullAnswerDataId = trim(trim($key), 'answers_');
                $fullAnswerData = FullAnswers::find($fullAnswerDataId);
                $question = Questions::find($fullAnswerData->question_id);
                $this->handleSaveAnswer($item, $question, $fullAnswerData, $userExam);
            }
        }
        $userExam->score = $this->handleCalculateExam($userExam);
        $userExam->save();

        return $userExam;
    }

    public function handleSaveAnswer($userAnswer, $question, $fullAnswerData, $userExam)
    {
        $function = '';
        switch ($question->type) {
            case 1:
                $function = 'fillTheBlank';
                break;
            default:
        }
        return $this->$function($userAnswer, $question, $fullAnswerData, $userExam);
    }

    public function fillTheBlank($userAnswer, $question, $fullAnswerData, $userExam)
    {
        $userExamQuestion = UserExamQuestion::create([
            'user_exam_id' => $userExam->id,
            'question_id' => $question->id,
        ]);

        return UserExamAnswers::create([
            'user_exam_id' => $userExam->id,
            'user_exam_question_id' => $userExamQuestion->id,
            'answer_id' => $fullAnswerData->id,
            'answer_by_text' => $userAnswer??'',
            'is_true_answer' => $this->handleCheckAnswerFillBlank($userAnswer, $fullAnswerData)
        ]);
    }

    public function handleCheckAnswerFillBlank($userAnswer, $fullAnswerData)
    {
        $correctAnswers = $fullAnswerData->correctAnswers;
        switch ($fullAnswerData->detailFullAnswers->answer_type) {
            case config('constants.answerType.exactly'):
                foreach ($correctAnswers as $answer) {
                    if ($userAnswer === $answer->correctAnswerDetail->correct_answer) {
                        return true;
                    }
                }
                break;
            case config('constants.answerType.contain'):
                foreach ($correctAnswers as $answer) {
                    if (str_contains($answer->correctAnswerDetail->correct_answer, $userAnswer)) {
                        return true;
                    }
                }
                break;
            default:
                break;
        }
        return false;
    }

    public function handleCalculateExam($userExam)
    {
        $userExamAnswers = $userExam->userExamAnswers;
        $totalScore = 0;
        $questionScore = 1;
        foreach ($userExamAnswers as $userExamAnswer) {
            $totalAnswer = count($userExamAnswer->userExamQuestion->question->fullAnswers);
            if ($userExamAnswer->is_true_answer) {
                $totalScore += $questionScore/$totalAnswer;
            }
        }
        return $totalScore;
    }
}
