function initMap() {
    const lat = parseFloat(datos_mapa.lat);
    const lng = parseFloat(datos_mapa.lng);

    // Validar coordenadas
    if (isNaN(lat) || isNaN(lng)) {
        console.error("Coordenadas no válidas:", datos_mapa);
        return;
    }

    // Configuración inicial del mapa
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: lat, lng: lng }
    });

    // Controlar la visibilidad de la dirección
    if (datos_mapa.visibilidad_direccion === 'direccion_exacta') {
        new google.maps.marker.AdvancedMarkerElement({
            position: { lat: lat, lng: lng },
            map: map,
            title: "Ubicación del inmueble"
        });
    } else if (datos_mapa.visibilidad_direccion === 'solo_calle') {
        const circle = new google.maps.Circle({
            center: { lat: lat, lng: lng },
            radius: 150,
            map: map
        });
        map.fitBounds(circle.getBounds());
    } else if (datos_mapa.visibilidad_direccion === 'ocultar_direccion') {
        const circle = new google.maps.Circle({
            center: { lat: lat, lng: lng },
            radius: 3000,
            map: map
        });
        map.fitBounds(circle.getBounds());
    }
}
