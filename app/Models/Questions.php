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
        'type'
    ];

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CorrectAnswers::class,'question_id');
    }
}
