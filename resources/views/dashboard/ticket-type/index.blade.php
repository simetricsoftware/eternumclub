@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        @include('dashboard.partials.header', [
            'title' => 'Entradas',
            'route' => 'posts',
            'view'  => 'index',
        ])
        @include('dashboard.partials.state')
        @can('create.posts')
        <a class="btn btn-primary my-2" href="{{ route('ticket-type.create', ['post' => $post]) }}">Crear</a>
        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->amount }}</td>
                    <td>@ticketquantity($ticket)</td>
                    @can('edit.posts')
                    <td>
                        <a class="btn btn-secondary" href="{{ route('ticket-type.edit', ['post' => $post, 'ticket_type' => $ticket]) }}">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    @endcan
                    @can('delete.posts')
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $ticket->id }}">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </button>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->links() }}
    </div>
</div>
@can('delete.posts')
@include('dashboard.partials.confirm-delete', ['route' => 'posts'])
@endcan
@endsection
