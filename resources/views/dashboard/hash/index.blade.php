<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hashes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="my-4">
                        <x-nav-link :href="route('dashboard.hashes.create')">New</x-nav-link>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
