<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('web.index') }}">Web</a>
            </li>
            @can('show.posts')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('posts.index') }}">Eventos</a>
            </li>
            @endcan
            @auth
            @canany(['show.users', 'show.categories', 'show.roles'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dashboard
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @can('show.users')
                    <a class="dropdown-item" href="{{ route('users.index') }}">Usuarios</a>
                    @endcan
                    @can('show.categories')
                    <a class="dropdown-item" href="{{ route('categories.index') }}">Categorias</a>
                    @endcan
                    @can('show.roles')
                    <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                    @endcan
                    @can('show.tags')
                    <a class="dropdown-item" href="{{ route('tags.index') }}">Etiquetas</a>
                    @endcan
                </div>
            </li>
            @endcanany
            @endauth
        </ul>
        <ul class="navbar-nav ml-auto">
            @php
            $route = Route::getCurrentRoute()->getName()
            @endphp
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->full_name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
