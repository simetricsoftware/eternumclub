<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum');
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
        $this->uploadImage($request, $post);

        return redirect()->route('posts.show', $post)->with('status', 'Evento creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::votesCount()->find($post->id);
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * S
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
        $this->uploadImage($request, $post);
        return redirect()->route('posts.show', $post)->with('status', 'Evento actualizado con exito');
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
        return redirect()->route('posts.index')->with('status', 'Evento eliminado con exito');
    }

    /**
     * Store a new image on storage.
     *
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request, Post $post)
    {
        $file = $request->file('image');

        if (!$file) {
            return;
        }

        $tempUrl = Storage::putFile("posts/$post->id", $file);
        $optimizedUrl = preg_replace('/\.(jpe?g|png)$/i', '.webp', $tempUrl);

        Artisan::call('optimize:image', [
            '--use-webp' => true,
            '--input' => $tempUrl,
            '--output' => $optimizedUrl,
            '--disk' => 'public',
        ]);

        if ($post->image_url) {
            if (Storage::exists($post->image_url)) {
                Storage::delete($post->image_url);
            }
        }
        $post->image_url = $optimizedUrl;
        $post->save();

        return redirect()->route('posts.show', $post)->with('status', 'Imagen guardada correctamente');
    }
}
