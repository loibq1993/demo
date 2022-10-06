<?php

namespace App\Services;

use App\Models\Exams;

class ExamService
{
    public function getAllExams()
    {
        return Exams::all();
    }
}
