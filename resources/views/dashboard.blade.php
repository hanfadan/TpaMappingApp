<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPA Navigator Bogor Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AdminLTE and Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <!-- Leaflet Control Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <style>
        body {
            background-color: #f4f6f9;
        }
        .main-sidebar {
            background-color: #16a085;
            transition: width 0.3s ease-in-out;
        }
        .nav-link {
            color: white !important;
            font-size: 16px;
        }
        .nav-link:hover {
            background-color: #c9c5c5 !important;
        }
        .nav-icon {
            margin-right: 10px;
        }
        .content-wrapper {
            margin-left: 250px !important;
            width: calc(100% - 250px) !important;
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        .content-wrapper.content-collapsed {
            margin-left: 60px !important;
            width: calc(100% - 60px) !important;
        }

        .sidebar-collapsed {
            width: 60px !important;
            overflow-x: hidden;
        }
        .sidebar-collapsed .nav-link p {
            display: none;
        }
        .sidebar-collapsed .nav-icon {
            margin-right: 0;
            display: flex;
            justify-content: center;
        }
        .brand-link {
            background-color: #1abc9c;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 10px;
        }
        .brand-link h4 {
            margin: 0;
            padding: 10px;
            color: white;
            transition: opacity 0.3s ease-in-out;
        }
        .sidebar-collapsed .brand-link h4 {
            opacity: 0;
        }
        .toggle-sidebar-btn {
            position: absolute;
            top: 20px;
            right: 10px;
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
            transition: right 0.3s ease-in-out;
        }
        .map-view {
            height: 700px;
            background-color: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 8px;
            position: relative;
        }
        .summary-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .custom-tooltip {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .custom-tooltip .route-title {
            font-weight: bold;
            font-size: 18px;
            color: #f57c00;
            margin-bottom: 5px;
        }

        .custom-tooltip .route-subtitle {
            color: #555;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .custom-tooltip .route-step {
            padding: 5px 0;
            display: flex;
            align-items: flex-start;
        }

        .custom-tooltip .step-icon {
            margin-right: 10px;
        }

        .custom-tooltip .step-text {
            flex: 1;
        }

        .route-instructions-panel {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2); /* Perbesar bayangan */
            width: 300px;
            z-index: 2000; /* Tingkatkan z-index */
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            max-height: 400px; /* Batasi tinggi panel */
            overflow-y: auto; /* Tambahkan scroll jika konten terlalu panjang */
            background: white;
        }

        .input-container {
            margin: 10px 0;
        }

        .input-container label {
            margin-right: 10px;
        }

        .input-container input {
            width: calc(100% - 150px);
        }

        .leaflet-routing-container {
    display: none !important;
}

/* Tambahkan gaya tombol */
.search-btn {
    background-color: #16a085;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-btn:hover {
    background-color: #138f75;
}

/* Gaya untuk input search */
.search-input {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    width: calc(100% - 150px);
    margin-right: 10px;
}

.search-container {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}


    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar">
            <div class="brand-link d-flex justify-content-between align-items-center">
                <h4>TPA Navigator Bogor</h4>
                <button id="toggle-btn" class="toggle-sidebar-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#summary" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Summary</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#bookmarks" class="nav-link">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>Bookmarks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#map" class="nav-link">
                                <i class="nav-icon fas fa-map"></i>
                                <p>Map View</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input for coordinates and search -->
            <div class="container-fluid">
                <div class="row input-container">
                <div class="search-container">
    <input type="text" id="search-location" class="search-input" placeholder="Masukkan Koordinat Lokasi Awal">
    <button class="search-btn" onclick="searchLocation(); findNearestTPS();">Cari Terdekat</button>
</div>


                </div>
            </div>

            <!-- Map and Instructions Panel -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="map-view">
                                <h5>Map View</h5>
                                <div id="mapid" style="height: 100%;"></div>
                                <div id="route-instructions-panel" class="route-instructions-panel"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Load Leaflet JS first -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Load Leaflet Routing Machine JS -->
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<!-- Load Leaflet Control Geocoder JS -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<!-- Script for map and routing functionality -->
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        var contentWrapper = document.querySelector('.content-wrapper');
        var toggleBtn = document.getElementById('toggle-btn');
        
        sidebar.classList.toggle('sidebar-collapsed');
        contentWrapper.classList.toggle('content-collapsed');
        
        if (sidebar.classList.contains('sidebar-collapsed')) {
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>'; // Ikon collapsed
        } else {
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>'; // Ikon expanded
        }

        setTimeout(function() {
            map.invalidateSize();
        }, 400);
    }

    // Initialize the map
    var map = L.map('mapid').setView([-6.597147, 106.806039], 13);

    // Add the tile layer from OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add Geocoder search control
    L.Control.geocoder().addTo(map);

