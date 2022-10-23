<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectAnswers extends Model
{
    use HasFactory;

    protected $table = 'correct_answers';

    protected $fillable = [
        'full_answer_id',
        'explanation',
    ];

    public function fullAnswers()
    {
        return $this->belongsTo(FullAnswers::class);
    }

    public function correctAnswerDetail()
    {
        return $this->hasOne(CorrectAnswerDetail::class,'correct_answer_id', 'id');
    }
}
