@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => 'Crear evento',
            'route' => 'posts',
            'view'  => 'index'
        ])
        <form id="post-form" action="{{ route('posts.store') }}" method="POST">
            @csrf
            @include('dashboard.post.partials.form')
        </form>
    </div>
</div>
@endsection
