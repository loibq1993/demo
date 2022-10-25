<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamsService;

class ExamsController extends Controller
{
    protected ExamsService $examsService;

    public function __construct(ExamsService $examsService)
    {
        $this->examsService = $examsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = $this->examsService->getAll();
        return response()->json([
            'exams' => $exams
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $examData = [
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'minimum_score' => $request['minimum_score']
            ];
            $this->examsService->store($examData);
            return response()->json([], 200);
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = $this->examsService->getOne($id);
        if (is_null($exam)){
            return response()->json([], 400);
        }
        return response()->json([
            'title' => $exam->title,
            'description' => $exam->description,
            'start_date' => $exam->start_date,
            'end_date' => $exam->end_date,
            'start_time' => $exam->start_time,
            'end_time' => $exam->end_time,
            'minimum_score' => $exam->minimum_score
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = $this->examsService->getOne($id);
        if (is_null($exam)){
            return response()->json([], 400);
        }
        try {
            $examData = [
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'minimum_score' => $request['minimum_score']
            ];
            $this->examsService->update($examData,$exam);
            return response()->json([], 200);
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = $this->examsService->getOne($id);
        if (is_null($exam)){
            return response()->json([], 400);
        }
        try {
            $this->examsService->destroy($exam);
            return response()->json([],200);
        }catch (\Exception $exception){
            throw $exception;
        }
    }
}
