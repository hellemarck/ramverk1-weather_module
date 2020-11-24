<!-- MAP CREATED WITH LEAFLET AND OPENSTREETMAP -->
<!-- MODULE TO REUSE -->

<script>

var map = L.map('map', {
    center: [latitude, longitude],
    minZoom: 2,
    zoom: 8
})

L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo( map )


L.marker([latitude, longitude]).addTo(map);

</script>
