<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div>
        <div class="w-full">
            <div class="bg-container overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-white flex">
                    <ul class="flex flex-col w-full gap-4 md:px-14">
                        @foreach($event->hashes as $hash)
                        <li class="bg-container w-full flex flex-col md:flex-row border rounded">
                            <div class="grid grid-cols-2 md:flex md:w-1/6">
                                @isset($hash->voucher) 
                                <a class="ml-2" target="_blank" href="{{ asset("storage/$hash->voucher") }}">
                                    <img class="w-full md:w-auto md:h-40" src="{{ asset("storage/$hash->voucher") }}" alt="{{ $hash->hash }}">
                                </a>
                                @else
                                <div class="flex w-full items-center justify-center"> 
                                    <span class="text-center">Sin comprobante</span>
                                </div>
                                @endisset
                            </div>
                            <div class="flex items-center justify-center p-4 gap-4 md:h-40 md:w-4/6">
                                <ul class="flex flex-col md:gap-12 md:flex-row w-full justify-between items-center">
                                    <li class="text-2xl md:w-32 text-purple-900">
                                        <span class="text-sm">Nombre</span>
                                        <br>
                                        {{ $hash->name }}
                                    </li>
                                    <li class="text-xl md:text-2xl md:min-w-max text-purple-900 flex-1">
                                        <span class="text-sm">Correo</span>
                                        <br>
                                        {{ $hash->email }}
                                    </li>
                                    <li class="flex flex-col text-2xl md:min-w-max text-purple-900">
                                        <a class="pb-2" aria-label="Chat on WhatsApp" href="https://wa.me/593{{ $hash->phone }}?text=Hola%20{{ $hash->name }}, bienvenido">
                                            <img class="mx-auto w-2/3 md:w-24" alt="Chat on WhatsApp" src="{{ Vite::asset('resources/images/WhatsAppButtonGreenSmall.png') }}" />
                                        </a> 
                                        <br>
                                        {{ $hash->phone }}
                                    </li>
                                </ul>
                            </div>
                            <div class="flex p-4 items-center justify-center gap-6 md:h-40 md:w-1/6">
                                <div class="flex flex-col w-full justify-center items-center md:justify-end">
                                    @if($hash->voucher && $hash->not_used) 
                                    <form method="POST" action="{{ route('dashboard.hashes.approvate', [ 'hash' => $hash ]) }}">
                                        @method('PUT')
                                        @csrf()
                                        <x-primary-button>{{ $hash->approved_at }} Aprobar</x-primary-button>
                                    </form>
                                    <hr>
                                    @endif
                                    <form method="POST" action="{{ route('dashboard.hashes.delete', [ 'hash' => $hash ]) }}">
                                        @method('DELETE')
                                        @csrf()
                                        <x-secondary-button>Eliminar</x-secondary-button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
