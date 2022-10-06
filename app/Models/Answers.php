<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'question_id', 'answer', 'explanation', 'correct_answer'
    ];

    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Questions::class);
    }
}
