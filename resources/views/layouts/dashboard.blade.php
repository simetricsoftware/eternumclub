@extends('layouts.app')
@section('main')
<div>
    @include('partials.navbar')

    <main class="py-4">
        @yield('content')
    </main>
    <script src="https://kit.fontawesome.com/229d39c95e.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
</div>
@endsection
