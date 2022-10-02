<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
}
