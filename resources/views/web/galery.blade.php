@extends('layouts.web')

@section('content')
<div class="section-container" style="padding-bottom: 0;">
    <div class="container">
      <div class="row galery-content">
        <div class="col-xs-12 banner-container">
          <img class="banner-mobile z-10" src="{{ asset('assets/images/lachavizav.png') }}" class="img-responsive" alt="">
          <img class="banner-desktop z-10" src="{{ asset('assets/images/lachavizah.png') }}" class="img-responsive" alt="">
          <div class="card-container z-10">
            <div class="text-center">
              <h1 class="h2">LA CHAVISA FEST BY YANZIIZA (NOS MUDAMOS A EGIPTO )</h1>
            </div>
            <ul class="content-list">
              <li>Estás cordialmente invitado a la fiesta privada más cool de Ambato.</li>
              <li>Verificaremos tus datos.</li>
              <li>Es obligatorio tu correo electrónico y número de teléfono (para enviarte el código QR de ingreso).</li>
              <li>La fiesta será en Ranch Yanziiza (la ubicación exacta será enviada en tu invitación).</li>
              <li>Te agradezco por seguir apoyándome en mi carrera y espero que puedas disfrutar conmigo el día viernes 17 de marzo.</li>
              <li>Tendremos estricto derecho de admisión.</li>
              <li>Buena vestimenta.</li>
              <li>La fiesta contará con una temática egipcia en la cual esperamos que puedas vestirte de acuerdo a la temática.</li>
              <li>El ingreso será únicamente con el código QR, por lo cual es privada y con su respectiva invitación.</li>
              <li>El ingreso es de 7:30 pm a 9:30 pm.</li>
              <li>Es una fiesta de panas amigos, así que no cualquiera podrá ingresar. Ñiaa 🪩</li>
            </ul>    
          </div>
        </div>

        <p class="z-10" style="text-align: center;">
            @isset($hash->user)
            <span class="btn btn-danger btn-lg" role="alert">No diponible</span>
            @else
            <a href="{{ route('purchase', [ 'event' => $event ]) }}" class="btn btn-default btn-lg">REGISTRARME</a>
            @endisset
        </p>
        
        <div class="backvideo overlapping-content">
            <div class="banner-video-container">
                <video class="banner-video" autoplay loop volume="1">
                  <source src="{{ asset('assets/videos/yansiiza.mp4') }}" type="video/mp4">
                  <source src="{{ asset('assets/videos/yansiiza.webm') }}" type="video/webm">
                  Tu navegador no soporta video HTML5.
                </video>
                <div class="banner-gradient banner-gradient-inverted"></div>
            </div>
        </div>
        
       </div>
    </div>
  </div>
  
  
  <footer class="footer-container text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <p>ETERNUM CLUB ©  | IS A <a style="text-decoration:none;" href="https://simetricsoftware.com/">SIMETRIC SOFTWARE PRODUCTION</a></p>
        </div>
      </div>
    </div>
  </footer>
  
  <script>
    document.addEventListener("DOMContentLoaded", function (event) {
       navActivePage();
    });
  </script>
@endsection
