@extends('layouts.web')

@section('content')
<div class="section-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="section-container-spacer text-center">
          <h1 style= "font-size: 4rem; margin-top: 150px;" class="h2">Gracias por registrarte en la chaviza</h1> <br>
          <h3>En breve confirmaremos tu información y te enviaremos el QR, revisa tu correo</h3>
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
