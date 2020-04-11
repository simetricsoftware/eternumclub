@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => 'Crear categoria',
            'route' => 'categories',
            'view'  => 'index'
        ])
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            @include('dashboard.category.partials.form')
        </form>
    </div>
</div>
@endsection