// Add Routing control without draggable waypoints
var control = L.Routing.control({
    waypoints: [], // Tidak ada waypoints saat halaman pertama kali dimuat
    router: L.Routing.osrmv1({
        serviceUrl: 'http://router.project-osrm.org/route/v1'
    }),
    routeWhileDragging: true,
    draggableWaypoints: false,  // Nonaktifkan draggable waypoints
    addWaypoints: false         // Nonaktifkan menambahkan waypoint dengan klik di peta
}).addTo(map);

map.on('click', function(e) {
    // Tidak melakukan apapun saat peta diklik, mencegah penambahan waypoint
});

document.getElementById('route-instructions-panel').style.display = 'none';


    // Handle the "routesfound" event to display route instructions
    control.on('routesfound', function(e) {
    var instructionsPanel = document.getElementById('route-instructions-panel');
    
    // Jika rute ditemukan, tampilkan panel instruksi
    instructionsPanel.style.display = 'block';
    instructionsPanel.innerHTML = ''; // Bersihkan instruksi lama
    
    // Call the function to display route instructions
    instructionsPanel.innerHTML = createTooltipContent(e.routes);
});

    // Handle "waypointschanged" to update the route in real-time
    control.on('waypointschanged', function() {
        control.route(); // Recalculate route after waypoints change
    });
    // Handle event untuk menyembunyikan panel instruksi jika tidak ada rute
control.on('routeselected', function(e) {
    var instructionsPanel = document.getElementById('route-instructions-panel');
    
    if (!e.routes.length) {
        // Jika tidak ada rute, sembunyikan panel
        instructionsPanel.style.display = 'none';
    }
});

    // Set waypoints based on user input
    function setWaypoints() {
        var currentLocation = document.getElementById('current-location').value.split(',');
        var destination = document.getElementById('destination').value.split(',');

        if (currentLocation.length === 2 && destination.length === 2) {
            control.setWaypoints([
                L.latLng(parseFloat(currentLocation[0]), parseFloat(currentLocation[1])),
                L.latLng(parseFloat(destination[0]), parseFloat(destination[1]))
            ]);
        } else {
            alert('Please enter valid coordinates.');
        }
    }

    // Function to translate and display route instructions
    function createTooltipContent(routes) {
        var totalTime = Math.round(routes[0].summary.totalTime / 60); // Convert to minutes
        var totalDistance = Math.round(routes[0].summary.totalDistance / 1000); // Convert to kilometers

        var instructions = routes[0].instructions.map(function(inst) {
            var translatedText = translateInstruction(inst); // Translate the instruction
            var distanceText = inst.distance ? ` (${Math.round(inst.distance)} meter)` : ''; // Add distance if available
            var icon = inst.type === 'Right' ? '↘️' : inst.type === 'Left' ? '↖️' : '⬆️'; // Choose icon based on instruction type

            return `
                <div class="route-step">
                    <div class="step-icon">${icon}</div>
                    <div class="step-text">${translatedText}${distanceText}</div>
                </div>
            `;
        }).join('');

        return `
            <div class="custom-tooltip">
                <div class="route-title">Durasi: ${totalTime} menit (${totalDistance} km)</div>
                <div class="route-subtitle">Rute tercepat berdasarkan kondisi lalu lintas terkini</div>
                ${instructions}
            </div>
        `;
    }

    // Function to translate route instructions
    function translateInstruction(inst) {
        switch (inst.text) {
            case 'Head':
                return 'Mulai menuju ' + inst.road;
            case 'Continue':
                return 'Lanjutkan di ' + inst.road;
            case 'SlightRight':
                return 'Belok sedikit ke kanan';
            case 'Right':
                return 'Belok kanan';
            case 'SharpRight':
                return 'Belok tajam ke kanan';
            case 'SlightLeft':
                return 'Belok sedikit ke kiri';
            case 'Left':
                return 'Belok kiri';
            case 'SharpLeft':
                return 'Belok tajam ke kiri';
            case 'Take the ramp onto':
                return 'Naik ke jalan tol ' + inst.road;
            case 'Keep right':
                return 'Tetap di kanan';
            case 'Keep left':
                return 'Tetap di kiri';
            case 'DestinationReached':
                return 'Anda telah tiba di tujuan';
            default:
                return inst.text; // If no translation, use original text
        }
    }

