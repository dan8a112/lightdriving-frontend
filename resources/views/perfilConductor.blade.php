<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('css/reset.css')}}>
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <link rel="stylesheet" href={{asset('css/profileConductor.css')}}>
    <title>Informacion Cliente</title>
</head>
    <header>
        <div class="header_container">
            <a class="backbutton" href="{{ route('conductor.informacion',$historico->idConductor)}}" class="form_button_back">Volver</a>
            <h3 class="title">Perfil</h3>
        </div>
    </header>
    <body>
        <div class="photo_container">
            <img class="profile_photo" src="{{asset('img/uberProfileXL.png')}}" alt="">
        </div>

        <div class="info_container">
            <p>{{$historico->nombre}} {{$historico->apellido}}</p>
        </div>

        <p>Vehiculo Actual</p>
        <div class="car_container">
            <section class="car_card">
                
                <img class="icon_car" src={{asset('img/carro.png')}} alt="icono auto">
                <div class="car_info_container">
                    <div class="car_info">
                        <div class="info_item1">
                            <p><span class="bold">Marca: </span><span>{{$historico->uberActual->marca}}</span></p>
                            <p><span class="bold">Color: </span><span>{{$historico->uberActual->color}}</span></p>
                            <p><span class="bold">Placa: </span><span>{{$historico->uberActual->placa}}</span></p>
                        </div>
                        <div class="info_item2">
                            <p><span class="bold">Año: </span><span>{{$historico->uberActual->anio}}</span></p>
                            <p><span class="bold">Desde: </span><span>{{$historico->uberActual->fechaInicio}}</span></p>
                        </div>
                    </div>
                </div> 
            </section>
            <a class="cambiarAuto_button" href="{{ route('uber.cambiar', ['idUber' => $conductor->idUber,'idConductor' => $historico->idConductor] ) }}">Cambiar Auto</a>   
        </div>
        
        <p>Historico vehiculos</p>

        @foreach($historico->historicoUbers as $histoUber)
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$histoUber->idHistorico}}
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <section class="car_card">
                    <img class="icon_car" src={{asset('img/carro.png')}} alt="icono auto">
                    <div class="car_info_container">
                        <div class="car_info">
                            <p><span class="bold">Marca: </span><span>{{$histoUber->marca}}</span></p>
                            <p><span class="bold">Color: </span><span>{{$histoUber->color}}</span></p>
                            <p><span class="bold">Placa: </span><span>{{$histoUber->placa}}</span></p>
                            <p><span class="bold">Año: </span><span>{{$histoUber->anio}}</span></p>
                            <p><span class="bold">Desde: </span><span>{{$histoUber->fechaInicio}}</span></p>
                            <p><span class="bold">Hasta: </span><span>{{$histoUber->fechaFinal}}</span></p>
                        </div>
                    </div>    
                </section>              
              </div>
            </div>
        </div>
        @endforeach




          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>