function initMap() {
    // Crea un nuevo mapa de Google
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng)}
    });

    // Añade un marcador o un círculo al mapa dependiendo de la visibilidad de la dirección
    if (datos_mapa.visibilidad_direccion === 'direccion_exacta') {
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng)},
            map: map
        });
    } else if (datos_mapa.visibilidad_direccion === 'solo_calle') {
        var circle = new google.maps.Circle({
            center: {lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng)},
            radius: 150,
            map: map
        });
        map.fitBounds(circle.getBounds());
    } else if (datos_mapa.visibilidad_direccion === 'ocultar_direccion') {
        var circle = new google.maps.Circle({
            center: {lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng)},
            radius: 3000,
            map: map
        });
        map.fitBounds(circle.getBounds());
    }
}