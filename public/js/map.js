// script.js
const argCoords = { lat: 14.085278, lng: -87.163056 };
const mapDiv = document.getElementById("map");
const lugares = document.getElementById("places");
let map;
let marker;
let autoComplete;

function initMap() {
    // Se inicializa el mapa con el centro en argCoords
    map = new google.maps.Map(mapDiv, {
        center: argCoords,
        zoom: 14,
    });

    // Se coloca un marcador en la posición inicial (argCoords)
    marker = new google.maps.Marker({
        position: argCoords,
        map: map,
        title: "Hello World!",
        draggable: true
    });

    // Se inicia la funcionalidad de autocompletado
    initAutocomplete();
}

function initAutocomplete() {
    // Se crea el objeto de autocompletado para el campo de lugares
    autoComplete = new google.maps.places.Autocomplete(lugares);
    autoComplete.addListener("place_changed", function () {
        // Se obtiene la información del lugar seleccionado
        const place = autoComplete.getPlace();

        // Se verifica si hay geometría en el lugar
        if (!place.geometry || !place.geometry.location) {
            return; // Si no hay geometría en el lugar, no hacemos nada
        }

        // Se actualiza el centro del mapa y la posición del marcador con la nueva ubicación
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);
    });
}

// Función para obtener la ubicación del conductor y enviar el formulario
function obtenerUbicacion() {
    // Se obtiene la información del lugar seleccionado
    const place = autoComplete.getPlace();
    const nombreLugar = lugares.value;
    // Se verifica si hay geometría en el lugar
    if (!place.geometry || !place.geometry.location) {
        console.error('No se ha seleccionado un lugar válido.');
        return;
    }

    // Se obtienen la latitud y longitud del lugar
    const latitud = place.geometry.location.lat();
    const longitud = place.geometry.location.lng();
    

    // Crear un campo oculto en el formulario y asignarle los valores
    const ubicacionInput = document.createElement('input');
    ubicacionInput.type = 'hidden';
    ubicacionInput.name = 'ubicacion';
    ubicacionInput.value = JSON.stringify({ latitud, longitud });

    // Agregar el campo oculto al formulario
    document.querySelector('form').appendChild(ubicacionInput);

    // También puedes hacer log de la información si lo necesitas
    console.log('Latitud:', latitud);
    console.log('Longitud:', longitud);
    console.log('Nombre del lugar:', nombreLugar);
}

// Agrega un evento al formulario para ejecutar obtenerUbicacion antes de enviar el formulario
document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita el envío normal del formulario
    obtenerUbicacion(); // Llama a la función para obtener la ubicación
    this.submit(); // Envía el formulario después de obtener la ubicación
});
