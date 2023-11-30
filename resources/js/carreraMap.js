let map;
const origenInput = document.getElementById('origen');
const destinoInput = document.getElementById('destino');
let uberMarkers =[];

async function initMap(){

    const { Map } = await google.maps.importLibrary("maps");
    const { Place } = await google.maps.importLibrary("places");

    let origenUsuario = parseFloat(document.getElementById("latInicio").value);
    let destinoUsuario = parseFloat(document.getElementById("lngInicio").value);

    const coordsOrigen = {lat: origenUsuario, lng: destinoUsuario};
    const coordsDestino = {lat: 14.0849808, lng:-87.1640323};

    map = new Map(document.getElementById("map"), {
        center: coordsOrigen,
        zoom: 15,
      });

    //Marcador de origen
    markerOrigen = new google.maps.Marker({
        position: coordsOrigen,
        map,
        draggable: true,
        icon:'../../../resources/img/origenMarker.png'
    });

    //Marcador de destino
    markerDestino = new google.maps.Marker({
        position: coordsDestino,
        map,
        draggable: true,
        icon:'../../../resources/img/destinoMarker.png'
    });


    //Autocompletado de direccion de origen
    let autocompleteOrigen = new google.maps.places.Autocomplete(origenInput);
    autocompleteOrigen.addListener('place_changed', ()=>{
        let place = autocompleteOrigen.getPlace();
        map.setCenter(place.geometry.location);
        markerOrigen.setPosition(place.geometry.location)
    })

    //Autocompletado de direccion de origen
    let autocompleteDestino = new google.maps.places.Autocomplete(destinoInput);
    autocompleteDestino.addListener('place_changed', ()=>{
        let place = autocompleteDestino.getPlace();
        map.setCenter(place.geometry.location);
        markerDestino.setPosition(place.geometry.location)
    })

    //Evento de cambiar direccion
    markerOrigen.addListener('dragend', function(event){
        let latitud = this.getPosition().lat();
        let longitud = this.getPosition().lng();
        document.getElementById("latInicio").value = latitud;
        document.getElementById("lngInicio").value = longitud;

        let latlng = new google.maps.LatLng(latitud,longitud);

        getAdress(latlng).then(function(results) {
            origenInput.value = results.formatted_address;
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
            destinoInput.value = results.formatted_address;
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


/**
 * Genera los marcadores de los ubers
 * @param {*} ubers 
 */
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

            let idConductor = document.getElementById('idConductor'); //Input oculto idConductor
            idConductor.value = uber.idConductor;

            let nombreApellido = document.getElementById('nombreApellido');
            let marcaColor = document.getElementById('marcaColor');
            let placaUber = document.getElementById('placaUber');
            let telUber = document.getElementById('telUber');
            let tipoUber = document.getElementById('tipoUber');
            let origenCarrera = document.getElementById('origenCarrera');
            let destinoCarrera = document.getElementById('destinoCarrera');
            let totalPagar = document.getElementById('totalPagar');
            

            nombreApellido.textContent = `${uber.nombre} ${uber.apellido}`;
            marcaColor.textContent = `${uber.marca}, ${uber.color}`;
            placaUber.textContent = `Placa No. ${uber.placa}`;
            telUber.textContent = `Telefono ${uber.telefono}`;

            tipoUber.textContent = uber.tipoUber.descripcion;
            origenCarrera.textContent = document.getElementById("origen").value;
            destinoCarrera.textContent = document.getElementById("destino").value;

            totalPagar.textContent = `L. ${uber.total}`;

        })
        uberMarkers.push(uberMarker);
    }
}

/**
 * Hace una peticion AJAX a la ruta de crear facturas
 */
function crearCarrera(){

    let formularioBusqueda = document.getElementById('formularioBusqueda');

    let formData = new FormData(formularioBusqueda);

    let idMetodoPago = document.getElementById('metodoPago_select');
    let ubicacionInicial = document.getElementById('origen').value;
    let ubicacionFinal = document.getElementById('destino').value;

    formData.append("idMetodoPago",idMetodoPago.value);
    formData.append("ubicacionInicial", ubicacionInicial);
    formData.append("ubicacionFinal", ubicacionFinal);

    fetch('/lightdriving-frontend/public/cliente/crearCarrera', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    }).then(response=>response.json())
    .then(data => {
        console.log(data.state);
        if(data.state){
            window.location.href = '/lightdriving-frontend/public/cliente/main/' + data.id;
        }else{
            alert('No se pudo crear la carrera, intentelo de nuevo');
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
    
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

//Boton de crear carrera
let botonCrearCarrera = document.getElementById('crearCarrera-button');
botonCrearCarrera.addEventListener('click', function (event) {
    crearCarrera();
});

initMap();