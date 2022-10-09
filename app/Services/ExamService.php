<?php

namespace App\Services;

use App\Models\Answers;
use App\Models\Exams;
use App\Models\Questions;
use App\Models\ExamUserAnswers;
use App\Models\UserExams;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExamService
{
    public function getAllExams()
    {
        return Exams::all();
    }

    public function createUserExam($examId, $request)
    {
        $current = Carbon::now();

        return UserExams::create([
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'email' => $request['email'] ?? null,
            'exam_id' => $examId,
            'test_date' => Carbon::now()->format('Y/m/d H:i:s'),
            'duration' => Carbon::parse($request['start_time'])->diffInRealSeconds($current)
        ]);
    }

    public function createUserAnswers($question, $answers, $userExam)
    {
        $savedAnswer = [];
        if(!is_array($answers)) {
            $savedAnswer = $this->handleStoreAnswer($question, $answers, $userExam);
        } else {
            foreach($answers as $key => $answer)
            {
                $savedAnswer[$key] = $this->handleStoreAnswer($question, $answer, $userExam, $key+1);
            }
        }
        return $savedAnswer;
    }

    public function handleStoreAnswer($question, $answer, $userExam, $getKey = null)
    {
        $createAnswer  =  ExamUserAnswers::create([
            'question_id' => $question->id,
            'user_exam_id' => $userExam->id
        ]);
        $data = call_user_func(array($this, $question->question_type->blade_view), ['answer' => $answer, 'getKey' => $getKey, 'question_id' => $question->id]);
        $createAnswer->answer_id = $data['answer_id'];
        $createAnswer->answer_by_text = $data['answer_by_text'];
        $createAnswer->order_answer = $data['order_answer'] ?? null;
        $createAnswer->is_true_answer = $data['is_true_answer'];
        $createAnswer->save();
        return $createAnswer;
    }

    public function calculateScore($userExam)
    {
        return Questions::join('exam_user_answers', 'questions.id', '=', 'exam_user_answers.question_id')
            ->where('exam_id', $userExam->exam_id)
            ->where('user_exam_id', $userExam->id)
            ->where('is_true_answer', true)
            ->count();
    }

    public function true_false($userAnswer)
    {
        return [
            'answer_id' => null,
            'answer_by_text' => $userAnswer['answer'],
            'is_true_answer' => (int)$userAnswer['answer'] == $this->checkMatchTrueFalseAnswer($userAnswer)->correct_answer
        ];
    }

    public function fill_the_blank($userAnswer)
    {
        return [
            'answer_id' => null,
            'answer_by_text' => $userAnswer['answer'] ?? '',
            'order_answer' => $userAnswer['getKey'],
            'is_true_answer' => strtolower($userAnswer['answer']) == strtolower($this->checkMatchAnswer($userAnswer)->answer)
        ];
    }

    public function multiple_choice($userAnswer)
    {
        return [
            'answer_id' => (int)$userAnswer['answer'],
            'answer_by_text' => null,
            'is_true_answer' => $this->checkMatchAnswer($userAnswer)->id == (int)$userAnswer['answer'] && $this->checkMatchAnswer($userAnswer)->correct_answer == 1
        ];
    }

    public function one_choice($userAnswer)
    {
        return [
            'answer_id' => (int)$userAnswer['answer'],
            'answer_by_text' => null,
            'is_true_answer' => $this->checkMatchAnswer($userAnswer)->id == (int)$userAnswer['answer']
        ];
    }

    public function checkMatchAnswer($userAnswer)
    {
        return Answers::where('question_id', $userAnswer['question_id'])
            ->where('correct_answer', true)
            ->first();
    }

    public function checkMatchTrueFalseAnswer($userAnswer)
    {
        return Answers::where('question_id', $userAnswer['question_id'])
            ->first();
    }

}
