<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maps</title>
    <link rel="stylesheet" href="{{ asset('css/mapa.css') }}">
    
</head>
<body>
    Hola
    <div id="map"></div>
    
    <script src="{{ asset('js/map.js') }}"></script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi-_zRLxiQp8WgobySwVr3qRX729x0450&callback=initMap">
    </script>
    
    
    
</body>
</html>
