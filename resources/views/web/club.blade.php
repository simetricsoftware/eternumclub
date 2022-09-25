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
                  <h3>Compra NFTs, asiste a eventos exclusivos</h3>
                  <p style="font-size: 1.5rem;">Ahora puedes comprar tus entradas y guardarlas para siempre como un NFT dentro de la blockchain, además de obtener un coleccionable único que ganará valor con el tiempo puedes acceder a increíbles eventos o intercambiarlo por un objeto en la vida real!</p>
                  <h3>No más PDFs, mejor NFTs </h3>
                  <p style="font-size: 1.5rem;">No guardes tus entradas como PDFs, guárdalas en la blockchain donde estarán para siempre como un NFT, en Eternum club ahora es posible comprar increíbles colecciones de imágenes realizadas por grandes artistas del medio como entradas para tus eventos favoritos. </p>
                  <h3>Tus entradas para siempre en la blockchain </h3>
                  <p style="font-size: 1.5rem;"> Guarda esa entrada tan especial como un NFT para siempre, En Eternum lo hacemos realidad gracias a que guardamos todas nuestras colecciones en la red IPFS la cual utiliza la blockchain de Filecoin como medio de almacenamiento. 
                  </p >
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