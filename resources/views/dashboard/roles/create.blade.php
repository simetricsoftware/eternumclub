@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => 'Crear rol',
            'route' => 'roles',
            'view'  => 'index'
        ])
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            @include('dashboard.roles.partials.form')
        </form>
    </div>
</div>
@endsection
