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
/* Saat sidebar expanded */
/* Override CSS bawaan dengan !important */
.content-wrapper {
    margin-left: 250px !important;
    width: calc(100% - 250px) !important;
    transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
}

.content-wrapper.content-collapsed {
    margin-left: 60px !important;
    width: calc(100% - 60px) !important;
}
@media (min-width: 768px) {
    .content-wrapper {
        margin-left: 250px !important;
        width: calc(100% - 250px) !important;
    }
    
    .content-wrapper.content-collapsed {
        margin-left: 60px !important;
        width: calc(100% - 60px) !important;
    }
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
            right: 10px; /* Adjust the position */
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
                    <!-- Summary Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="summary-card">
                                <h5>Summary</h5>
                                <p>Some summary information here...</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="summary-card route-instructions" id="route-instructions">
                                <h5>Route Instructions</h5>
                                <!-- Route instructions will appear here -->
                            </div>
                        </div>
                    </div>
                    <!-- Map Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="map-view">
                                <h5>Map View</h5>
                                <div class="map-container" id="mapid"></div>
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
    
    // Toggle kelas untuk collapsed/expanded
    sidebar.classList.toggle('sidebar-collapsed');
    contentWrapper.classList.toggle('content-collapsed');
    
    // Ganti ikon pada tombol   
    if (sidebar.classList.contains('sidebar-collapsed')) {
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>'; // Ikon collapsed
    } else {
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>'; // Ikon expanded
    }
}
        // Initialize the map
        var map = L.map('mapid').setView([-6.597147, 106.806039], 13);

        // Add the tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add OSRM Routing
        var control = L.Routing.control({
            waypoints: [
                L.latLng(-6.597147, 106.806039),
                L.latLng(-6.596564, 106.798424)
            ],
            router: L.Routing.osrmv1({
                serviceUrl: 'https://router.project-osrm.org/route/v1'
            }),
            createMarker: function() { return null; }
        }).addTo(map);

        control.on('routesfound', function(e) {
            var instructions = document.getElementById('route-instructions');
            instructions.innerHTML = '';
            var routes = e.routes[0].instructions;

            routes.forEach(function(instruction, i) {
    instructions.innerHTML += `<p>${i+1}. ${instruction.text}</p>`;
});
});

        </script>
</body>
</html>
