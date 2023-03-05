@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="section-container-spacer text-center">
            <h1 style= "font-size: 4rem; margin-top: 150px;" class="h2">UPS</h1> <br>
            <span style="height: 10px; width: 200px; background-color: red; display: inline-block;"></span>
            <tr><td><h3>Este código ya fúe utilizado el {{ $hash->used_at }}</h3></td></tr>
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
