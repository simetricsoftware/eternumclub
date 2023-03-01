<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="description" name="eternum club compra NFTs">
    <meta name="google" content="notranslate" />
    <meta content="Simetric Software - Saishimura" name="author">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <title>Eternum Club</title>

    <link href="{{ asset('css/main.3f6952e4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>

<body class="minimal">
    <div id="site-border-left"></div>
    <div id="site-border-right"></div>
    <div id="site-border-top"></div>
    <div id="site-border-bottom"></div>
    <!-- Add your content of header -->
    <header>
        <nav class="navbar navbar-fixed-top navbar-inverse">
            <div class="container">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a style="font-size: 3.2vh;" href="{{ route('home') }}" title="">I : Home</a></li>
                        <li><a style="font-size: 3.2vh;" href="{{ route('events') }}" title="">II : Eventos</a></li>
                        <li><a style="font-size: 3.2vh;" href="{{ route('club') }}" title="">III : Club</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <script type="text/javascript" src="{{ asset('js/main.70a66962.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
