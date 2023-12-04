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
    <link rel="stylesheet" href={{asset('css/cliente.css')}}>
    <title>Bienvenida</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <a class="header_logo" href={{route('home')}}>
                    <img class="icon" src={{asset('img/logo.svg')}} alt="">
                    <h3 class="title">LightDriving</h3>
                </a>
                <a class="header_profile" href={{route('cliente.verPerfil', $cliente->id)}}>
                    <span>{{$cliente->nombre}}</span>
                    <img class="profile_icon" src="{{asset('img/usuarioProfile.png')}}" alt="">
                </a>
            </div>
        </header>
        <div class="main_container">
            <h4 class="main_text">Bienvenido</h4>
            <h4 class="main_text">{{$cliente->nombre." ".$cliente->apellido}}</h4>
        </div>

        <div class="description_container">
            <p class="description_text">¿A donde deseeas ir hoy?</p>
        </div>

        <a href={{route('cliente.carrera', $cliente->id)}} id="add_button" class="add_button">
            <img src={{asset('img/mas.png')}}  alt="mas icon">
        </a>

        <p class="historial_title">Tus viajes</p>
        <div class="historial_container">
            @foreach ($cliente->facturas as $factura)
            <div class="historial_card">
                <section class="info_container">
                    <img class="icon_car" src={{asset('img/carrera.png')}} alt="icono auto">
                    <div class="historial_info">
                        <!--Falta mostrar el id de la carrera!--> 
                        <span class="date_card">{{$factura->fecha}}</span>
                        <p>Total: <strong>L. {{$factura->total}}</strong></p>
                        <p>Metodo: <strong>{{$factura->metodoPago}}</strong></p>
                    </div>    
                </section>
                <div class="historial_mas">
                    <span class="verDetalle_button" data-factura-id='{{$factura->idFactura}}' href="">Ver detalle</span>
                    <p class="carrera_estado" id="{{$factura->idFactura}}">{{$factura->estadoCarrera}}</p>
                </div>
            </div>
            @if ($factura->estadoCarrera=='En progreso')
            <script>
                document.getElementById('{{$factura->idFactura}}').style.color="#d35400"
                document.getElementById('add_button').href="#"
                document.getElementById('add_button').style.backgroundColor = "#424242"
                document.getElementById('add_button').addEventListener('click',()=>alert('Debes completar las carreras pendientes'))
            </script> 
            @endif
            @endforeach
        </div>

        <div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="idCarreraTitulo">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Viajaste con</p>
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
                        <p>Fecha <br><strong id="fechaCarrera">2023-06-12</strong></p>
                        <p>Tipo de uber <br><strong id="tipoUber">Standard</strong></p>
                        <p>Origen <br><strong id="origenCarrera">Universidad Nacional Autonoma de Honduras (UNAH)</strong></p>
                        <p>Destino <br><strong id="destinoCarrera">D1, Tegucigalpa</strong></p>
                        <p>Metodo de pago <br><strong id="metodoPago">Efectivo</strong></p>
                      </div>

                      <div class="total_container">
                        <span class="text_total">Total pagado</span>
                        <span class="total" id="totalPagar">L. 120</span>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('img/social.svg')}} alt="">
            </div>
        </footer>
        <script src={{asset('js/principalCliente.js')}}></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>