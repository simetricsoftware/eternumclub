@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', [
            'title' => 'Crear tipo de entrada',
            'route' => 'ticket-type',
            'view'  => 'index',
            'params' => [ 'post' => $post ]
        ])
        <form id="post-form" action="{{ route('ticket-type.store', ['post' => $post]) }}" method="POST">
            @csrf
            @include('dashboard.ticket-type.partials.form')
        </form>
    </div>
</div>
@endsection
