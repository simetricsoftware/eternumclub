<?php

namespace App\Http\Controllers\api;

//use App\Http\Controllers\api\ApiResponseController as Controller;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\Post as PostResource;
use App\Post;
use App\Traits\ApiResponse;
use App\Traits\Voteable;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponse, Voteable;

    public function __construct()
    {
        $this->middleware('auth:api')->only('vote');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new PostCollection(
            Post::orderBy('updated_at', 'DESC')
            ->with(['category', 'tags'])
            ->sortByCategory($request->category)
            ->search($request->search)
            ->where('status', 'posted')
            ->votesCount()
            ->paginate(10)
        );
    }

    public function recents(Request $request) {
        return new PostCollection(
            Post::orderBy('updated_at', 'DESC')
            ->with(['category', 'tags'])
            ->where('status', 'posted')
            ->where('slug', '<>', $request->curren_post)
            ->votesCount()
            ->take(6)
            ->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, String $slug)
    {
        $user = $request->user('api');
        return new PostResource(
            Post::with(['category', 'tags'])
            ->votesUser($user)
            ->votesCount()
            ->where('slug', $slug)
            ->where('status', 'posted')
            ->firstOrFail()
        );
    }

    public function vote(Request $request, $post)
    {
        $post = Post::where('slug', $post)->get()->first();
        $this->saveVote($post, $request->type);
        return $this->succesResponse();
    }
}