// Data TPS yang diperbarui dengan koordinat baru
var tpsData = [
    { lat: -6.549240808216447, lng: 106.77210355431454, address: 'TPS3R Cibadak, Jl. Kp. Seremped No.79, RT.03/RW.04, Cibadak, Kec. Tanah Sereal, Kota Bogor, Jawa Barat 16166', type: 'Umum' },
    { lat: -6.535514474855119, lng: 106.7771265847469, address: 'TPS3R Kembang Setaman, Bukit Cimanggu City FQ7G+QXC, Kel, RT.01/RW.14, Mekarwangi, Kec. Cibadak, Kota Bogor, Jawa Barat 16168', type: 'Umum' },
    { lat: -6.524880553617765, lng: 106.78144952410071, address: 'TPS 3R KSM Kencana Permai, Jl. Perumahan Bumi Kencana Permai, RT.04/RW.10, Tanah Sareal, Kec. Tanah Sereal, Kota Bogor, Jawa Barat 16167', type: 'Umum' },
    { lat: -6.544263883455969, lng: 106.81018060897928, address: 'TPS3R CIPARIGI BOGOR, RT.03/RW.11, Ciparigi, Bogor Utara, Bogor City, West Java 16157', type: 'Umum' },
    { lat: -6.551251227899832, lng: 106.82302135400899, address: 'TPS Rusunawa, CRXF+G68 Rusunawa, Tanah Baru, Kec. Bogor Utara, Kota Bogor, Jawa Barat', type: 'Khusus' },
    { lat: -6.5491028211710125, lng: 106.84921195242836, address: 'TPS, FR2X+CP6, Cipambuan, Babakan Madang, Bogor Regency, West Java 16810', type: 'Khusus' },
    { lat: -6.571395355358456, lng: 106.79109617449708, address: 'Tpa Sampah Ponrum, CQHR+FFF, Gg. Seren, RT.04/RW.12, Kb. Pedes, Kec. Tanah Sereal, Kota Bogor, Jawa Barat 16162', type: 'Umum' },
    { lat: -6.599959042650132, lng: 106.77291745003282, address: 'TPU CIOMAS GANG SADAR, Gg. Sadar No.82, RT.03/RW.02, Ciomas Rahayu, Kec. Ciomas, Kota Bogor, Jawa Barat 16118', type: 'Umum' },
    { lat: -6.577494667561545, lng: 106.80158137584071, address: 'TPS Ciliwung Bantarjati, Jl. Pabaton Indah No.72, RT.05/RW.07, Bantarjati, Kec. Bogor Utara, Kota Bogor, Jawa Barat 16153', type: 'Umum' },
    { lat: -6.618177590973892, lng: 106.8192581732196, address: 'TPS Bantarkemang, 9RJ9+QQR, Jl. Manggis, RT.05/RW.05, Baranangsiang, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16143', type: 'Umum' },
    { lat: -6.641023189008273, lng: 106.81120411932997, address: 'TPS 3R Kelurahan Cipaku, Kota Bogor, Jl. Gn. Gadung/Rancamaya No.26, RT.02/RW.15, Cipaku, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16133', type: 'Umum' },
    { lat: -6.647436520267598, lng: 106.78447260824358, address: 'TPS 3R Kelurahan Mulyaharja, Kota Bogor, Blok, Jl. Kabayan 1 Gg. Anggrek No.57, RT.05/RW.03, Mulyaharja, Bogor Selatan, Bogor City, West Java 16135', type: 'Umum' }
];

