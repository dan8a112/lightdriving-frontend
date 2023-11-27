let map;

async function initMap(){

    const { Map } = await google.maps.importLibrary("maps");

    const coordsOrigen = {lat: 14.084745407104492, lng:-87.16206359863281};
    const coordsDestino = {lat: 14.0849808, lng:-87.1640323};

    map = new Map(document.getElementById("map"), {
        center: coordsOrigen,
        zoom: 15,
      });

    //Marcador de origen
    markerOrigen = new google.maps.Marker({
        position: coordsOrigen,
        map,
        draggable: true
    });

    //Marcador de destino
    markerDestino = new google.maps.Marker({
        position: coordsDestino,
        map,
        draggable: true
    });
    
    markerOrigen.addListener('dragend', function(event){
        let latitud = this.getPosition().lat();
        let longitud = this.getPosition().lng();
        document.getElementById("latInicio").value = latitud;
        document.getElementById("lngInicio").value = longitud;

        let latlng = new google.maps.LatLng(latitud,longitud);

        getAdress(latlng).then(function(results) {
            document.getElementById("origen").value = results.formatted_address;
        })
        .catch(function(error) {
            console.error(error);
        });

    });

    markerDestino.addListener('dragend', function(event){

        //toma las coordenadas de el marcador
        let latitud = this.getPosition().lat();
        let longitud = this.getPosition().lng();

        //agrega las coordenadas del marcador a los input no visibles
        document.getElementById("latFinal").value = this.getPosition().lat();
        document.getElementById("lngFinal").value = this.getPosition().lng();
        
        let latlng = new google.maps.LatLng(latitud,longitud); //Crea objeto latlng

        //Llama la funcion getAdress para obtener la direccion
        getAdress(latlng).then(function(results) {
            document.getElementById("destino").value = results.formatted_address;
        })
        .catch(function(error) {
            console.error(error);
        });

    })

}

async function getAdress(latlng){
    const {Geocoder} = await google.maps.importLibrary("geocoding");

    let geocoder = new Geocoder();

    return new Promise((resolve, reject) => {
        geocoder.geocode({'location': latlng}, function(results, status){
            if (status == 'OK') {
                resolve(results[1]);
            } else {
                reject('Geocode no fue exitoso por esta razon: ' + status);
            }
        });
    });
}

function buscarUbers(){

    fetch('/lightdriving-frontend/public/cliente/uberCercanos')
    .then(response => response.json())
    .then(data => {
        console.log(data)
    }).catch(error => {
        console.error('Error en la petición:', error);
    });

}

let botonBuscarUber = document.getElementById('buscarUbers_button');

let formularioBusqueda = document.getElementById('formularioBusqueda');

formularioBusqueda.addEventListener('submit', function (event) {
    event.preventDefault();
    buscarUbers();
});

initMap();