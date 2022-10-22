<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Services\QuestionsService;
use Illuminate\Http\Request;
use App\Services\FullAnswerService;
use App\Services\QuestionTypesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Termwind\Question;

class QuestionsController extends Controller
{
    protected QuestionTypesService $questionsTypesService;
    protected QuestionsService $questionsService;
    protected FullAnswerService $fullAnswerService;

    public function __construct(
        QuestionsService     $questionsService,
        QuestionTypesService $questionsTypesService,
        FullAnswerService    $fullAnswerService
    )
    {
        $this->questionsService = $questionsService;
        $this->questionsTypesService = $questionsTypesService;
        $this->fullAnswerService = $fullAnswerService;
    }

    public function index()
    {
        $questions = $this->questionsService->getAll();

        return response()->json([
            'questions' => $questions
        ], 200);
    }

    public function store(Request $request)
    {
        $questionType = $request['questionType'][0];

        $function = '';
        switch ($questionType) {
            case 1:
                $function = 'storeFillTheBlank';
                break;
            default:
        }
        return $this->$function($request);
    }

    public function storeFillTheBlank(Request $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();

        try {
            $count = 0;
            $answerData = [];
            while (!is_null($request['answer[selectField][' . $count . ']'])) {
                $answerData[$count]['answer_type'] = $request['answer[selectField][' . $count . ']'];
                $answerData[$count]['full_text_answer'] = $request['answer[value][' . $count . ']'];
                $answerData[$count]['limit_text'] = $request['answer[limitText][' . $count . ']'];
                $answerData[$count]['explanation'] = $request['answer[explanation][' . $count . ']'];
                ++$count;
            }
            $questionData = [
                'title' => '1',
                'type' => $request['questionType'][0],
                'question' => '1',
                'required' => $request['required']
            ];

            $validatorQuestion = Validator::make($questionData, [
                "question" => "required|string",
                "type" => "required",
            ]);
            $validatorAnswer = Validator::make($answerData, [
                "*.answer_type.*" => "required",
                "*.full_text_answer.*" => "required",
                "*.limit_text.*" => "integer|nullable",
            ]);

            if ($validatorQuestion->fails()) {
                return response()->json([
                    'message' => 'Bad request',
                    'errors' => $validatorQuestion->errors()->toArray()
                ], 400);
            }
            if ($validatorAnswer->fails()) {
                return response()->json([
                    'message' => 'Bad request',
                    'errors' => $validatorAnswer->errors()->toArray()
                ], 400);
            }


            $question = $this->questionsService->store($questionData);

            foreach ($answerData as $data) {
                $this->fullAnswerService->storeFillTheBlank($question->id, $data);
            }
            DB::commit();

            return response()->json([], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function getType()
    {
        $type = $this->questionsTypesService->getAll()->toArray();

        return response()->json([
            'type' => $type
        ], 200);
    }

    public function show($id)
    {
        $question = $this->questionsService->getOne($id);

        return response()->json([
            'question' => $question->toArray(),
            'answers' => $question->fullAnswer->toArray()
        ], 200);
    }
}
