<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestions extends Model
{
    use HasFactory;

    protected $table = 'exam_questions';

    protected $fillable = ['exam_id', 'question_id'];

    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }

    public function questions()
    {
        return $this->hasMany(Questions::class, 'id', 'question_id');
    }
}
