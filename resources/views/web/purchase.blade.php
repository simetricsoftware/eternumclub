@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 banner-container">
               <div class="banner-video-container">
                    <video class="banner-video" autoplay loop muted>
                      <source src="{{ asset('assets/videos/lachavizavideo.webm') }}" type="video/webm">
                      Tu navegador no soporta video HTML5.
                    </video>
                    <div class="banner-gradient"></div>
                </div> 
                <div class="section-container-spacer text-center overlapping-content form-container">
                    <h1 class="h2">La Chavisa fest by Yansiiza</h1>
                    <h3>Por favor ingresa tus datos para continuar</h3>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form action="{{ route('register-voucher', [ 'event' => $event ]) }}" class="reveal-content" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hash" name="hash" value="{{ request()->hash }}">
                            <div class="row">
                                <div class="col-md-7 form-fields">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                        @error('email')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Celular" required>
                                        @error('phone')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="voucher">Carga el comprobante de tu transferencia</label>
                                        <input type="file" class="form-control" id="voucher" name="voucher" required accept="image/jpeg,image/png">
                                        @error('voucher')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-default btn-lg">Enviar datos</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<footer class="footer-container text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>ETERNUM CLUB © | IS A <a style="text-decoration:none;" href="https://simetricsoftware.com/">SIMETRIC SOFTWARE PRODUCTION</a></p>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        navActivePage();
    });

    function prepare(e) {
        e.preventDefault()

        const hash = document.getElementById('hash').value
        const name = document.getElementById('name').value
        const email = document.getElementById('email').value
        const phone = document.getElementById('phone').value

        const body = JSON.stringify({
            amount: 100,
            amountWithoutTax: 100,
            clientTransactionID: new Date().getTime(),
            responseUrl: `https://localhost/request-qr?hash=${hash}&name=${name}&email=${email}&phone=${phone}`,
            cancellationUrl: "https://localhost/request-qr",
        })

        /* fetch('https://pay.payphonetodoesposible.com/api/Links', { */
        fetch('https://pay.payphonetodoesposible.com/api/button/Prepare', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                /* 'Content-Type': 'application/x-www-form-urlencoded', */
                'Authorization': "Bearer qHFtKLJQ53DNmdpp8LygueJJsu8cdGVA3bnpcgfkDy1cBvLzbe7S89aOmRJrzIy4isLJhdoxSJfhqHIKD3AeQyaFH2i-Y1lOFPbZBiORV-1vAhtCrIWMqKmGDEiKcoErB4l6N-DSTwhnjt_gKDOdUWYVeHv9fO3JG5BAUBwQCsKgP6wmKYeV0i8ExHs_R-8-04ViNDSjdRcAWSk-xD9vRACX0WFCZitFvss-fxxADNgTkpOt87qcjw2s6fTC7lG23hq2XD3dqWXepn_kvk-z6PlVk8du3VHVdlFm9euTyJRL3r_lGDlNPAZj72Ozzlx8ChgLKA"
            },
            body
        })
    }
</script>
@endsection
