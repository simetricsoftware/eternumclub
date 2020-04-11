@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', ['title' => "Editar $role->name"])
        <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dashboard.roles.partials.form', ['edit' => true])
        </form>
    </div>
</div>
@endsection
