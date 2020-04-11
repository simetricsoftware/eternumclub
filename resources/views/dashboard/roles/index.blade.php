@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        <h2>Roles</h2>
        @include('dashboard.partials.state')
        @can('create.posts')
        <a class="btn btn-primary my-2" href="{{ route('roles.create') }}">Crear</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descrición</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    @can('show.roles')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('roles.show', ['role' => $role->id]) }}">Ver</a>
                    </td>
                    @endcan
                    @can('edit.roles')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('roles.edit', ['role' => $role->id]) }}">Editar</a>
                    </td>
                    @endcan
                    @can('delete.roles')
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $role->id }}">Eliminar</button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@can('delete.roles')
@include('dashboard.partials.confirm-delete', ['route' => 'roles'])
@endcan
@endsection
