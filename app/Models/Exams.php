<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'count_down',
        'minimum_score'
    ];

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestions::class, 'exam_id');
    }
}
