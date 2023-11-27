<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset("../resources/css/reset.css")}}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset("../resources/css/home.css")}}>
    <link rel="stylesheet" href={{asset("../resources/css/app.css")}}>
    <title>Welcome</title>
</head>
    <header>
        <div class="header_container">
            <img class="icon" src={{asset('../resources/img/logo.svg')}} alt="">
            <h3 class="title">LightDriving</h3>
        </div>
    </header>
    <body>
        <div class="main_container">
            <h4 class="main_text">Viaja seguro</h4>
            <h4 class="main_text">A la velocidad de la luz</h4>
        </div>

        <img class="banner" src={{asset("../resources/img/banner.png")}} alt="banner principal">

        <div class="description_container">
            <p class="description_text">Crea tu cuenta y registrate de forma sencilla.</p>
        </div>
        
        <div class="register_container">
            <a class="register_card" href={{route('cliente.register')}}>
                <img class="register_route" src={{asset("../resources/img/route.svg")}} alt="">
                <p class="register_text">Registrate para viajar</p>
                <img class="register_arrow" src={{asset("../resources/img/arrow.png")}} alt="">
            </a>
            <a class="register_card" href={{route('conductor.register')}}>
                <img class="register_car" src={{asset("../resources/img/car.svg")}} alt="">
                <span class="register_text">Registrate para conducir</span>
                <img class="register_arrow" src={{asset("../resources/img/arrow.png")}} alt="">
            </a>
        </div>
    </body>
    <footer>
        <div class="footer_container">
            <h3 class="footer_text">LightDriving</h3>
            <img class="footer_social" src={{asset("../resources/img/banner.png")}}"../resources/img/social.svg" alt="">
        </div>
    </footer>
</html>