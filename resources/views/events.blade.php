<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Eventos
        </h2>
    </x-slot>

    <div>
        <div class="w-full">
            <div class="bg-container overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-white grid grid-cols-4">
                    @forelse ($events as $event)
                        <a href="{{ route('events.show', [ 'event' => $event ]) }}" class="bg-container h-96 flex items-center justify-center">
                            <span class="text-xl">{{ $event->title }}</span>
                        </a>
                    @empty
                        <p>Sin eventos</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
