function initMap() {
    // Crear un nuevo mapa de Google centrado en las coordenadas especificadas
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng) }
    });

    // Verifica el tipo de visibilidad para configurar el marcador o círculo
    if (datos_mapa.visibilidad_direccion === 'direccion_exacta') {
        // Usar el marcador clásico
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng) },
            map: map,
            title: "Ubicación Exacta"
        });
    } else if (datos_mapa.visibilidad_direccion === 'solo_calle') {
        // Crear un círculo pequeño para representar la ubicación
        var circle = new google.maps.Circle({
            center: { lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng) },
            radius: 150, // Radio en metros
            map: map,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2
        });
        map.fitBounds(circle.getBounds());
    } else if (datos_mapa.visibilidad_direccion === 'ocultar_direccion') {
        // Crear un círculo más grande para ocultar detalles exactos
        var circle = new google.maps.Circle({
            center: { lat: parseFloat(datos_mapa.lat), lng: parseFloat(datos_mapa.lng) },
            radius: 3000, // Radio en metros
            map: map,
            fillColor: '#0000FF',
            fillOpacity: 0.2,
            strokeColor: '#0000FF',
            strokeOpacity: 0.5,
            strokeWeight: 1
        });
        map.fitBounds(circle.getBounds());
    }
}
