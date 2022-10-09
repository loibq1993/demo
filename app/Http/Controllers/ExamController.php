<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Models\Questions;
use App\Models\ExamUserAnswers;
use App\Models\UserExams;
use App\Services\ExamService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class ExamController extends Controller
{
    private $examsService;

    public function __construct(ExamService $examService)
    {
        $this->examsService = $examService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->examsService->getAllExams();

        return view('teachers.exams.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|unique:exams'
            ]);

            $exam = Exams::create([
                'title' => $request['title'],
                'description' => $request['description']
            ]);

            return redirect()->route('teacher.exams.question.create', $exam->id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * dsa
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Exams::find($id);

        return view('teachers.exams.show', compact('data'));
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

    public function preview($id)
    {
        $exam = Exams::where('id', $id)->with(['questions'])->first();

        if (!$exam) {
            abort(404);
        }
        return view('teachers.exams.preview.index', compact('exam'));
    }

    public function getExam($id)
    {
        $exam = Exams::where('id', $id)->with(['questions'])->first();
        $start_time = Carbon::now();

        if (!$exam) {
            abort(404);
        }
        return view('students.exams.index', compact('exam', 'start_time'));
    }

    public function postExam(Request $request, $id)
    {
        if (!Auth::user()) {
            Validator::make($request->all(), [
                'email' => 'required|email:rfc,dns',
            ])->validate();
        }
        try {
            DB::beginTransaction();
            $userExam = $this->examsService->createUserExam($id, $request);
            foreach ($request->all() as $question => $answer) {
                if (str_contains($question, 'question')) {
                    $findQuestion = Questions::find(trim($question, 'question_'));
                    $this->examsService->createUserAnswers($findQuestion, $answer, $userExam);
                }
            }
            $userExam->score = $this->examsService->calculateScore($userExam);
            $userExam->save();
            DB::commit();
            return view('students.exams.success', compact('userExam'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
        }
    }
}
