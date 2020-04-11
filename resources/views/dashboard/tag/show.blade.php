@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => $tag->title,
            'route' => 'tags',
            'view'  => 'index'
        ])
        <div class="form-group">
            <label for="name">Titulo</label>
            <input class="form-control" readonly type="text" id="name" name="name" value="{{ $tag->name }}">
        </div>
        @can('edit.tags')
        <a class="btn btn-primary" href="{{ route('tags.edit', $tag) }}">Editar</a>
        @endcan
    </div>
</div>
@endsection
