let map;
const latitud = document.getElementById("lat");
const longitud = document.getElementById("lng");


async function initMap(){

    const { Map } = await google.maps.importLibrary("maps");
    const { Place } = await google.maps.importLibrary("places");

    const coords = {lat: 14.084745407104492, lng:-87.16206359863281};

    map = new Map(document.getElementById("map"), {
        center: coords,
        zoom: 15,
      });

    marker = new google.maps.Marker({
        position: coords,
        map,
        draggable: true
    });
    
    marker.addListener('dragend', function(event){
        latitud.value = this.getPosition().lat();
        longitud.value = this.getPosition().lng();
    })

    const inputNombre = document.getElementById('ubicacionNombre');

    let autocomplete = new google.maps.places.Autocomplete(inputNombre, {componentRestrictions: { country: "hn" }});
    autocomplete.addListener('place_changed', ()=>{
        let place = autocomplete.getPlace();
        let coord = place.geometry.location.toJSON();
        map.setCenter(coord);
        marker.setPosition(coord);
        latitud.value = coord.lat;
        longitud.value = coord.lng;
    })

}

initMap();