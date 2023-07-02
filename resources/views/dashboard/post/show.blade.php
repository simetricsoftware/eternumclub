@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
    @can('edit.posts')
        <a class="btn btn-primary" href="{{ route('posts.edit', $post) }}" data-toggle="tooltip" data-placement="top" title="Editar evento">
            <i class="fas fa-edit"></i>
        </a>
        @endcan
        @can('delete.posts')
        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Eliminar evento">
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $post->id }}" data-current="true">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        @endcan
        @include('dashboard.partials.header', [
            'title' => $post->title,
            'route' => 'posts',
            'view'  => 'index'
        ])


        <div class="text-center">
            @can('edit.posts')
            <a class="btn btn-primary btn-lg" href="{{ route('ticket-type.index', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Generar entradas">
                <i class="fa-solid fa-ticket"></i>
            </a>
            @endcan
            @can('edit.posts')
            <a class="btn btn-success btn-lg" href="{{ route('questions.index', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Crear formulario">
                <i class="fa-sharp fa-solid fa-file-invoice"></i>
            </a>
            @endcan
            @can('edit.posts')
            <a class="btn btn-warning btn-lg" href="{{ route('bank-accounts.index', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Cuentas bancarias">
                <i class="fa-solid fa-money-bill-transfer"></i>
            </a>
            @endcan
            @can('show.comments')
            <a class="btn btn-info btn-lg" href="{{ route('comments.index', $post) }}" data-toggle="tooltip" data-placement="top" title="Ver comentarios">
                <i class="fas fa-comments"></i>
            </a>
            @endcan
        </div>

        @if($post->image_url)
        <img src="{{ url($post->full_path_image) }}" class="img-fluid py-2" alt="imagen no encontrada">
        @endif
        <div class="form-group">
            <strong>Me gusta:</strong> {{ $post->likes }}
            <strong>No me gusta:</strong> {{ $post->dislikes }}
        </div>
        <div class="form-group">
            <label for="title">Titulo</label>
            <input class="form-control" readonly type="text" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="slug">Url amigable</label>
            <input class="form-control" readonly type="text" id="slug" name="slug" value="{{ $post->slug }}">
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <div class="card">
                <div class="card-body ql-container ql-snow">
                    <div class="ql-editor">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <input class="form-control" readonly type="text" id="category_id" name="category_id" value="{{ $post->category->title }}">
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <input class="form-control" readonly type="text" id="status" name="status" value="{{ $post->status === 'unposted' ? 'No posteado' : 'Posteado' }}">
        </div>
        <div class="form-group">
            <label for="tags">Etiquetas</label>
            @foreach($post->tags as $tag)
            <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
        </div>

       
    </div>
</div>
@can('delete.posts')
@include('dashboard.partials.confirm-delete', ['route' => 'posts'])
@endcan
@endsection
