<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_loginRegister.css') }}">
</head>
<body>
<div class="login-register-card">
    <div class="card-header">
        <strong>Choose an option:</strong>
    </div>
    <div class="card-body">
        <div class="login-register-options">
            <a href="loginTab" id="loginTab" class="active">Login</a>
            <a href="registerTab" id="registerTab" class="active">Register</a>
        </div>
    </div>
</div>
</body>
</html>
