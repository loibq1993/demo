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
    Route::get('question/types', [\App\Http\Controllers\Admin\QuestionsController::class, 'getType']);
    Route::get('questions', [\App\Http\Controllers\Admin\QuestionsController::class, 'index']);
    Route::post('question/store', [\App\Http\Controllers\Admin\QuestionsController::class, 'store']);
    Route::get('question/preview/{id}', [\App\Http\Controllers\Admin\QuestionsController::class, 'show']);

    Route::group([
        'prefix' =>'exams'
    ],function (){
        Route::get('/', [\App\Http\Controllers\Admin\ExamsController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Admin\ExamsController::class, 'store']);
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'destroy']);
        Route::get('/preview/{id}', [\App\Http\Controllers\Admin\ExamsController::class, 'show']);
    });
});
