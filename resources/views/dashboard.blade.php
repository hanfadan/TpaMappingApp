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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }
        .main-sidebar {
            background-color: #2c3e50;
        }
        .nav-link {
            color: white !important;
            font-size: 16px;
        }
        .nav-link:hover {
            background-color: #34495e !important;
        }
        .nav-icon {
            margin-right: 10px;
        }
        .content-wrapper {
            margin-left: 250px; /* Shift content to make space for the sidebar */
            padding: 20px;
        }
        .map-view {
            height: 500px;
            background-color: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 8px;
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
            height: 400px;
            width: 100%;
        }
        .brand-link {
            background-color: #27ae60;
            text-align: center;
            color: white;
        }
        .brand-link h4 {
            margin: 0;
            padding: 10px;
        }
        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #27ae60;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #1abc9c;
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <h4>TPA Navigator Bogor</h4>
            </a>
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
                            <div class="summary-card">
                                <h5>Bookmarks</h5>
                                <p>List of saved locations...</p>
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
        <!-- /.cont
