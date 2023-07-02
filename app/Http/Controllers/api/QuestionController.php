<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Query\Question\Index;
use App\Http\Resources\Question\IndexResource;
use App\Post;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Index $question)
    {
        $questions = $question->query($post)->get();

        return IndexResource::collection($questions);
    }
}
