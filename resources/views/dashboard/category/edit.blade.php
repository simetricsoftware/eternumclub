@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', ['title' => "Editar $category->title"])
        <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dashboard.category.partials.form')
        </form>
    </div>
</div>
@endsection
