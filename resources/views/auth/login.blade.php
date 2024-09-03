<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PlainGIS Timber</title>
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
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
        color: #333; /* Adjusting text color */
    }
    .content-wrapper {
        display: flex;
        align-items: center; /* Align items vertically */
        padding: 20px; /* Padding for aesthetic spacing */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background: rgba(255, 255, 255, 0.85); /* Optional: Add background to the wrapper */
        border-radius: 8px; /* Optional: Rounded corners for the wrapper */
}
    .title-section, .login-section {
        width: 50%; /* Each section takes half of the content wrapper */
        padding: 20px; /* Padding for internal spacing */
    }
    .login-logo a {
        color: #004d40;
        text-decoration: none;
        font-size: 22px;
        font-weight: bold;
    }
    .login-box-msg {
        font-size: 16px;
        color: #666;
        text-align: center;
    }
    .btn-primary, .btn-success {
        width: 100%; /* Full width buttons */
    }
</style>
</head>
<body>
<div class="content-wrapper">
    <div class="title-section">
        <div class="login-logo">
            <a href="{{ url('/') }}">PlainGIS Timber</a>
            <p>Environmental assessment for forest landowners using machine learning</p>
        </div>
    </div>
    <div class="login-section">
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
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Remember me
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-success">
                    Sign up
                </a>
                <a href="{{ route('password.request') }}" class="text-center">Forgot password?</a>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>
