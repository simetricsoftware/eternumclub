@extends('layouts.app')
@section('main')
<div id="app">
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="{{ asset('js/web.js') }}" defer></script>
@endsection
