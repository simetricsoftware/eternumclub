@extends('layouts.web')

@section('content')
<div class="section-container">
    <div class="container">
        <div class="row">

            <div class="col-sm-8 col-sm-offset-2 section-container-spacer">
                <div class="text-center">
                    <h1 class="h2">II : Eventos</h1>
                    <p style="font-size: 1.7rem;">Cada una de nuestras colecciones de NFTs incluye artes únicos que equivalen a una entrada a un evento exclusivo o son canjeables por un objeto en la vida real
                    </p>
                </div>
            </div>

            <div class="col-md-12">

                <div id="myCarousel" class="carousel slide projects-carousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4">

                                    <div class="black-image-project-hover">
                                        <img src="./assets/images/halloween.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="card-container card-container-lg">
                                        <h4>001/001</h4>
                                        <h3>Halloween Boiler room 2022</h3>
                                        <p style="font-size: 1.2rem;"> <b>44 nfts para celebrar halloween en el boiler room de DJ Aelism</b></p>
                                        <a href="{{ route('galery') }}" title="" class="btn btn-default">COMPRAR</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="black-image-project-hover">
                                        <img src="./assets/images/prox-2.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="card-container card-container-lg">
                                        <h4>002/001</h4>
                                        <h3>Próximamente</h3>
                                        <p style="font-size: 1.2rem;"> <b>Wait for it</b></p>
                                        <a href="./galery.html" title="" class="btn btn-default">COMPRAR</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="black-image-project-hover">
                                        <img src="./assets/images/prox-3.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="card-container card-container-lg">
                                        <h4>003/001</h4>
                                        <h3>Próximamente</h3>
                                        <p style="font-size: 1.2rem;"> <b>Wait for it</b></p>
                                        <a href="./galery.html" title="" class="btn btn-default">COMPRAR</a>
                                    </div>
                                </div>

                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="./work.html" class="black-image-project-hover">
                                        <img src="./assets/images/prox-4.jpg" alt="Image" class="img-responsive">
                                    </a>
                                    <div class="card-container">
                                        <h4>004/001</h4>
                                        <h3>Próximamente</h3>
                                        <p>Wait for it</p>
                                        <a href="./galery.html" title="" class="btn btn-default">COMPRAR</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <a href="./work.html" class="black-image-project-hover">
                                        <img src="./assets/images/prox-5.jpg" alt="Image" class="img-responsive">
                                    </a>
                                    <div class="card-container">
                                        <h4>005/001</h4>
                                        <h3>Próximamente</h3>
                                        <p>Wait for it</p>
                                        <a href="./galery.html" title="" class="btn btn-default">COMPRAR</a>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <a href="./work.html" class="black-image-project-hover">
                                        <img src="./assets/images/prox-6.jpg" alt="Image" class="img-responsive">
                                    </a>
                                    <div class="card-container">
                                        <h4>006/001</h4>
                                        <h3>Próximamente</h3>
                                        <p>Wait for it</p>
                                        <a href="./galery.html" title="" class="btn btn-default">COMPRAR</a>
                                    </div>
                                </div>

                            </div>
                            <!--/row-->
                        </div>

                        <!--/item-->
                    </div>
                    <!--/carousel-inner-->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>

                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                </div>



                <!--/myCarousel-->
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
</script>
@endsection
