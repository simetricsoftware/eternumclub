@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', ['title' => "Editar $post->title"])
        <form id="post-form" action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dashboard.post.partials.form')
        </form>
    </div>
</div>
@endsection
