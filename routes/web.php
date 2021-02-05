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

// 获取问题列表
Route::get('/questions', [\App\Http\Controllers\QuestionsController::class, 'index']);
// 获取问题详情
Route::get('/questions/{question}', [\App\Http\Controllers\QuestionsController::class, 'show']);
// 给问题回答答案
Route::post('/questions/{question}/answers', [\App\Http\Controllers\AnswersController::class, 'store']);
// 设置最佳答案
Route::post('answers/{answer}/best', [\App\Http\Controllers\BestAnswersController::class, 'store'])->name('best-answers.store');
