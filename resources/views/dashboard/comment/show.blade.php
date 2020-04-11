@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title'     => $post->title,
            'route'     => 'comments',
            'view'      => 'index',
            'params'    => $post
        ])
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" readonly id="content" name="content">{{ $comment->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="likes">N° Me gusta</label>
            <input class="form-control" readonly type="text" id="likes" name="likes" value="{{ $comment->likes }}">
        </div>
        <div class="form-group">
            <label for="dislikes">N° No me gusta</label>
            <input class="form-control" readonly type="text" id="dislikes" name="dislikes" value="{{ $comment->dislikes }}">
        </div>
    </div>
</div>
@can('delete.comments')
@include('dashboard.partials.confirm-delete', ['route' => 'comments'])
@endcan
@endsection
