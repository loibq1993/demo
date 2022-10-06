<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Questions;
use App\Rules\ValidateCorrectAnswer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($examId)
    {
        $type = config('constants.type');

        return view('teachers.exams.questions.create', compact('type', 'examId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $examId)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'question' => 'required',
                'answer.correct_answer' => new ValidateCorrectAnswer($request['type'])
            ]);
            $question = Questions::create([
                'title' => $request['title'] ?? 'Null',
                'type' => $request['type'],
                'description' => $request['description'],
                'exam_id' => $examId,
                'question' => $request['question']
            ]);
            foreach ($request['answer']['value'] as $key => $item) {
                Answers::create([
                    'question_id' => $question->id,
                    'answer' => $item,
                    'correct_answer' => (int)$request['answer']['correct_answer'][$key],
                    'explanation' => $request['answer']['explanation'][$key]
                ]);
            }
            DB::commit();
            return redirect()->route('teacher.exams.show', $examId);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
