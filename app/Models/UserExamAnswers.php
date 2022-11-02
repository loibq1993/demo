<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExamAnswers extends Model
{
    use HasFactory;

    protected $table = 'user_exam_answers';

    protected $fillable = [
        'user_exam_id',
        'user_exam_question_id',
        'answer_id',
        'answer_by_text',
        'is_true_answer'
    ];

    public function userExams()
    {
        return $this->belongsTo(UserExams::class, 'id', 'user_exam_id');
    }

    public function userExamQuestion()
    {
        return $this->belongsTo(UserExamQuestion::class, 'user_exam_question_id', 'id');
    }
}
