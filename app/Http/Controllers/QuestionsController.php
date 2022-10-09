<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Questions;
use App\Models\QuestionType;
use App\Rules\ValidateCorrectAnswer;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionsController extends Controller
{
    protected AnswerService $answerService;
    protected QuestionService $questionService;

    public function __construct(AnswerService $answerService, QuestionService $questionService)
    {
        $this->questionService = $questionService;
        $this->answerService = $answerService;
    }

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
        $type = QuestionType::all();

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
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'question' => 'required',
                'answer.correct_answer' => new ValidateCorrectAnswer($request['type'])
            ]);
            $question = $this->questionService->handleSaveQuestion($request, $examId);
            $this->answerService->handleSaveAnswer($request, $question);

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
