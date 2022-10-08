<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'title', 'description', 'type', 'exam_id', 'category', 'question'
    ];

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answers::class,'question_id');
    }

    public function exams(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Exams::class, 'exam_id');
    }

    public function question_type()
    {
        return $this->hasOne(QuestionType::class, 'id', 'type');
    }
}
