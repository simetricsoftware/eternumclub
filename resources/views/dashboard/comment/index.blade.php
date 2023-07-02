@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        @include('dashboard.partials.header', [
            'title'     => "Comentarios del post $post->title",
            'route'     => 'posts',
            'view'      => 'show',
            'params'    => $post
        ])
        @if(count($comments))
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>
                        <i class="fa-solid fa-thumbs-up"></i>
                    </th>
                    <th>
                        <i class="fa-solid fa-thumbs-down"></i>
                    </th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->full_name }}</td>
                    <td>{{ $comment->likes }}</td>
                    <td>{{ $comment->dislikes }}</td>
                    <td>{{ $comment->created_at->toFormattedDateString() }}</td>
                    <td>{{ $comment->updated_at->toFormattedDateString() }}</td>
                    @can('show.comments')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('comments.show', [$post, $comment]) }}">Ver</a>
                    </td>
                    @endcan
                    @can('delete.comments')
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $comment->id }}">Eliminar</button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $comments->links() }}
        @else
        <div class="text-center">
            <p>Sin comentarios</p>
        </div>
        @endif
    </div>
</div>
@can('delete.comments')
@include('dashboard.partials.confirm-delete', ['route' => 'comments'])
@endcan
@endsection
