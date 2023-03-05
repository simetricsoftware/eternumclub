<div
    x-show="open"
    class="fixed inset-0 flex"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div class="absolute w-full h-full bg-violet-100 opacity-25"></div>
    <div
        x-show="open"
        class="absolute w-full z-10 min-h-max mt-14"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-y-14"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-14"
    >
        <div class="absolute -z-10 bg-violet-500 m-4 rounded-lg inset-0 opacity-95 shadow-lg"></div>
        <div class="inset-0 m-4 p-4">
            <form class="h-full flex flex-col justify-between" method="POST" action="{{ $action }}">
                @method($method)
                @csrf()
                {{ $slot }}
                <div class="self-end flex gap-4">
                    <x-secondary-button type="button" class="bg-red-600" x-on:click="open = false">Cancelar</x-secondary-button>
                    <x-primary-button class="bg-green-600">Aceptar</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
