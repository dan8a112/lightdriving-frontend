<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Welcome</title>
</head>
    <header>
        <div class="header_container">
            <img class="icon" src="{{ asset('img/logo.svg') }}" alt="">
            <h3 class="title">LightDriving</h3>
            <div class="dropdown desplegable">
                <button class="btn btn-secondary dropdown-toggle desplegablebtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Iniciar Sesion
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href={{route('cliente.login')}}>Pasajero</a></li>
                  <li><a class="dropdown-item" href={{route('conductor.login')}}>Conductor</a></li>
                </ul>
            </div>
            
        </div>
    </header>
    <body>
        <div class="main_container">
            <h4 class="main_text">Viaja seguro</h4>
            <h4 class="main_text">A la velocidad de la luz</h4>
        </div>

        <img class="banner" src="{{ asset('img/banner.png') }}" alt="banner principal">

        <div class="description_container">
            <p class="description_text">Crea tu cuenta y regístrate de forma sencilla.</p>
        </div>
        
        <div class="register_container">
            <a class="register_card" href="{{ route('cliente.register') }}">
                <img class="register_route" src="{{ asset('img/route.svg') }}" alt="">
                <p class="register_text">Regístrate para viajar</p>
                <img class="register_arrow" src="{{ asset('img/arrow.png') }}" alt="">
            </a>
            <a class="register_card" href="{{ route('conductor.register') }}">
                <img class="register_car" src="{{ asset('img/car.svg') }}" alt="">
                <span class="register_text">Regístrate para conducir</span>
                <img class="register_arrow" src="{{ asset('img/arrow.png') }}" alt="">
            </a>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    <footer>
        <div class="footer_container">
            <h3 class="footer_text">LightDriving</h3>
            <img class="footer_social" src="{{ asset('img/social.svg') }}" alt="">
        </div>
    </footer>
</html>
