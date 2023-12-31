<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_profile.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
<div class="profile-container">
    <a href="{{ route('home') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="15%">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <div class="ms-auto">
        @auth
            <div class="nav-link">
                <i class="bi bi-person person-icon"></i> {{ Auth::user()->name }}
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="document.getElementById('logout-form').submit();" class="nav-link">
                <i class="bi bi-box-arrow-left person-icon"></i> Logout
            </a>
        @else
            <a href="{{ route('profile') }}" class="nav-link">
                <i class="bi bi-person person-icon"></i> Profile
            </a>
        @endauth
    </div>
    <div class="buttons-container">
        @guest
            <a href="{{ route('register') }}" class="button">Register</a>
            <a href="{{ route('login') }}" class="button">Login</a>
        @endguest
    </div>
</div>
</body>
</html>
