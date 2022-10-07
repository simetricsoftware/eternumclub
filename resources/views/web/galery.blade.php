@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <img src="./assets/images/eternumgif.gif" class="img-responsive" alt="">
          <div class="card-container" style= "margin-top:0.1px;">
            <div class="text-center">
              <h1 class="h2">001 : Halloween Boiler Room 2022</h1>
            </div>
            <p style="font-size: 2rem;">Celebramos Halloween con una fiesta de disfraces en el Eternum Club con un exclusivo y terrorifico SET a cargo de DJ Aelism con premio al mejor disfraz y barra libre all night</p>
  
            <blockquote>
              <p style="text-align: center;">"Cause this is thriller, thriller night"</p>
              <small class="pull-right">Michael Jackson</small>
            </blockquote>
          </div>
        </div>

        @foreach($hashes as $hash)
        <div class="col-xs-12 col-md-6">
            <img src="{{ asset("storage/$hash->file") }}" class="img-responsive" alt="">
            <p style="font-size: 2rem;">ETERNUM PUMPKIN #{{ $loop->index + 1 }} $12</p>
            <p style="text-align: center;">
                @isset($hash->user)
                <span class="btn btn-danger btn-lg" role="alert">No diponible</span>
                @else
                <a href="{{ route('purchase', [ 'hash' => $hash->hash ]) }}" class="btn btn-default btn-lg">COMPRAR AHORA</a>
                @endisset
            </p>
        </div>
        @endforeach
  
        
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
