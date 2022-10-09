<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUserAnswers extends Model
{
    use HasFactory;

    protected $table = 'exam_user_answers';

    protected $fillable = ['question_id', 'answer_id', 'answer_by_text', 'user_exam_id', 'is_true_answer', 'order_answer'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answers::class, 'answer_id');
    }
}
