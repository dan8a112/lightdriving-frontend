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
    <link rel="stylesheet" href={{asset('../resources/css/app.css')}}>
    <link rel="stylesheet" href={{asset('../resources/css/carrera.css')}}>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
          key: "AIzaSyAGeaSVON3wEOJxYlP6AuVn3i2K5Rz3468",
          v: "weekly",
          // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
          // Add other bootstrap parameters as needed, using camel case.
        });
      </script>
    <title>Nueva Carrera</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src={{asset('../resources/img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>

        <div id="map" class="map"></div>

        <div class="form_container">
            <section class="direccion_container">
                <img src={{asset('../resources/img/origen.png')}} alt="">
                <input class="input_carrera" type="text" placeholder="Origen" readonly>
            </section>
            <section class="direccion_container">
                <img src={{asset('../resources/img/destino.png')}} alt="">
                <input class="input_carrera" type="text" placeholder="Destino" readonly>
            </section>
            
            <form action="">
                <input type="hidden">
                <input type="hidden">
                <button class="form_button_success">Encontrar conductores</button>
            </form>
        </div>

        <script src={{asset('../resources/js/carreraMap.js')}}></script>

    </body>
</html>