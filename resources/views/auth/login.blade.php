<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TPS Mapping Bogor</title>
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    body {
        background: url('{{ asset('images/forest-background.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        width: 85%;
        margin: 0;
        color: #333;
    }
    .content-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 80%;
        max-width: 1000px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        background: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
    }
    .title-section {
        width: 45%;
        padding-right: 20px;
        color: #2c3e50;
        text-align: left;
    }
    .login-section {
        width: 45%;
        padding-left: 20px;
    }
    .login-logo a {
        color: #27ae60;
        text-decoration: none;
        font-size: 28px;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }
    .login-logo p {
        font-size: 18px;
        color: #34495e;
        line-height: 1.5;
        margin-bottom: 30px;
    }
    .input-group-text {
        background-color: #ecf0f1;
    }
    .form-control {
        border-radius: 4px;
        border: 1px solid #bdc3c7;
    }
    .btn-primary {
        background-color: #1abc9c; /* Updated color for "Sign In" */
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: #fff;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #16a085; /* Darken on hover */
    }
    .btn-success {
        background-color: #2ecc71; /* Updated color for "Sign Up" */
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: #fff;
        transition: background-color 0.3s ease;
    }
    .btn-success:hover {
        background-color: #16a085; /* Darken on hover */
    }
    .social-auth-links a {
        display: block;
        margin-top: 15px;
        font-size: 14px;
    }
    </style>
</head>
<body>
<div class="content-wrapper">
    <div class="title-section">
        <div class="login-logo">
            <a href="{{ url('/') }}">TPS Navigator Bogor</a>
            <p>Aplikasi GIS untuk mencari TPS terdekat di Kota Bogor</p>
        </div>
    </div>
    <div class="login-section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                </div> -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </div>
            <!-- <div class="social-auth-links text-center mt-3">
                <a href="#" class="btn btn-success">Sign up</a>
                <a href="{{ route('password.request') }}" class="d-block mt-2">Forgot password?</a>
            </div> -->
        </form>
    </div>
</div>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>
