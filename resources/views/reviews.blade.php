<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recenzie Hodiniek</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_reviews.css') }}">
</head>
<body>
<a href="{{ route('review.createForm') }}" class="add-button">
    <button>Create Review</button>
</a>
<div class="container-h-center">
    <h1>Recenzie</h1>
</div>
<div class="reviews">
    @foreach ($reviews as $review)
        <div class="box">
            @php $cleanWatchName = strtolower(str_replace(' ', '_', $review['watch_name'])); @endphp
            <a class="nav-link" href="{{ url("/reviews/{$cleanWatchName}") }}">
                <img src="{{ $review['picture'] }}" alt="img_watch">
            </a>
            <div class="review-content">
                <a class="header-link" href="{{ url("/reviews/{$cleanWatchName}") }}">
                    <p>{{ $review['watch_name'] }}</p>
                </a>
                <a class="edit-link" href="{{ route('review.updateForm',['watch_name' => $review->watch_name]) }}">
                    <button>Edit Review</button>
                </a>
                @auth
                    <a class="delete-link" href="{{ route('review.deleteForm', ['watch_name' => $review->watch_name]) }}">
                        <button>Delete</button>
                    </a>
                @endauth
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
