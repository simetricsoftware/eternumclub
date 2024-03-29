@extends('layouts.dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-10">
            @if($posts->isEmpty())
            <div class="d-flex flex-column align-items-center justify-content-center mt-4">
                <img src="{{ asset('images/crear.gif') }}" alt="No hay eventos" >

                <a class="btn btn-lg btn-dark mt-3" href="{{ route('posts.create') }}" style="color: white;">Crear Evento</a>
            </div>
            @else
                <h2>Eventos</h2>
                @include('dashboard.partials.state')
                @can('create.posts')
                    <a class="btn btn-primary my-2" href="{{ route('posts.create') }}">Crear Evento</a>
                @endcan
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>
                                <i class="fa-solid fa-thumbs-up"></i>
                            </th>
                            <th>
                                <i class="fa-solid fa-thumbs-down"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    @if($post->status === 'posted')
                                        <i class="fa-solid fa-globe text-success"></i>
                                    @else
                                        <i class="fa-solid fa-pen-ruler text-primary"></i>
                                    @endif
                                </td>
                                <td>{{ $post->likes }}</td>
                                <td>{{ $post->dislikes }}</td>
                                @can('edit.posts')
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('vouchers.index', ['post' => $post->id, 'filter[status]' => 'pending']) }}" data-toggle="tooltip" data-placement="top" title="Lista de asistentes">
                                            <i class="fa-sharp fa-solid fa-list-check"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('edit.posts')
                                    <td>
                                        <a class="btn btn-success" href="{{ route('posts.edit', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Editar evento">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('edit.posts')
                                    <td>
                                        <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post->id]) }}" data-toggle="tooltip" data-placement="top" title="Ver detalle del evento">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                @endcan
                                @can('delete.posts')
                                    <td>
                                        <div data-toggle="tooltip" data-placement="top" title="Eliminar evento">
                                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $post->id }}" >
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
            @endif
        </div>
    </div>
    @can('delete.posts')
        @include('dashboard.partials.confirm-delete', ['route' => 'posts'])
    @endcan
@endsection

