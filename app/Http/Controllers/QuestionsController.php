<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    //
    public function index()
    {

    }

    public function show($questionId)
    {
        $question = Question::published()->findOrFail($questionId);
        $answers = $question->answers()->paginate(20);
        return view('questions.show', compact('question', 'answers'));
    }
}
