@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        <h2>Posts</h2>
        @include('dashboard.partials.state')
        @can('create.posts')
        <a class="btn btn-primary my-2" href="{{ route('posts.create') }}">Crear</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Estado</th>
                    <th>N° de me gusta</th>
                    <th>N° de no me gusta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->status }}</td>
                    <td>{{ $post->likes }}</td>
                    <td>{{ $post->dislikes }}</td>
                    @can('show.posts')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post->id]) }}">Ver</a>
                    </td>
                    @endcan
                    @can('edit.posts')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Editar</a>
                    </td>
                    @endcan
                    @can('delete.posts')
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $post->id }}">Eliminar</button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
</div>
@can('delete.posts')
@include('dashboard.partials.confirm-delete', ['route' => 'posts'])
@endcan
@endsection
