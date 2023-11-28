let map;

let uberMarkers =[];

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

/**
 * Obtiene el nombre de una ubicacion mediante sus coordenadas
 * @param {*} latlng 
 * @returns 
 */
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

/**
 * Hace una peticion AJAX a la ruta buscarUbersCercanos
 */
function buscarUbers(){

    let formularioBusqueda = document.getElementById('formularioBusqueda');

    let formData = new FormData(formularioBusqueda);

    console.log(formData);

    fetch('/lightdriving-frontend/public/cliente/uberCercanos', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.exito!=null){ //Si existe la llave exito, no se encuentra en zona restringida
            console.log(data);
            generarUberMarkers(data.ubers);
        }else{
            alert(data.mensaje);
        }
    }).catch(error => {
        console.error('Error en la petición:', error);
    });

}

function generarUberMarkers(ubers){

    limpiarMarcadores();

    for(let uber of ubers){

        let lat = uber.lat;
        let lng = uber.lng;

        const coordUber = {lat, lng};

        let iconPath;

        if(uber.tipoUber.idTipoUber == 1){
            iconPath = "../../../resources/img/uberPremium.png";
        }else{
            iconPath = "../../../resources/img/uberStandard.png"
        }

        uberMarker = new google.maps.Marker({
            position: coordUber,
            map,
            icon: iconPath,
        });

        uberMarker.addListener('click', (event)=>{

            let modalUber = new bootstrap.Modal('#carreraModal')
            modalUber.show();

            let nombreApellido = document.getElementById('nombreApellido');
            let marcaColor = document.getElementById('marcaColor');
            let placaUber = document.getElementById('placaUber');
            let telUber = document.getElementById('telUber');
            let tipoUber = document.getElementById('tipoUber');
            let origenCarrera = document.getElementById('origenCarrera');
            let destinoCarrera = document.getElementById('destinoCarrera');
            let totalPagar = document.getElementById('totalPagar');

            nombreApellido.value = `${uber.nombre} ${uber.apellido}`;
            marcaColor.value = `${uber.marca}, ${uber.color}`;
            placaUber.value = `Placa No. ${uber.placa}`;
            telUber.value = `Telefono ${uber.telefono}`;

            tipoUber.value = uber.tipoUber.descripcion;
            origenCarrera.value = document.getElementById("origen").value;
            destinoCarrera.value = document.getElementById("destino").value;

            totalPagar.value = uber.total;
        })

        uberMarkers.push(uberMarker);

    }
}

function limpiarMarcadores(){
    for (let i = 0; i < uberMarkers.length; i++) {
        // Elimina cada marcador del mapa
        uberMarkers[i].setMap(null);
      }
      // Limpia el array de marcadores
      uberMarkers = [];
}

//Boton de buscaUber
let botonBuscarUber = document.getElementById('buscarUbers_button');
botonBuscarUber.addEventListener('click', function (event) {
    buscarUbers();
});

initMap();