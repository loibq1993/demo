<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExams extends Model
{
    use HasFactory;

    protected $table = 'user_exams';

    protected $fillable = [
        'exam_id',
        'email',
        'exam_id',
        'test_date',
        'duration',
        'score'
    ];

    public function userExamAnswers()
    {
        return $this->hasMany(UserExamAnswers::class, 'user_exam_id', 'id');
    }

    public function userExamQuestion()
    {
        return $this->hasMany(UserExamQuestion::class, 'user_exam_id', 'id');
    }
}
