<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $event->title }}
        </h2>
        <div class="flex flex-col items-center gap-4 mt-4">
            <form class="flex w-full gap-2" action="{{ route('events.show', [ 'event' => $event ]) }}">
                <input type="hidden" name="sex" value="{{ request()->sex }}"/>
                <input  class="rounded-lg w-3/4" type="search" name="search" placeholder="Buscar" value="{{ request()->search }}"/>
                <button class="rounded-lg text-violet-200 w-1/4 bg-violet-600" type="submit">Buscar</button>
            </form>
            <div class="flex">
                <a class="text-violet-800 underline" href="{{ route('events.show', [ 'event' => $event, 'email_first' => 1 ]) }}">Correo: {{ $pending_to_approve }}</a>
                <span class="text-violet-800">&nbsp;-&nbsp;</span>
                <a class="text-violet-800 underline" href="{{ route('events.show', [ 'event' => $event, 'used_first' => 1 ]) }}">Escaneados: {{ $total_used }}</a>
                <span class="text-violet-800">&nbsp;-&nbsp;</span>
                <a class="text-violet-800 underline" href="{{ route('events.show', [ 'event' => $event ]) }}">Total: {{ $total_hashes }}</a>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="w-full">
            <div class="bg-container overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-white flex flex-col gap-6">
                    <ul class="grid w-full gap-4 md:px-14 md:grid-cols-4">
                        @foreach($hashes as $hash)
                        <li class="bg-container w-full flex flex-col border rounded p-4 gap-4">
                            <div class="flex items-center">
                                @isset($hash->voucher)
                                <a class="rounded-lg px-4 py-2 bg-sky-600 flex justify-center items-center overflow-hidden" target="_blank" href="{{ asset("storage/$hash->voucher") }}">Ver comprobante</a>
                                @else
                                <div class="flex w-full items-center justify-center">
                                    <span class="text-center">Sin comprobante</span>
                                </div>
                                @endisset
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="col-span-2 border-r border-r-violet-900">
                                    <ul class="flex flex-col w-full justify-center">
                                        @isset($hash->used_at)
                                        <li class="flex flex-col text-xl text-red-600">
                                            <p><span class="text-sm font-bold text-red-700">Se escaneó el Qr en</span> {{ $hash->used_at }}</p>
                                        </li>
                                        @endisset
                                        @isset($hash->approved_at)
                                        <li class="flex flex-col text-xl text-orange-600">
                                            <p><span class="text-sm font-bold text-orange-700">Se envió el correo en</span> {{ $hash->approved_at }}</p>
                                        </li>
                                        @endisset
                                        <li class="text-2xl text-purple-900">
                                            <span class="text-sm font-bold text-purple-700">Nombre</span>
                                            <br>
                                            {{ $hash->name }}
                                        </li>
                                        <li class="text-sm text-purple-900 flex-1">
                                            <span class="text-sm font-bold text-purple-700">Correo</span>
                                            <br>
                                            {{ $hash->email }}
                                        </li>
                                        <li class="flex flex-col text-2xl text-purple-900">
                                            <span class="text-sm font-bold text-purple-700">Teléfono</span>
                                            <br>
                                            {{ $hash->phone }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="flex items-center justify-center gap-6">
                                    @isset($hash->used_at)
                                        <span class="text-violet-800">Ya utilizado</span>
                                    @else
                                    <div class="flex flex-col w-full justify-center items-center gap-2 px-2">
                                        @if($hash->not_used)
                                        <div x-data="{ open: false }" class="w-full">
                                            <x-secondary-button type="button" x-on:click="open = true" class="w-full flex justify-center">Correo</x-secondary-button>
                                            <x-modal.confirm method="PUT" action="{{ route('dashboard.hashes.approvate', [ 'hash' => $hash ]) }}">
                                                <div class="flex items-center justify-center py-14">
                                                    <p class="text-3xl text-center">¿Estás seguro en enviar el correo de la entrada con el código QR?</p>
                                                </div>
                                            </x-modal.confirm>
                                        </div>
                                        @endif
                                        <div x-data="{ open: false }" class="w-full">
                                            <x-secondary-button type="button" x-on:click="open = true" class="bg-red-600 w-full text-center flex justify-center">Eliminar</x-secondary-button>
                                            <x-modal.confirm method="DELETE" action="{{ route('dashboard.hashes.delete', [ 'hash' => $hash ]) }}">
                                                <div class="flex items-center justify-center py-14">
                                                    <p class="text-3xl text-center">¿Estás seguro en eliminar este registro?</p>
                                                </div>
                                            </x-modal.confirm>
                                        </div>
                                        <div x-data="{ open: false }" class="w-full">
                                            <x-secondary-button type="button" x-on:click="open = true" class="bg-yellow-600 w-full text-center flex justify-center">Usada</x-secondary-button>
                                            <x-modal.confirm method="PUT" action="{{ route('register-hash-manually') }}">
                                                <div class="flex items-center justify-center py-14">
                                                    <input type="hidden" name="hash" value="{{ $hash->hash }}"/>
                                                    <input type="hidden" name="email" value="{{ $hash->email }}"/>
                                                    <p class="text-3xl text-center">¿Estás seguro en marcar esta entrada como usada?</p>
                                                </div>
                                            </x-modal.confirm>
                                        </div>
                                        <a class="w-full text-center px-4 py-2 bg-green-500 rounded-md uppercase text-xs" aria-label="Chat on WhatsApp" href="https://api.whatsapp.com/send/?phone=593{{ $hash->phone }}&text={{ urlencode($whatsapp_message($hash->name)) }}&type=phone_number&app_absent=0" target="_blank">
                                            WhatsApp
                                        </a>
                                        <a class="w-full text-center px-4 py-2 bg-blue-500 rounded-md uppercase text-xs" aria-label="Chat on WhatsApp" href="{{ route('dashboard.hashes.invitation', [ 'hash' => $hash ]) }}" download="invitacion.jpg" target="_blank">
                                            Invitación
                                        </a>
                                        <a class="w-full text-center px-4 py-2 bg-emerald-500 rounded-md uppercase text-xs" aria-label="Chat on WhatsApp" href="{{ route('events.show', [ 'event' => $event ]) }}">
                                            Listo
                                        </a>
                                    </div>
                                    @endisset
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-between">
                        <a class="px-4 py-2 rounded-lg bg-violet-900" href="{{ $hashes->previousPageUrl() }}">Anterior</a>
                        <a class="px-4 py-2 rounded-lg bg-violet-900" href="{{ $hashes->nextPageUrl() }}">Siguiente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
