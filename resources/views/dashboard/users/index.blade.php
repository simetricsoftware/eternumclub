@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        <h2>Usuarios</h2>
        @include('dashboard.partials.state')
        @can('create.users')
        <a class="btn btn-primary my-2" href="{{ route('users.create') }}">Crear</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->first() }}</td>
                    @if(!$user->trashed())
                    @can('show.users')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('users.show', ['user' => $user->id]) }}">Ver</a>
                    </td>
                    @endcan
                    @can('edit.users')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a>
                    </td>
                    @endcan
                    @endif
                    @can('delete.users')
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirm-delete-user" data-status="{{ $user->trashed() }}" data-id="{{ $user->id }}">{{ $user->trashed() ? "Restaurar" : "Eliminar" }}</button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@can('delete.users')
@include('dashboard.users.partials.confirm')
@endcan
@endsection
