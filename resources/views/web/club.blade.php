@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="section-container-spacer text-center">
            <h1 class="h2">Eternum Club</h1>
          </div>
          
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="row">
                <div class="col-xs-12 col-md-6">
                  <h3>Bienvenidos  a Eternum Club</h3>
                  <p style="font-size: 1.5rem;">
                    Encuentra tus eventos favoritos y compra tus entradas desde la comodidad de tu hogar.
                    Nuestro sistema en línea es fácil y seguro. 
                    Simplemente navega por nuestra selección de eventos y elige el que desees asistir. 
                    Podrás ver información detallada sobre el evento, incluyendo la fecha, hora, ubicación y 
                    precio de las entradas.</p>
                  <h3>Como comprar entradas</h3>
                  <p style="font-size: 1.5rem;">
                    Una vez que hayas seleccionado tus entradas, podrás comprarlas llenando un sencillo formulario.
                    Te enviaremos un correo electrónico de confirmación de compra adjunto con un código QR para que 
                    puedas ingresar el día del evento.
                  </p>
                  <h3>Listo para farrear</h3>
                  <p style="font-size: 1.5rem;">
                    En caso de que necesites ayuda con tu compra, 
                    nuestro equipo de atención al cliente está disponible
                    para ayudarte por medio de nuestro correo electrónico info@simetricsoftware.com
                    También contamos con una política de devolución de entradas para la mayoría de los eventos, en caso de que cambies de opinión o no puedas asistir. 
                  </p>
                </div>
                <div class="col-xs-12 col-md-6">
                  <img src="./assets/images/sample.png" class="img-responsive" alt="">
                </div>
              </div>
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
