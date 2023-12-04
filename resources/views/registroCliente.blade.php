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
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
          key: "AIzaSyAGeaSVON3wEOJxYlP6AuVn3i2K5Rz3468",
          v: "weekly",
          // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
          // Add other bootstrap parameters as needed, using camel case.
        });
      </script>      
    <title>Registro Cliente</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src={{asset('img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>

        <div class="main_container">
            <h4 class="main_text">Ingresa tus</h4>
            <h4 class="main_text">datos personales</h4>
        </div>

        <form method="POST" action={{route('cliente.crear')}}>
            @csrf
            @method('POST')

            <div class="form_container">
                <label class="form_label" for="nombre">Nombre</label>
                <input class="form_input" type="text" name="nombre" required>
                <label class="form_label" for="nombre">Apellido</label>
                <input class="form_input" type="text" name="apellido" required>
                <label class="form_label" for="correo">Correo electronico</label>
                <input class="form_input" type="email" name="correo" required>
                <label class="form_label" for="contrasena">Contraseña</label>
                <input class="form_input" type="password" name="contrasena" required>
                <label class="form_label" for="telefono">Telefono</label>
                <input class="form_input" type="tel" name="telefono" required>
                <label class="form_label" for="fechaNacimiento">Fecha de nacimiento</label>
                <input class="form_input" type="date" name="fechaNacimiento" required>
            </div>
            <div class="form_map">
                <label class="form_label">Ubicacion Actual</label>
                <input class="form_input" type="text" name="ubicacionNombre" id="ubicacionNombre">
                <div id="map"></div>
                <input id="lat" type="hidden" name="lat">
                <input id="lng" type="hidden" name="lng">
            </div>
            

            <div class="button_container">
                <button class="form_button_success">Registrarse</button>
                <a href={{route('home')}} class="form_button_back">Volver</a>
            </div>
            
        </form>
        
        <div class="description_container">
            <p class="description_text">¿Ya tienes una cuenta?</p>
            <a  class="text_link" href={{route('cliente.login')}}><b>Inicia Sesion</b></a>
        </div>
        
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('img/social.svg')}} alt="">
            </div>
        </footer>
        <script src={{asset('js/registerMap.js')}}></script>
    </body>
</html>