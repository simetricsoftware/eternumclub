<div class="col-sm-12">
    <h1>{{ $title }}</h1>
    @isset($route, $view)
    <a class="btn btn-link" href='{{ route("$route.$view", isset($params) ? $params : []) }}'>Atras</a>
    @else
    <a class="btn btn-link" href="javascript:history.back()">Atras</a>
    @endisset
    @include('dashboard.partials.errors')
    @include('dashboard.partials.state')
</div>
