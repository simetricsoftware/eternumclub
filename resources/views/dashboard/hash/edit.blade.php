<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Edit $hash->hash") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 flex justify-end">
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <x-primary-button>Eliminar</x-primary-button>
                    </form>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.hashes.update', [ 'hash' => $hash ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.hash.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
