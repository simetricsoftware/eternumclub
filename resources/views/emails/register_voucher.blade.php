<div> 
    <span>Nombre:</span> {{ $hash->name }}
    <span>Correo:</span> {{ $hash->email }}
    <span>Teléfono:</span> {{ $hash->phone }}
</div>
<img src="{{ $hash->voucher }}">
<a href="{{ route('events.show', [ 'event' => $hash->event, 'hash' => $hash ]) }}">Click para ir aprobar</a>
