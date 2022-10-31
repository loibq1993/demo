<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamsService;
use Illuminate\Support\Facades\Validator;

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
                'start_date' => is_null($request['start_date']) ? null : date("Y-m-d H:i:s", strtotime($request['start_date'])),
                'end_date' => is_null($request['end_date']) ? null : date("Y-m-d H:i:s", strtotime($request['end_date'])),
                'count_down' => is_null($request['count_down']) ? null : date("H:i:s", strtotime($request['count_down'])),
                'minimum_score' => $request['minimum_score']
            ];
            $ruler = [
                'title' => 'required|string',
                'start_date' => 'required|date_format:Y-m-d H:i:s',
                'end_date' => 'required|date_format:Y-m-d H:i:s|after:start_date',
                'count_down' => 'required|date_format:H:i:s',
                'minimum_score' => 'required|numeric',
            ];
            $validator = Validator::make($examData,$ruler);
            if ($validator->fails()){
                return response()->json([
                    'errors' => $validator->errors()->toArray(),
                ],422);
            }
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
            return response()->json([], 404);
        }
        return response()->json([
            'title' => $exam->title,
            'description' => $exam->description,
            'start_date' => $exam->start_date,
            'end_date' => $exam->end_date,
            'count_down' => $exam->count_down,
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
            return response()->json([], 404);
        }
        try {
            $examData = [
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => date("Y-m-d H:i:s", strtotime($request['start_date'])),
                'end_date' => date("Y-m-d H:i:s", strtotime($request['end_date'])),
                'count_down' => date("H:i:s",strtotime($request['count_down'])),
                'minimum_score' => $request['minimum_score']
            ];
            $ruler = [
                'title' => 'required|string',
                'start_date' => 'required|date_format:Y-m-d H:i:s',
                'end_date' => 'required|date_format:Y-m-d H:i:s|after:start_date',
                'count_down' => 'required|date_format:H:i:s',
                'minimum_score' => 'required|numeric',
            ];
            $validator = Validator::make($examData,$ruler);
            if ($validator->fails()){
                return response()->json([
                    'errors' => $validator->errors()->toArray(),
                ],422);
            }
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
            return response()->json([], 404);
        }
        try {
            $this->examsService->destroy($exam);
            return response()->json([],200);
        }catch (\Exception $exception){
            throw $exception;
        }
    }
}
