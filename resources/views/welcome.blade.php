@extends('layouts.web')

@section('content')
<div class="hero-full-container background-image-container white-text-container" style="background-image: url('./assets/images/landinget.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="hero-full-wrapper">
            <div class="text-content">
              <h1>Hola,<br>
                <span id="typed-strings">
                  <span>Bienvenido</span>
                  <span>Al Eternum</span>
                  <span>Club</span>
                </span>
                <span id="typed"></span>
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

<script>
  document.addEventListener("DOMContentLoaded", function (event) {
     type();
     movingBackgroundImage();
  });
</script>
@endsection
