@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        @include('dashboard.partials.header', [
            'title' => 'Comprobantes',
            'route' => 'posts',
            'view'  => 'index',
        ])
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('vouchers.index', [ 'post' => $post->id ]) }}">
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
                <div class="col-12">
                    <a class="btn btn-secondary" href="{{ route('vouchers.index', [ 'post' => $post->id, 'filter[status]' => 'pending' ]) }}">
                        <i class="fa-solid fa-clock"></i>
                        Pendientes
                    </a>
                    <a class="btn btn-primary" href="{{ route('vouchers.index', [ 'post' => $post->id, 'filter[status]' => 'processed' ]) }}">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        Procesados
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($vouchers as $voucher)
                <div class="p-2 col-12 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $voucher->assistant->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $voucher->assistant->identification_number }}</h6>
                            <div class="mt-2">
                                <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Ver comprobante de pago" href="{{ asset('storage/' . $voucher->file) }}" target="_blank">
                                    <i class="fa-solid fa-money-check-dollar"></i>
                                </a>
                                <form class="d-inline" action="{{ route('vouchers.send-mail', [ 'post' => $post, 'voucher' => $voucher ]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Enviar correo">
                                        <i class="fa-solid fa-envelope"></i>
                                    </button>
                                </form>
                                <span data-toggle="tooltip" data-placement="top" title="Reembolsar comprobante">
                                <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $voucher->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                </span>
                                <span data-toggle="tooltip" data-placement="top" title="Ver entradas">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#hashesModal{{ $voucher->id }}">
                                        <i class="fa-solid fa-ticket"></i>
                                    </button>
                                </span>
                                <span data-toggle="tooltip" data-placement="top" title="Ver resultado de encuesta">
                                    <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#questionsModal{{ $voucher->id }}">
                                        <i class="fa-solid fa-question"></i>
                                    </button>
                                </span>
                            </div>
                            <div>
                                <div class="modal fade" id="hashesModal{{ $voucher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Listado de entradas</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            @foreach ($voucher->tickets as $ticket)
                                            <div>
                                                <span class="hash">SHA-256: {{ $ticket->hash }}</span>
                                                <p class="card-text">
                                                    <span class="badge {{ $ticket->used_at ? 'badge-success' : 'badge-primary' }}">Usado: {{ $ticket->used_at ?? 'Nunca' }}</span>
                                                    <span class="badge badge-warning">Enviado: {{ $ticket->sent_at ?? 'Nunca' }}</span>
                                                </p>
                                            </div>
                                            @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="modal fade" id="questionsModal{{ $voucher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Resultado de encuesta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            @foreach ($voucher->answers as $answer)
                                            <div>
                                                <span class="hash font-weight-bold">{{ $answer->question->statement }}</span>
                                                <p class="card-text">
                                                    {{ $answer->response }}
                                                </p>
                                            </div>
                                            @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{ $vouchers->links() }}
    </div>
</div>
@can('delete.posts')
@include('dashboard.partials.confirm-delete', ['route' => 'posts'])
@endcan
@endsection
@section('styles')
<style>
    .hash {
        font-size: 1rem;
        font-family: monospace;
}
</style>
@endsection
