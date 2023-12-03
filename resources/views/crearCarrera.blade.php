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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <link rel="stylesheet" href={{asset('css/carrera.css')}}>
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
                <a class="backbutton" href={{route('cliente.principal', $id)}}>Volver</a>
                <img class="icon" src={{asset('img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>
        
        <div id="map" class="map"></div>
        
        <div class="form_container">
            <section class="direccion_container">
                <img src={{asset('img/origen.png')}} alt="">
                <input id="origen" class="input_carrera" type="text" placeholder="Origen" value='{{$coordenadas->ubicacionNombre}}'>
            </section>
            <section class="direccion_container">
                <img src={{asset('img/destino.png')}} alt="">
                <input id="destino" class="input_carrera" type="text" placeholder="Destino">
            </section>
            
            <form id="formularioBusqueda" method="POST">
                @csrf
                @method('POST')
                <input id="idUsuario" name="idCliente" type="hidden" value={{$id}}>
                <input id="idConductor" name="idConductor" type="hidden">
                <input id="latInicio" name="latInicio"type="hidden" value={{$coordenadas->lat}}>
                <input id="latFinal" name="latFinal"type="hidden">
                <input id="lngInicio" name="lngInicio" type="hidden" value={{$coordenadas->lng}}>
                <input id="lngFinal" name="lngFinal" type="hidden">
                <button type="button" id="buscarUbers_button" class="form_button_success">Encontrar conductores</button>
            </form>

        </div>

        <div class="modal fade" id="carreraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="main_text">Confirma tu carrera</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="ubercard_container">
                    <img class="uber_img" src={{asset('img/uberProfile.png')}} alt="">
                    <div class="uberinfo_container">
                      <span id="nombreApellido" class="text_name">Carlos Ochoa</span>
                      <span id="marcaColor" class="text_info">Honda Civic, Blanco</span>
                      <span id="placaUber" class="text_info">Placa: HDO-2304</span>
                      <span id="telUber" class="text_info">Tel: 94832396</span>
                    </div>
                  </div>

                  <div class="serviceinfo_container">
                    <p>Tipo uber <br><strong id="tipoUber">Standard</strong></p>
                    <p>Origen <br><strong id="origenCarrera">Universidad Nacional Autonoma de Honduras (UNAH)</strong></p>
                    <p>Destino <br><strong id="destinoCarrera">D1, Tegucigalpa</strong></p>
                  </div>

                  <div class="select_container">
                    <p>Metodo de pago</p>
                    <select name="metodoPago" id="metodoPago_select" required>
                      <option value="1">Efectivo</option>
                      <option value="2">Transferencia</option>
                    </select>
                  </div>

                  <div class="total_container">
                    <span class="text_total">Total a pagar</span>
                    <span class="total" id="totalPagar"></span>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button id="crearCarrera-button" type="button" class="btn btn-primary">confirmar Carrera</button>
                </div>
              </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src={{asset('js/carreraMap.js')}}></script>
    </body>
</html>