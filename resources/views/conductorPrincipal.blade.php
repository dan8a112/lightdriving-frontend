<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('css/reset.css')}}>
    <link rel="stylesheet" href={{asset('css/login.css')}}>
    <link rel="stylesheet" href={{asset('css/cliente.css')}}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('css/cliente.css')}}>
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
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
            <h4 class="main_text">{{$conductor->nombre." ".$conductor->apellido."" }} 
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Mas opciones
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        
                      <li><a class="dropdown-item" id="btn_info" data-bs-toggle="modal" data-bs-target="#info" data-id-Conductor="{{$conductor->idConductor}}" href="">Auto actual</a></li>
                      <li><a class="dropdown-item" href="{{ route('uber.cambiar', ['id' => $conductor->idConductor]) }}">Cambiar Auto</a></li>
                      <li><a class="dropdown-item" id="btn_historial" data-bs-toggle="modal" data-bs-target="#info_historial" data-id-Conducto="{{$conductor->idConductor}}" href="">Historial de autos</a></li>
                    </ul>
                  </div>
        <p class="historial_title">Carrera en Curso</p>
        
        <div class="">
            @if ($conductor->carreraEnProgreso)
                <div class="historial_card">
                    <section class="info_container">
                        <img class="icon_car" src="{{ asset('img/carrera.png') }}" alt="icono auto">
                            <div class="historial_info">
                                <span>Cliente: {{ $conductor->carreraEnProgreso->cliente->nombre }} {{ $conductor->carreraEnProgreso->cliente->apellido }}</span>
                                <span class="date_card">Fecha: {{ $conductor->carreraEnProgreso->factura->fecha }}</span>
                                <span>Método: {{ $conductor->carreraEnProgreso->factura->metodoPago->descripcion }}</span>
                                <span>Total: {{ $conductor->carreraEnProgreso->factura->total }}</span>
                            </div>

                    </section>
                    <div class="historial_mas">
                        <a href="{{ route('conductor.finalizar', ['idConductor' => $conductor->idConductor, 'idCarrera' => $conductor->carreraEnProgreso->idCarrera]) }}">Finalizar Carrera</a>

                            
                    </div>
                </div>
                    @else
                        <p>No hay carrera en curso en este momento.</p>
                    @endif
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
                        <div class="ubercard_container">
                            <img class="uber_img" src={{asset('img/uberProfile.png')}} alt="">
                            <div class="uberinfo_container">
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
        <!--------------------------------------------------------------------------------------------------------->
        
<!-- Modal -->
<div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Información del Auto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="marca"></div>
            <div id="color"></div>
            <div id="placa"></div>
            <div id="anio"></div>
            <div id="fechaInicio"></div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!------MODAL TOTAL------>
 
  <div class="modal fade" id="info_historial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información de los autos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="nombreApellidoTotal"></div>
                <h5 class="modal-title" id="exampleModalLabel">Informacion del auto actual</h5>
                <div id="uberActualTotal"></div>
                <div id="marcaTotal"></div>
                <div id="colorTotal"></div>
                <div id="placaTotal"></div>
                <div id="anioTotal"></div>
                <div id="fechaInicioTotal"></div>
                <div id="fechaFinalTotal"></div>
                <h5 class="modal-title" id="exampleModalLabel">Historial Autos</h5>
                <div id="uberActualHistorial"></div>
                <div id="marcaHistorial"></div>
                <div id="colorHistorial"></div>
                <div id="placaHistorial"></div>
                <div id="anioHistorial"></div>
                <div id="fechaInicioHistorial"></div>
                <div id="fechaFinalHistorial"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        <div class="historial_card">
            <div class="button_container">
                <a href="{{route('conductor.login')}}" class="form_button_back" >Cerrar sesion</a>
            </div>
            

        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('img/social.svg')}} alt="">
            </div>
        </footer>

        <!-- Incluye Bootstrap JS antes de tu script --><!-- Incluye Bootstrap JS antes de tu script -->
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src={{asset('js/historico.js')}}></script>
<script src={{asset('js/historicoTotal.js')}}></script>
<script src={{asset('js/principalConductor.js')}}></script>

    </body>
</html>