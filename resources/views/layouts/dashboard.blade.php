@extends('layouts.app')
@section('main')
<div>
    @include('partials.navbar')

    <main class="py-4">
        @yield('content')
    </main>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
</div>
@endsection
