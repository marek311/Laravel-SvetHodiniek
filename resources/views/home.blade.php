<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Svet Hodiniek</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
  <link rel="stylesheet" href="{{ asset('styling_home.css') }}">
</head>
<body>
<header id="myNavbar" class="navbar navbar-expand-md navbar-light bg-light fixed-top">
  <a href="/">
    <h3 class="navbar-title">Svet Hodiniek</h3>
  </a>
  <a href="/">
    <img src="img_logo.jpg" class="logo-image" alt="logo">
  </a>
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="reviews">Recenzie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery">Galéria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dictionary">Slovník</a>
        </li>
      </ul>
      <div class="ms-auto">
        <a href="profile" class="nav-link"><i class="bi bi-person"></i></a>
      </div>
    </div>
  </div>
</header>
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($reviews as $key => $review)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <div class="image-wrapper">
                    <img src="{{ $review->picture }}" class="d-block w-100" alt="{{ $review->watch_name }}">
                </div>
                <div class="carousel-caption">
                    <h3>
                        <a href="{{ route('review', ['watchName' => $review->watch_name]) }}">Recenzia {{ $review->watch_name }}
                        </a>
                    </h3>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
</body>
</html>
