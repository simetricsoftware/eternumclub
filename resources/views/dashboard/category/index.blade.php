@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        <h2>Categorias</h2>
        @include('dashboard.partials.state')
        @can('create.categories')
        <a class="btn btn-primary my-2" href="{{ route('categories.create') }}">Crear</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->created_at->toFormattedDateString() }}</td>
                    <td>{{ $category->updated_at->toFormattedDateString() }}</td>
                    @can('show.categories')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('categories.show', ['category' => $category->id]) }}">Ver</a>
                    </td>
                    @endcan
                    @can('edit.categories')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('categories.edit', ['category' => $category->id]) }}">Editar</a>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
@endsection
