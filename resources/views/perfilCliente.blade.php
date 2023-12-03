<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{asset('../resources/css/reset.css')}}>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('../resources/css/app.css')}}>
    <link rel="stylesheet" href={{asset('../resources/css/profile.css')}}>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
          key: "AIzaSyAGeaSVON3wEOJxYlP6AuVn3i2K5Rz3468",
          v: "weekly",
          // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
          // Add other bootstrap parameters as needed, using camel case.
        });
      </script>   
    <title>Informacion Cliente</title>
</head>
    <header>
        <div class="header_container">
            <a class="backbutton" href={{route('cliente.principal', $cliente->idCliente)}}>Volver</a>
            <h3 class="title">Perfil</h3>
        </div>
    </header>
    <body>
        <div class="photo_container">
            <img class="profile_photo" src="{{asset('img/usuarioProfileXL.png')}}" alt="">
        </div>
        <div>
            <form method="POST" action={{route('cliente.crear')}} @readonly(true)>
                @csrf
                @method('POST')
                <div class="form_container">
                    <label class="form_label" for="nombre">Nombre</label >
                    <input class="form_input" type="text" name="nombre" value={{$cliente->nombre}} required readonly>
                    <label class="form_label" for="nombre">Apellido</label>
                    <input class="form_input" type="text" name="apellido" value={{$cliente->apellido}} required readonly>
                    <label class="form_label" for="correo">Correo electronico</label>
                    <input class="form_input" type="email" name="correo" value={{$cliente->correo}} required readonly>
                    <label class="form_label" for="contrasena">Contraseña</label>
                    <input class="form_input" type="password" name="contrasena" value={{$cliente->contrasena}} required readonly>
                    <label class="form_label" for="telefono">Telefono</label>
                    <input class="form_input" type="tel" name="telefono" value={{$cliente->telefono}} required readonly>
                    <label class="form_label" for="fechaNacimiento">Fecha de nacimiento</label>
                    <input class="form_input" type="date" name="fechaNacimiento" value={{$cliente->fechaNacimiento}} required readonly>
                </div>
                <div class="form_map">
                    <label class="form_label" >Ubicacion Actual</label>
                    <input class="form_input" type="text" name="ubicacionNombre" id="ubicacionNombre" value={{$cliente->ubicacionNombre}}>
                    <div id="map"></div>
                    <input id="lat" type="hidden" name="lat" value={{$cliente->lat}}>
                    <input id="lng" type="hidden" name="lng" value={{$cliente->lng}}>
                </div>
                <div class="button_container">
                    <button class="form_button_success" hidden>Enviar</button>
                    <button type="button" class="form_button_success">Editar Informacion</button>
                </div>
            </form>
        </div>
        <script src={{asset('../resources/js/registerMap.js')}}></script>
    </body>
</html>