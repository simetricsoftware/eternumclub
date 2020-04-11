@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => $category->title,
            'route' => 'categories',
            'view'  => 'index'
        ])
        <div class="form-group">
            <label for="title">Titulo</label>
            <input class="form-control" readonly type="text" id="title" name="title" value="{{ $category->title }}">
        </div>
        <div class="form-group">
            <label for="slug">Url amigable</label>
            <input class="form-control" readonly type="text" id="slug" name="slug" value="{{ $category->slug }}">
        </div>
        @can('edit.categories')
        <a class="btn btn-primary" href="{{ route('categories.edit', ['category' => $category->id]) }}">Editar</a>
        @endcan
    </div>
</div>
@endsection
