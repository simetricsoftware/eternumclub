<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Post;
use App\Image;
use App\Category;
use App\Tag;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')
                ->votesCount()
                ->userRole()
                ->paginate(8);
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id', 'title'])->pluck('title', 'id');
        $tags = Tag::get(['id', 'name'])->pluck('name', 'id');
        return view('dashboard.post.create', ['post' => new Post(), 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $post = Post::create($request->validated());
        $post->user()->associate(auth()->user()->id)->save();
        $post->setTags($request->validated());

        return redirect()->route('posts.show', $post)->with('status', 'Post creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::votesCount()->find($post);
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get(['id', 'title'])->pluck('title', 'id');
        $tags = Tag::get(['id', 'name'])->pluck('name', 'id');
        return view('dashboard.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
        $post->update($request->validated());
        $post->setTags($request->validated());
        return redirect()->route('posts.show', $post)->with('status', 'Post actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post eliminado con exito');
    }

    /**
     * Store a new image on storage.
     *
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request, Post $post)
    {
        $file = $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png|max:10240' //10 Mb
        ]);

        $url = Storage::putFile("posts/$post->id", $file['image']);

        if ($post->image_url) {
            if (Storage::exists($post->image_url)) {
                Storage::delete($post->image_url);
            }
        }
        $post->image_url = $url;
        $post->save();
        
        return redirect()->route('posts.show', $post)->with('status', 'Imagen guardada correctamente');
    }
}
