@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => "$user->full_name",
            'route' => 'users',
            'view'  => 'index'
        ])
        <div class="form-group">
            <label for="name">Nombre</label>
            <input class="form-control" readonly type="text" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="lastname">Apellido</label>
            <input class="form-control" readonly type="text" id="lastname" name="lastname" value="{{ $user->lastname }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" readonly type="text" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="rol">Rol</label>
            <input class="form-control" readonly type="text" id="rol" name="rol" value="{{ $user->getRoleNames()->first() }}">
        </div>
        <div class="form-group">
            <label for="rol">Permisos</label>
            <ul class="list-group">
                @foreach($user->getPermissionNames() as $permission)
                <li class="list-group-item">{{ $permission }}</li>
                @endforeach
            </ul>
        </div>
        @can('edit.users')
        <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a>
        @endcan
        @can('delete.users')
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $user->id }}">Eliminar</button>
        @endcan
    </div>
</div>
@can('delete.users')
@include('dashboard.partials.confirm-delete', ['route' => 'users'])
@endcan
@endsection
