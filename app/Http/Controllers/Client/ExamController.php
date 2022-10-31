<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ExamsService;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected ExamsService $examService;

    public function __construct(ExamsService $examService)
    {
        $this->examService = $examService;
    }

    public function getExam($id)
    {
        return response()->json([
            'exam' => $this->examService->getExamToClient($id)
        ], 200);
    }
}
