<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group([

], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'student'], function () {
        Route::get('index', [\App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
    });
    Route::group(['prefix' => 'teacher'], function () {
        Route::group(['prefix' => 'exams'], function () {
            Route::get('/', [ExamController::class, 'index'])->name('teacher.exams.index');
            Route::get('/preview/{id}', [ExamController::class, 'preview'])->name('teacher.exams.preview');
            Route::get('/edit/{id}', [ExamController::class, 'edit'])->name('teacher.exams.edit');
            Route::post('/store', [ExamController::class, 'store'])->name('teacher.exams.store');
            Route::get('/detail/{id}', [ExamController::class, 'show'])->name('teacher.exams.show');
            Route::group(['prefix' => '{exam_id}/question'], function () {
                Route::get('/create', [QuestionsController::class, 'create'])->name('teacher.exams.question.create');
                Route::post('/store', [QuestionsController::class, 'store'])->name('teacher.exams.question.store');
                Route::get('/edit/{id}', [QuestionsController::class, 'edit'])->name('teacher.exams.question.edit');
                Route::delete('/delete/{id}', [QuestionsController::class, 'destroy'])->name('teacher.exams.question.delete');
            });
        });
    });
});
