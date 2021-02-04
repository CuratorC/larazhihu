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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/questions', [\App\Http\Controllers\QuestionsController::class, 'index']);
Route::get('/questions/{question}', [\App\Http\Controllers\QuestionsController::class, 'show']);

Route::post('/questions/{question}/answers', [\App\Http\Controllers\AnswersController::class, 'store']);
