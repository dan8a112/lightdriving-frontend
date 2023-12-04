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
    <link rel="stylesheet" href={{asset('css/register.css')}}>
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <title>Registro Uber</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src={{asset('img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>

        <form method="POST" action={{route('uber.cambiarAuto',  ['id' => $idU, "idConductor"=>$idC]) }}>
            @csrf
        @method('PUT')         
            <div class="main_container">
                <h4 class="main_text">Ingresa los</h4>
                <h4 class="main_text">datos de tu vehiculo</h4>
            </div>
    
            <div class="form_container">
                <label class="form_label" for="marca">Marca</label>
                <input class="form_input" type="text" name="marca" required>
                <label class="form_label" for="color">Color</label>
                <input class="form_input" type="text" name="color" required>
                <label class="form_label" for="placa">Placa</label>
                <input class="form_input" type="text" name="placa" required>
                <label class="form_label" for="anio">Año</label>
                <input class="form_input" type="text" name="anio" required>
    
                <label class="form_label" for="tipouber">Tipo de Uber</label>
                <select class="form_input" name="tipouber" required>
                    
                    <!-- Opción por defecto -->
                    <option value="" disabled selected>Selecciona un tipo de Uber</option>
    
                    <!-- Itera sobre los tipos de Uber y genera las opciones -->
                    @foreach ($tiposUber as $tipoUber)
                    <option value="{{ $tipoUber['idTipoUber'] }}">{{ $tipoUber['descripcion'] }}</option>
                    @endforeach
                    
                </select>
                <input type="hidden" name="ubicacion" id="ubicacion">
                <input class="form_input" name="places" type="text" id="places"  placeholder="Ingrese su ubicacion" required>
                <div id="map"></div>
                    <script src="{{ asset('js/map.js') }}"></script>
                    <script async
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi-_zRLxiQp8WgobySwVr3qRX729x0450&libraries=places&callback=initMap">
                    </script>
                </div>
    
            <div class="button_container">
                <button class="form_button_success" type="submit">Cambiar</button>
                <a href="{{ route('conductor.informacion',$idC)}}" class="form_button_back">Volver</a>
            </div>
        </form>

        <div class="description_container">
            <p class="description_text">¿Ya tienes una cuenta?</p>
            <a href={{route('conductor.login')}}><b>Inicia Sesion</b></a>
        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('img/social.svg')}} alt="">
            </div>
        </footer>
    </body>
</html>