@extends('layouts.dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-10">
        @include('dashboard.partials.header', [
            'title' => 'Cuentas bancarias',
            'route' => 'posts',
            'view'  => 'show',
            'params' => [$post->id],
        ])
        <div id="app">
            <form action="{{ route('bank-accounts.store', [ 'post' => $post ]) }}" method="POST">
                @csrf
                <bank-accounts-component :bank-accounts="{{ json_encode($bankAccounts) }}"></bank-accounts-component>
            </form>
        </div>
    </div>
</div>
@endsection
