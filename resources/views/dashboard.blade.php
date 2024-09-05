<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPA Navigator Bogor Dashboard</title>
    <!-- AdminLTE and Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            margin-left: 250px; /* Shift content to make space for the sidebar */
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .sidebar-hidden .content-wrapper {
            margin-left: 0;
        }
        .sidebar-hidden {
    transform: translateX(-250px); /* Move the sidebar out of view */
    transition: transform 0.3s ease-in-out;
}

.full-width {
    margin-left: 0 !important; /* Expand content to the full width when sidebar is hidden */
    transition: margin-left 0.3s ease-in-out;
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
        .sidebar-header h4 {
            color: #27ae60;
        }
        .map-container {
            height: 100%;
            width: 100%;
        }
        .brand-link {
            background-color: #1abc9c;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            padding-right: 10px;
        }
        .brand-link h4 {
            margin: 0;
            padding: 10px;
        }
        .toggle-sidebar-btn {
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
        }
        h1 {
            font-weight: bold;
            color: #2c3e50;
        }
        h5 {
            color: #34495e;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar">
            <!-- Brand Logo -->
            <div class="brand-link">
                <h4>TPA Navigator Bogor</h4>
                <!-- Button to toggle sidebar -->
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
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
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
        // Initialize the map
        var map = L.map('mapid').setView([-6.597147, 106.806039], 13); // Latitude and Longitude for Bogor

        // Add the tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add OSRM Routing
        var control = L.Routing.control({
            waypoints: [
                L.latLng(-6.597147, 106.806039),  // Example starting point (Bogor)
                L.latLng(-6.596564, 106.798424)   // Example destination point
            ],
            router: L.Routing.osrmv1({
                serviceUrl: 'https://router.project-osrm.org/route/v1' // Using OSRM's public server
            }),
            createMarker: function() { return null; } // Remove default markers
        }).addTo(map);

        control.on('routesfound', function(e) {
            var instructions = document.getElementById('route-instructions');
            instructions.innerHTML = '';
            var routes = e.routes[0].instructions;

            routes.forEach(function(instruction, i) {
                instructions.innerHTML += `<p>${i+1}. ${instruction.text}</p>`;
            });
        });
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var contentWrapper = document.querySelector('.content-wrapper');
            sidebar.classList.toggle('sidebar-hidden');
            contentWrapper.classList.toggle('full-width');
        }
    </script>
</body>
</html>

   
