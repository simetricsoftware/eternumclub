<?php

namespace App\Http\Controllers\api;

use App\Comment;
use App\Post;
use App\Vote;
use App\Traits\ApiResponse;
use App\Traits\Voteable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Http\Resources\Comment as CommentResource;
use App\Mail\CommentPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    use ApiResponse, Voteable;

    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $post)
    {
        $user = $request->user('api');
        $p = Post::where('slug', $post)->first();
        return CommentResource::collection(
            Comment::orderBy('updated_at', 'DESC')
                ->where('post_id', $p->id)
                ->with(['user.roles:id,name','user.permissions:id,name', 'user.roles.permissions:id,name'])
                ->votesUser($user)
                ->votesCount()
                ->get()
        )
            ->additional($this->succesResponse());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request, $post)
    {
        $this->authorize('create', Comment::class);

        $p = Post::where('slug', $post)->first();
        $data = $request->validated();
        $comment = Comment::create([
            'content' => $data['content'],
            'post_id' => $p->id,
            'user_id' => $request->user()->id
        ]);

        Mail::to($p->user->email)->send(new CommentPublished($comment));

        return $this->succesResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(StoreComment $request, $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());
        return $this->succesResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        return $this->succesResponse();
    }

    public function vote(Request $request, $post, Comment $comment)
    {
        return $this->saveVote($comment, $request->type);
        return $this->succesResponse();
    }
}
