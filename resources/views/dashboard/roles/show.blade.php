@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => "$role->name",
            'route' => 'roles',
            'view'  => 'index'
        ])
        <div class="form-group">
            <label for="name">Nombre</label>
            <input class="form-control" readonly type="text" id="name" name="name" value="{{ $role->name }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" readonly id="description" name="description">{{ $role->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="rol">Permisos</label>
            <ul class="list-group">
                @foreach($role->permissions as $permission)
                <li class="list-group-item">{{ $permission->description }}</li>
                @endforeach
            </ul>
        </div>
        @can('edit.roles')
        <a class="btn btn-primary" href="{{ route('roles.edit', ['role' => $role->id]) }}">Editar</a>
        @endcan
        @can('delete.roles')
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $role->id }}">Eliminar</button>
        @endcan
    </div>
</div>
@can('delete.roles')
@include('dashboard.partials.confirm-delete', ['route' => 'roles'])
@endcan
@endsection
