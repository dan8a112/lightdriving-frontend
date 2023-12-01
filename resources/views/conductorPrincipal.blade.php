<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('css/reset.css')}}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('css/cliente.css')}}>
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <title>Bienvenida</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src={{asset('img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>
        <div class="main_container">
            <h4 class="main_text">Bienvenido</h4>
            <h4 class="main_text">{{$conductor->nombre." ".$conductor->apellido}}</h4>
        </div>
       

        <p class="historial_title">Tus viajes</p>
        <div class="historial_container">
            @foreach ($conductor->facturas as $factura)
            <div class="historial_card">
                <section class="info_container">
                    <img class="icon_car" src={{asset('img/carrera.png')}} alt="icono auto">
                    <div class="historial_info">
                        <!--Falta mostrar el id de la carrera!--> 
                        <span class="date_card">{{$factura->fecha}}</span>
                        <span>Total: {{$factura->total}}</span>
                        <span>Metodo: {{$factura->metodoPago}}</span>
                    </div>    
                </section>
                <div class="historial_mas">
                    <a href="">Ver detalle</a>
                    <p class="carrera_estado" id={{$factura->idFactura}}>{{$factura->estadoCarrera}}</p>
                </div>
            </div>
            @if ($factura->estadoCarrera=='En progreso')
            <script>
                document.getElementById({{$factura->idFactura}}).style.color="#d35400"
                document.getElementById('add_button').href="#"
                document.getElementById('add_button').style.backgroundColor = "#424242"
                document.getElementById('add_button').addEventListener('click',()=>alert('Debes completar las carreras pendientes'))
            </script> 
            @endif
            @endforeach
        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('img/social.svg')}} alt="">
            </div>
        </footer>
    </body>
</html>