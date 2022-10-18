<?php

namespace App\Services;

use App\Models\QuestionTypes;

class QuestionTypesService
{
    public function getAll()
    {
        return  QuestionTypes::all();
    }
}
