<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        #mapid { height: 400px; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>WebGIS Dashboard - TPA Bogor</h2>
        <div id="mapid"></div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('mapid').setView([-6.597147, 106.806039], 13); // Koordinat untuk Kota Bogor
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Contoh marker, asumsi kita memiliki data dari backend
        // L.marker([-6.597147, 106.806039]).addTo(map)
        //    .bindPopup('TPA Bogor<br> Informasi TPA.');

        // Ini adalah tempat Anda akan menambahkan integrasi untuk Algoritma Dijkstra atau fetch data TPA dari backend.
    </script>
</body>
</html>
