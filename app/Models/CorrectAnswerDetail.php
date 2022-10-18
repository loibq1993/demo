<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectAnswerDetail extends Model
{
    use HasFactory;

    protected $table = 'correct_answer_detail';

    protected $fillable = [
        'correct_answer_id',
        'correct_answer',
        'limit_text',
        'answer_type'
    ];

    public function correctAnswer()
    {
        return $this->belongsTo(CorrectAnswers::class);
    }
}
