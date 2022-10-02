<div> 
    <span>Nombre:</span> {{ $name }}
    <span>Correo:</span> {{ $email }}
    <span>Teléfono:</span> {{ $phone }}
    <span>Teléfono:</span> {{ $phone }}
</div>
<img src="{{ $voucher }}">
<a href="{{ route('dashboard.hashes.index', [ 'hash' => $hash ]) }}">Click para ir aprobar</a>
