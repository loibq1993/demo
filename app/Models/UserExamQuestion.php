<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExamQuestion extends Model
{
    use HasFactory;

    protected $table = 'user_exam_question';

    protected $fillable = [
        'user_exam_id',
        'question_id',
        'question_score'
    ];

    public function userExams()
    {
        return $this->belongsTo(UserExams::class, 'user_exam_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id', 'id');
    }
}
