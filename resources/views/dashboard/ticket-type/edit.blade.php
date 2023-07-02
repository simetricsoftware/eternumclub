@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8">
        @include('dashboard.partials.header', ['title' => "Editar $ticketType->name"])
        <form id="post-form" action="{{ route('ticket-type.update', ['post' => $post->id, 'ticket_type' => $ticketType]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dashboard.ticket-type.partials.form')
        </form>
    </div>
</div>
@endsection
