@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="section-container-spacer text-center">
            <h1 style= "font-size: 4rem; margin-top: 150px;" class="h2">QR VÁLIDO</h1> <br>
            <span style="height: 10px; width: 200px; background-color: green; display: inline-block;"></span>
            <tr><td><h3>{{ $hash->name }}</h3></td></tr>
            <tr><td><a href="{{ route('dashboard.hashes.index') }}">Ir a inicio</a></td></tr>
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
