<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ExamsService;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected ExamsService $clientExamService;

    public function __construct(ExamsService $clientExamService)
    {
        $this->clientExamService = $clientExamService;
    }

    public function getListExams()
    {
        $exams = $this->clientExamService->getAllExams();

        return response()->json([
            'exams' =>  $exams
        ], 200);
    }

    public function getExam($id)
    {
        return response()->json([
            'exam' => $this->clientExamService->getExamToClient($id)
        ], 200);
    }
}
