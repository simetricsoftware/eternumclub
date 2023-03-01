@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 banner-container">
              <div class="touch-tostart-container">
                <a data-video="#yansiiza" href="#start" class="btn-start btn btn-default btn-lg touch-tostart-lg">Toca para empezar</a>
              </div>
               <div class="banner-video-container">
                    <video id="yansiiza" class="banner-video" autoplay loop muted>
                      <source src="{{ asset('assets/videos/lachavizavideo.mp4') }}" type="video/mp4">
                      <source src="{{ asset('assets/videos/lachavizavideo.webm') }}" type="video/webm">
                      Tu navegador no soporta video HTML5.
                    </video>
                    <div class="banner-gradient"></div>
                </div> 
                <div class="section-container-spacer text-center overlapping-content form-container">
                    <h1 class="h2">La Chaviza fest by Yansiiza</h1>
                    <h3>Por favor ingresa tus datos para continuar</h3>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form id="start" action="{{ route('register-voucher', [ 'event' => $event ]) }}" class="reveal-content" method="POST" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Tu nombre de usuario de instagram" required>
                                        @error('instagram')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="radio" class="form-control" name="sex" required value="M">
                                            Mujer
                                        </label>
                                        <label>
                                            <input type="radio" class="form-control" name="sex" required value="F">
                                            Hombre
                                        </label>
                                        @error('sex')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <p>Tienes listo tu outfit</p>
                                        <label>
                                            <input type="radio" class="form-control" name="is-ready" required value="0">
                                            Si
                                        </label>
                                        <label>
                                            <input type="radio" class="form-control" name="is-ready" required value="1">
                                            No
                                        </label>
                                        @error('sex')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="voucher">Selecciona la foto para tu invitación</label>
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
@endsection
