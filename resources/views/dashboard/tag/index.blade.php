@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        <h2>Etiquetas</h2>
        @include('dashboard.partials.state')
        @can('create.tags')
        <a class="btn btn-primary my-2" href="{{ route('tags.create') }}">Crear</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    @can('show.tags')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('tags.show', $tag) }}">Ver</a>
                    </td>
                    @endcan
                    @can('edit.tags')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('tags.edit', $tag) }}">Editar</a>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tags->links() }}
    </div>
</div>
@endsection
