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
    <link rel="stylesheet" href={{asset('css/login.css')}}>
    <link rel="stylesheet" href={{asset('css/conductor.css')}}>
    <link rel="stylesheet" href={{asset('css/app.css')}}>    
    <title>Bienvenida</title>
</head>
    <body>
        <header>
            <div class="header_container">
                <a class="header_logo" href={{route('home')}}>
                    <img class="icon" src={{asset('img/logo.svg')}} alt="">
                    <h3 class="title">LightDriving</h3>
                </a>
                <a class="header_profile" href="{{ route('conductor.verPerfil', ['idConductor' => $conductor->idConductor, 'idUber' => $conductor->idUber]) }}">
                    <span>{{$conductor->nombre}}</span>
                    <img class="icon_profile" src="{{asset('img/uberProfile.png')}}" alt="">
                </a>
            </div>
        </header>

        <div class="main_container">
            <h4 class="main_text">Bienvenido</h4>
            <h4 class="main_text">{{$conductor->nombre." ".$conductor->apellido."" }}</h4>

        <p class="historial_title">Carrera en Curso</p>
        
        <div class="actual_container">
            @if ($conductor->carreraEnProgreso)
                <div class="actual_card">
                    <img class="actual_icon" src="{{ asset('img/carreraCurso.png') }}" alt="icono auto">
                    <section class="actual_info">
                        <div class="actual_text">
                            <span class="date_card">{{ $conductor->carreraEnProgreso->factura->fecha }}</span>
                            <span><span class="negrita">Cliente: </span>{{ $conductor->carreraEnProgreso->cliente->nombre }} {{ $conductor->carreraEnProgreso->cliente->apellido }}</span>
                            <span><span class="negrita">Método: </span>{{ $conductor->carreraEnProgreso->factura->metodoPago->descripcion }}</span>
                            <span><span class="negrita">Total: </span>L. {{ $conductor->carreraEnProgreso->factura->total }}</span>
                        </div>
                    </section>
                    <a class="finalizarCarrera_button" href="{{ route('conductor.finalizar', ['idConductor' => $conductor->idConductor, 'idCarrera' => $conductor->carreraEnProgreso->idCarrera]) }}">Finalizar</a>
                </div>
            @else
                <p>No hay carreras en curso en este momento.</p>
            @endif
        </div>

        <p class="historial_title">Tus viajes</p>

        <div class="historial_container">
            @foreach ($conductor->facturas as $factura)
            <div class="historial_card">
                <section class="info_container">
                    <img class="icon_car" src={{asset('img/carreraConductor.png')}} alt="icono auto">
                    <div class="historial_info">
                        <span class="date_card">{{$factura->fecha}}</span>
                        <span>Total: L. {{$factura->total}}</span>
                        <span>Metodo: {{$factura->metodoPago}}</span>
                    </div>    
                </section>
                <div class="historial_mas">
                    <span class="verDetalle_button" data-factura-id='{{$factura->carrera}}' href="">Ver detalle</span>
                    <p class="carrera_estado" id={{$factura->idFactura}}>{{$factura->estadoCarrera}}</p>
                </div>
            </div>
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
                        <div class="usercard_container">
                            <img class="user_img" src={{asset('img/usuarioProfile.png')}} alt="">
                            <div class="userinfo_container">
                            <span id="nombreApellido" class="text_name"></span>
                            <span id="telefono" class="text_info"></span>
                            </div>
                          </div>
        
                          <div class="serviceinfo_container">
                            <p>Fecha <br><strong id="fechaCarrera"></strong></p>
                            <p>Origen <br><strong id="origenCarrera"></strong></p>
                            <p>Destino <br><strong id="destinoCarrera"></strong></p>
                            <p>Metodo de pago <br><strong id="metodoPago"></strong></p>
                          </div>
    
                          <div class="total_container">
                            <span class="text_total">Total pagado</span>
                            <span class="total" id="totalPagar"></span>
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src={{asset('js/principalConductor.js')}}></script>
    </body>
</html>