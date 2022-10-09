<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExams extends Model
{
    use HasFactory;

    protected $table = 'user_exams';

    protected $fillable = [
        'user_id',
        'email',
        'exam_id',
        'test_date',
        'duration',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }
}
