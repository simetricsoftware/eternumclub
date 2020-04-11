@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', ['title' => "Editar $user->full_name"])
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dashboard.users.partials.form', ['edit' => true])
        </form>
    </div>
</div>
@endsection
