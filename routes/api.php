<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['cors']
], function() {
    Route::post('/upload', [\App\Http\Controllers\ImageController::class, 'store']);

    Route::get('/question/types', [\App\Http\Controllers\Admin\QuestionsController::class, 'getType']);
    //api for client without login
    Route::group([
        'prefix' => 'test'
    ], function (){
        Route::get('/exams', [\App\Http\Controllers\Client\ExamController::class, 'getListExams']);
        Route::get('/exams/{id}', [\App\Http\Controllers\Client\ExamController::class, 'getExam']);

        //save user exam
        Route::post('/exams/{id}', [\App\Http\Controllers\Client\ExamController::class, 'saveUserExam']);
    });

    //should change to admin here
    Route::group([
        'prefix' =>'exams'
    ],function (){
        Route::get('/', [\App\Http\Controllers\Admin\ExamsController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Admin\ExamsController::class, 'store']);
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'destroy']);
        Route::get('/preview/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'show']);

        //questions of Exam
        Route::group([
            'prefix' => '{examId}/questions'
        ], function() {
            Route::get('/', [\App\Http\Controllers\Admin\QuestionsController::class, 'index']);
            Route::post('/store', [\App\Http\Controllers\Admin\QuestionsController::class, 'store']);
            Route::get('/preview/{id}', [\App\Http\Controllers\Admin\QuestionsController::class, 'show']);
        });
    });

});
Route::get('exams', [\App\Http\Controllers\Admin\ExamsController::class, 'index']);
Route::post('exam/store', [\App\Http\Controllers\Admin\ExamsController::class, 'store']);
Route::post('exam/update/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'update']);
Route::delete('exam/delete/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'destroy']);
Route::get('exam/preview/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'show']);
