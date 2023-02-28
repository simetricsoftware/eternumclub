<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Eventos
        </h2>
    </x-slot>

    <div>
        <div class="w-full">
            <div class="bg-container overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-white grid md:grid-cols-4">
                    @forelse ($events as $event)
                        <a href="{{ route('events.show', [ 'event' => $event ]) }}" class="bg-container h-48 flex items-center justify-center md:h-96">
                            <div class="flex">
                                <span class="text-xl">{{ $event->title }}</span>
                                <div class="grid grid-cols-1">
                                    <a href="{{ route('events.settings', [ 'event' => $event ]) }}" class="bg-violet-900 px-2 py-1 text-sm rounded-lg">
                                        Configuración
                                    </a>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p>Sin eventos</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