// Tambahkan marker ke setiap TPS menggunakan data tpsData yang baru
tpsData.forEach(tps => {
    var marker = L.marker([tps.lat, tps.lng]).addTo(map);
    marker.bindPopup(`<strong>Alamat:</strong> ${tps.address}<br><strong>Kriteria:</strong> ${tps.type}`);
});


function setWaypointsFromSearch() {
    var searchInput = document.getElementById('search-coordinates').value.split(',');
    
    if (searchInput.length === 2) {
        var lat = parseFloat(searchInput[0]);
        var lng = parseFloat(searchInput[1]);
        
        // Set waypoint ke lokasi yang dicari
        control.setWaypoints([
            L.latLng(lat, lng),
            L.latLng(-6.596564, 106.798424)  // Tujuan default atau bisa di-update
        ]);
    } else {
        alert('Masukkan koordinat yang valid.');
    }
}
// Tambahkan marker ke setiap TPS
tpsData.forEach(tps => {
    var marker = L.marker([tps.lat, tps.lng]).addTo(map);
    marker.bindPopup(`<strong>Alamat:</strong> ${tps.address}<br><strong>Kriteria:</strong> ${tps.type}`);
});

// Inisialisasi geocoder
var geocoder = L.Control.Geocoder.nominatim();

// Fungsi untuk mencari lokasi
function searchLocation() {
    var input = document.getElementById('search-location').value;

    if (input) {
        if (input.includes(',')) {
            var coords = input.split(',');
            var lat = parseFloat(coords[0]);
            var lng = parseFloat(coords[1]);
            map.setView([lat, lng], 13);

            // Hanya panggil rute terdekat jika lokasi valid
            findNearestTPS(lat, lng);
        } else {
            geocoder.geocode(input, function(results) {
                if (results && results.length > 0) {
                    var result = results[0];
                    var lat = result.center.lat;
                    var lng = result.center.lng;
                    map.setView([lat, lng], 13);

                    // Hanya panggil rute terdekat jika hasil pencarian valid
                    findNearestTPS(lat, lng);
                } else {
                    alert('Lokasi tidak ditemukan!');
                }
            });
        }
    } else {
        alert('Masukkan lokasi yang ingin dicari.');
    }
}
// Fungsi untuk mencari TPS terdekat berdasarkan lokasi pencarian
function findNearestTPS(startLat, startLng) {
    var currentLocation = L.latLng(startLat, startLng);
    var radius = 5000; // Radius dalam meter
    var nearestTPS = null;
    var nearestDistance = Infinity;

    // Cari TPS terdekat dari lokasi
    tpsData.forEach(function(tps) {
        var distance = map.distance(currentLocation, L.latLng(tps.lat, tps.lng));
        if (distance < nearestDistance) {
            nearestDistance = distance;
            nearestTPS = tps;
        }
    });

    if (nearestTPS) {
        // Fokus ke TPS terdekat
        map.setView([nearestTPS.lat, nearestTPS.lng], 14);

        // Set rute dari lokasi pencarian ke TPS terdekat
        control.setWaypoints([
            currentLocation,
            L.latLng(nearestTPS.lat, nearestTPS.lng)
        ]);

        L.marker([nearestTPS.lat, nearestTPS.lng]).addTo(map)
            .bindPopup(`<b>${nearestTPS.address}</b><br>Type: ${nearestTPS.type}`)
            .openPopup();
    } else {
        alert('Tidak ada TPS dalam radius terdekat.');
        // Sembunyikan panel instruksi karena tidak ada rute
        document.getElementById('route-instructions-panel').style.display = 'none';
    }
}
</script>
</body>
</html>
