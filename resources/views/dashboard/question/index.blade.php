@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        @include('dashboard.partials.header', [
            'title' => 'Crea tu formulario',
            'route' => 'posts',
            'view'  => 'show',
            'params' => [$post->id],
        ])
        <div id="app">
            <form action="{{ route('questions.store', [ 'post' => $post ]) }}" method="POST">
                @csrf
                <questions-component :questions="{{ json_encode($questions) }}"></questions-component>
            </form>
        </div>
    </div>
</div>
@endsection
