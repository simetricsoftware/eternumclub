@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => $post->title,
            'route' => 'posts',
            'view'  => 'index'
        ])
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
        @can('edit.posts')
        <form action="{{ route('posts.image', ['post' => $post->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label for="image">Imagen</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label" data-browse="Examinar" for="image">Selecciona un archio</label>
                    </div>
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit" value="Subir">
                    </div>
                </div>
            </div>
        </form>
        @endcan
        @can('edit.posts')
        <a class="btn btn-secondary" href="{{ route('ticket-type.index', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Generar entradas">
            <i class="fa-solid fa-ticket"></i>
        </a>
        @endcan
        @can('edit.posts')
        <a class="btn btn-secondary" href="{{ route('questions.index', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Crear formulario">
            <i class="fa-sharp fa-solid fa-file-invoice"></i>
        </a>
        @endcan
        @can('edit.posts')
        <a class="btn btn-secondary" href="{{ route('bank-accounts.index', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Cuentas bancarias">
            <i class="fa-solid fa-money-bill-transfer"></i>
        </a>
        @endcan
        @can('show.comments')
        <a class="btn btn-secondary" href="{{ route('comments.index', $post) }}" data-toggle="tooltip" data-placement="top" title="Ver comentarios">
            <i class="fas fa-comments"></i>
        </a>
        @endcan
        @can('edit.posts')
        <a class="btn btn-primary" href="{{ route('posts.edit', $post) }}" data-toggle="tooltip" data-placement="top" title="Editar evento">
            <i class="fas fa-edit"></i>
        </a>
        @endcan
        @can('delete.posts')
        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Eliminar evento">
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $post->id }}">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        @endcan
    </div>
</div>
@can('delete.posts')
@include('dashboard.partials.confirm-delete', ['route' => 'posts'])
@endcan
@endsection
