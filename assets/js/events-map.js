function initMap() {
    const mapElement = document.getElementById("map");

    if (!mapElement) {
        return;
    }

    const map = new google.maps.Map(mapElement, {
        center: {lat: 50.0755, lng: 14.4378}, // Default center (Prague)
        zoom: 8,
    });

    document.querySelectorAll(".event-map").forEach((eventMap) => {
        const lat = parseFloat(eventMap.getAttribute("data-lat"));
        const lng = parseFloat(eventMap.getAttribute("data-lng"));

        if (!isNaN(lat) && !isNaN(lng)) {
            new google.maps.Marker({
                position: {lat, lng},
                map: map,
                title: "Event Location",
            });

            map.setCenter({lat, lng});
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    if (typeof google !== "undefined") {
        initMap();
    }
});