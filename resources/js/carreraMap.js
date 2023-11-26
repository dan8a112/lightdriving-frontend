let map

async function initMap(){

    const { Map } = await google.maps.importLibrary("maps");

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
    

}

initMap();