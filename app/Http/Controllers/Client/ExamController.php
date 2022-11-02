<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ExamsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

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

    public function saveUserExam($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $validate = $request->all();
            $validate['exam_id'] = $id;
            $validator = Validator::make($validate, [],[]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Bad request',
                    'errors' => $validator->errors()->toArray()
                ], 400);
            }
            $this->clientExamService->saveUserExam($validate);
//            DB::commit();
            return response()->json([
                'data' => $validate
            ], 201);
        }   catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }


    }
}
