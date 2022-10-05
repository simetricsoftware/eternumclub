<div style="display: flex;flex-direction: column;width: 80%;justify-content: center;align-items: center;margin: 0 auto;">
    <div class="logo">
        <img src="{{ asset('assets/images/eternumlogo.png') }}">
    </div>
    <h1>
        {{ $client_name }}
    </h1>
    <p> Bienvenido a Eternum club, ahora tu NFT se encuentra almacenado para siempre en la blockchain, a continuación te dejamos el QR que debes presentar el día del evento para poder ingresar

    </p>
    <div class="cuerpo">

        <div class="relleno">
            <p1>
                <img width="250px" src="{{ $qr_url }}" alt="">
            </p1>

        </div>

    </div>
    <p>Saludos</p>
    <p>El equipo de Eternum Club</p>
</div>
