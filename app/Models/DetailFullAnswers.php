<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFullAnswers extends Model
{
    use HasFactory;

    protected $table = 'detail_full_answers';

    protected $fillable = [
        'full_answer_id',
        'answer_type',
        'limit_text',
        'full_text_answer',
    ];

    public function fullAnswer()
    {
        return $this->belongsTo(FullAnswers::class);
    }
}
