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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('tickets.index', [ 'post' => $post->id ]) }}">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" name="search" placeholder="Buscar por cédula o hash" value="{{ request()->get('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($tickets as $ticket)
                <div class="p-2 col-12 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->assistant->name }}</h5>
                            <p class="card-text">
                                <span class="badge badge-primary">Usado: {{ $ticket->used_at ?? 'Nunca' }}</span>
                                <span class="badge badge-warning">Enviado: {{ $ticket->sent_at ?? 'Nunca' }}</span>
                            </p>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Enviar correo">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar entrada">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Marcar como usada">
                                    <i class="fa-solid fa-user-check"></i>
                                </button>
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Enviar invitación por whatsapp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Descargar invitación">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </button>
                                <span data-toggle="tooltip" data-placement="top" title="Ver hash">
                                    <a class="btn btn-sm btn-info" href="#collapseExample{{ $ticket->id }}" role="button" aria-expanded="false" aria-controls="collapseExample" data-toggle="collapse">
                                        <i class="fa-solid fa-hashtag"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="collapse mt-2" id="collapseExample{{ $ticket->id }}">
                                <span class="hash">SHA-256: {{ $ticket->hash }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{ $tickets->links() }}
    </div>
</div>
@can('delete.posts')
@include('dashboard.partials.confirm-delete', ['route' => 'posts'])
@endcan
@endsection
@section('styles')
<style>
    .hash {
        font-size: 0.8rem;
        font-family: monospace;
}
</style>
@endsection
