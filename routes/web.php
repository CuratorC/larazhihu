<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\BestAnswersController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/questions', [QuestionsController::class, 'index']);
// 获取问题详情
Route::get('/questions/{question}', [QuestionsController::class, 'show']);
// 给问题回答答案
Route::post('/questions/{question}/answers', [AnswersController::class, 'store']);
// 设置最佳答案
Route::post('answers/{answer}/best', [BestAnswersController::class, 'store'])->name('best-answers.store');
// 删除回答
Route::delete('/answers/{answer}', [AnswersController::class, 'destroy'])->name('answers.destroy');
