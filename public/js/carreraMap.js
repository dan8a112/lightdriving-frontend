let map;

//Referencia a los inputs de la ubicacion en palabras
const origenInput = document.getElementById('origen');
const destinoInput = document.getElementById('destino');

//Referencia a los inputs ocultos de coordenadas de inicio
const latInicio = document.getElementById("latInicio");
const lngInicio = document.getElementById("lngInicio");

//Referencia a los inputs ocultos de coordenadas de final
const latFinal = document.getElementById("latFinal");
const lngFinal = document.getElementById("lngFinal");

//Referencia a los marcadores de los ubers
let uberMarkers =[]; 

async function initMap(){

    //Importa las librerias Map y Place de la API de google
    const { Map } = await google.maps.importLibrary("maps");
    const { Place } = await google.maps.importLibrary("places");

    let inicio = parseFloat(latInicio.value);
    let final = parseFloat(lngInicio.value);

    const coordsOrigen = {lat: inicio, lng: final}; //Se establecen las ultimas coordenadas del usuario
    const coordsDestino = {lat: 14.0849808, lng:-87.1640323};

    //Mapa
    map = new Map(document.getElementById("map"), {
        center: coordsOrigen,
        zoom: 15,
      });

    //Marcador de origen
    markerOrigen = new google.maps.Marker({
        position: coordsOrigen,
        map,
        draggable: true,
        icon:'../../img/origenMarker.png'
    });

    //Marcador de destino
    markerDestino = new google.maps.Marker({
        position: coordsDestino,
        map,
        draggable: true,
        icon:'../../img/destinoMarker.png'
    });


    //Autocompletado de direccion de origen
    let autocompleteOrigen = new google.maps.places.Autocomplete(origenInput,{componentRestrictions: { country: "hn" }});
    autocompleteOrigen.addListener('place_changed', ()=>{
        let place = autocompleteOrigen.getPlace();
        let coord = place.geometry.location.toJSON();
        map.setCenter(coord);
        markerOrigen.setPosition(coord);
        latInicio.value = coord.lat;
        lngInicio.value = coord.lng;
    })

    //Autocompletado de direccion de origen
    let autocompleteDestino = new google.maps.places.Autocomplete(destinoInput,{componentRestrictions: { country: "hn" }});
    autocompleteDestino.addListener('place_changed', ()=>{
        let place = autocompleteDestino.getPlace();
        let coord = place.geometry.location.toJSON();
        map.setCenter(coord);
        markerDestino.setPosition(coord);
        latFinal.value = coord.lat;
        lngFinal.value = coord.lng;
    })

    /**
     * Eventos para cambiar direccionesde inicio y final cuando el marker cambi
     */
    markerOrigen.addListener('dragend', function(event){
        let latitud = this.getPosition().lat();
        let longitud = this.getPosition().lng();
        latInicio.value = latitud;
        lngInicio.value = longitud;

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
        latFinal.value = this.getPosition().lat();
        lngFinal.value = this.getPosition().lng();
        
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

    fetch('/lightdriving-frontend/public/cliente/uberCercanos', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.exito){ //Si exito es true no esta en zona restringida
            alert(data.mensaje);
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

        //Obtiene coordenadas
        let lat = uber.lat;
        let lng = uber.lng;

        const coordUber = {lat, lng}; //Crea objeto latlng

        let iconPath;

        //Si el uber es premium o standard
        if(uber.tipoUber.idTipoUber == 1){ 
            iconPath = "../../img/uberPremium.png";
        }else{
            iconPath = "../../img/uberStandard.png"
        }

        //Crea marcador
        uberMarker = new google.maps.Marker({
            position: coordUber,
            map,
            icon: iconPath,
        });

        //Cuando se da click sobre un uber se abre modal
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

    let formData = new FormData(formularioBusqueda); //Saca los datos del formulario

    let idMetodoPago = document.getElementById('metodoPago_select');
    let ubicacionInicial = document.getElementById('origen').value;
    let ubicacionFinal = document.getElementById('destino').value;

    //Agrega estos datos al formulario
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

/**
 * Reinicia los marcadores
 */
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