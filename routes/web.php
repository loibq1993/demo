<?php

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
//   Route::post('')
    });
    Route::group(['prefix' => 'teacher'], function () {
//        Route::get('index', 'TeacherController@index')->name('teacher.index');
//   Route::post('')
    });
});
