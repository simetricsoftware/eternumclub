<?php

namespace App\Http\Controllers\web\dashboard;

use App\Actions\Question\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Query\Question\Index;
use App\Http\Requests\Question\StoreRequest;
use App\Post;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Index $question)
    {
        $questions = $question->query($post)->get();

        return view('dashboard.question.index', compact('post', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Post $post, StoreAction $storeAction)
    {
        $storeAction->execute($request, $post);

        return redirect()->route('questions.index', ['post' => $post])->with('status', 'Cuestionario actualizado con exito');
    }
}
