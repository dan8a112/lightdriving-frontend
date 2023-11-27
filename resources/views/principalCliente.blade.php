<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('../resources/css/reset.css')}}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('../resources/css/cliente.css')}}>
    <link rel="stylesheet" href={{asset('../resources/css/app.css')}}>
    <title>Bienvenida</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src={{asset('../resources/img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>
        <div class="main_container">
            <h4 class="main_text">Bienvenido</h4>
            <h4 class="main_text">{{$cliente->nombre." ".$cliente->apellido}}</h4>
        </div>

        <div class="description_container">
            <p class="description_text">¿A donde deseeas ir hoy?</p>
        </div>
        
        <p class="historial_title">Historial</p>
        <div class="historial_container">
            @foreach ($cliente->carreras as $carrera)
            <div class="historial_card">
                <section class="info_container">
                    <img class="icon_car" src={{asset('../resources/img/carrera.png')}} alt="icono auto">
                    <div class="historial_info">
                        <span class="date_card">{{$carrera->factura->fecha}}</span>
                        <span>{{$carrera->factura->total}}</span>
                        <span>{{}}</span><!--Falta mostrar el metodo de pago!--> 
                    </div>    
                </section>
                <div class="historial_mas">
                    <a href="">Ver detalle</a>
                    <p class="carrera_estado">EN PROCESO</p>
                </div>
            </div>
            @endforeach
            <a href={{route('cliente.carrera')}} class="add_button"><img src={{asset('../resources/img/mas.png')}}  alt="mas icon"></a>
        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('../resources/img/social.svg')}} alt="">
            </div>
        </footer>
    </body>
</html>