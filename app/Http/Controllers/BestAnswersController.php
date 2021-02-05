<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class BestAnswersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @description 创建最佳答案
     * @param Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @author CuratorC
     * @date 2021/2/5
     */
    public function store(Answer $answer): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $answer->question);

        $answer->question->markAsBestAnswer($answer);

        return back();
    }
}
