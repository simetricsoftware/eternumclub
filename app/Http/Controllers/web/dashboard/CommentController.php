<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Comment::class, 'comment');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)
            ->with('user')
            ->votesCount()
            ->orderBy('updated_at', 'DESC')
            ->paginate();
        return view('dashboard.comment.index', ['comments' => $comments, 'post' => $post, 'params' => $post]);
    }

    public function show(Post $post, $comment)
    {
        $comment = Comment::votesCount()->find($comment);
        return view('dashboard.comment.show', compact('comment', 'post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index', $post)->with('status', 'Comentario eliminado correctamente');
    }
}
