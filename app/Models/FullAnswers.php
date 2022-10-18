<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class FullAnswers extends Model
{
    use HasFactory;

    protected $table = 'full_answers';

    protected $fillable = [
        'question_id',
        'explanation',
    ];

    public function questions(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Questions::class);
    }

    public function correctAnswers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CorrectAnswers::class);
    }

    public function detailFullAnswers()
    {
        return $this->hasMany(DetailFullAnswers::class);
    }
}
