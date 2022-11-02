<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'descriptions',
        'question',
        'type',
        'required'
    ];

    public function fullAnswers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FullAnswers::class,'question_id');
    }

    public function UserExamQuestion()
    {
        return $this->hasMany(UserExamQuestion::class(), 'question_id');
    }
}
