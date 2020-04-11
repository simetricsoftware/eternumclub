@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => 'Crear etiqueta',
            'route' => 'tags',
            'view'  => 'index'
        ])
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            @include('dashboard.tag.partials.form')
        </form>
    </div>
</div>
@endsection
