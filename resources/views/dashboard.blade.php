<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPA Navigator Bogor Dashboard</title>
    <!-- AdminLTE and Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        /* Update for content wrapper */
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
        .sidebar-collapsed .toggle-sidebar-btn {
            right: 10px;
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



.route-instructions-panel .route-title {
    font-weight: bold;
    font-size: 18px;
    color: #f57c00;
    margin-bottom: 5px;
}

.route-instructions-panel .route-subtitle {
    color: #555;
    font-size: 12px;
    margin-bottom: 10px;
}

.route-instructions-panel .route-step {
    padding: 5px 0;
    display: flex;
    align-items: flex-start;
}

.route-instructions-panel .step-icon {
    margin-right: 10px;
}

.route-instructions-panel .step-text {
    flex: 1;
}
.leaflet-routing-container {
    display: none !important;
}

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar">
            <!-- Brand Logo -->
            <div class="brand-link d-flex justify-content-between align-items-center">
                <h4>TPA Navigator Bogor</h4>
                <button id="toggle-btn" class="toggle-sidebar-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <!-- Sidebar -->
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Map Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="map-view">
                                <h5>Map View</h5>
                                <div id="mapid" style="height: 100%;"></div>
                                <div id="route-instructions-panel" class="route-instructions-panel">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine JS -->
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

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
        map.invalidateSize(); // Resize peta setelah animasi sidebar selesai
    }, 400);
}

// Initialize the map
var map = L.map('mapid').setView([-6.597147, 106.806039], 13);

// Add the tile layer from OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Tambahkan routing control
var control = L.Routing.control({
    waypoints: [
        L.latLng(-6.597147, 106.806039),
        L.latLng(-6.596564, 106.798424)
    ],
    router: L.Routing.osrmv1({
        serviceUrl: 'http://router.project-osrm.org/route/v1'
    }),
    routeWhileDragging: true, // Memungkinkan dragging waypoints
    draggableWaypoints: true, // Pastikan waypoints bisa di-drag
    addWaypoints: true, // Memungkinkan menambah waypoints
    createMarker: function(i, wp) {
        return L.marker(wp.latLng, { draggable: true }) // Buat marker yang bisa di-drag
            .bindPopup(`<b>Waypoint ${i + 1}</b>`);
    }
}).addTo(map);

// Tangani event "routesfound" untuk memperbarui instruksi rute
control.on('routesfound', function(e) {
    var instructionsPanel = document.getElementById('route-instructions-panel');
    instructionsPanel.innerHTML = ''; // Hapus instruksi yang ada

    // Panggil fungsi untuk membuat dan menampilkan instruksi yang diterjemahkan
    instructionsPanel.innerHTML = createTooltipContent(e.routes);
});

// Tangani event "waypointschanged" untuk memperbarui rute secara real-time
control.on('waypointschanged', function() {
    control.route(); // Regenerasi rute setelah waypoints diubah
});

// Fungsi untuk menerjemahkan dan menampilkan rute
function createTooltipContent(routes) {
    var totalTime = Math.round(routes[0].summary.totalTime / 60); // Konversi ke menit
    var totalDistance = Math.round(routes[0].summary.totalDistance / 1000); // Konversi ke kilometer

    var instructions = routes[0].instructions.map(function(inst) {
        var translatedText = translateInstruction(inst); // Terjemahkan instruksi
        var distanceText = inst.distance ? ` (${Math.round(inst.distance)} meter)` : ''; // Tambahkan jarak jika ada
        var icon = inst.type === 'Right' ? '↘️' : inst.type === 'Left' ? '↖️' : '⬆️'; // Pilih ikon berdasarkan tipe instruksi

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

// Fungsi terjemahan instruksi rute
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
            return inst.text; // Jika tidak ada terjemahan, gunakan teks asli
    }
}
</script>
</body>
</html>
