@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => 'Crear usuario',
            'route' => 'users',
            'view'  => 'index'
        ])
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('dashboard.users.partials.form')
        </form>
    </div>
</div>
@endsection
