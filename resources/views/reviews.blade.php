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
@auth
    <a href="{{ route('review.createForm') }}" class="add-button">
        <button>Napíš recenziu</button>
    </a>
@endauth
<a href="{{ route('home') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Recenzie</h1>
</div>
    @if ( count($reviews) == 0)
        <div class="container-h-center">
            <h2>Na stránke v súčastnosti nenájdete recenzie</h2>
        </div>
    @endif
    @if ( count($reviews) == 1)
        <div class="container-h-center">
            <h2>Na stránke v súčastnosti nájdete {{ count($reviews) }} recenziu</h2>
        </div>
    @endif
    @if ( count($reviews) == 2 || count($reviews) == 3 || count($reviews) == 4)
    <div class="container-h-center">
        <h2>Na stránke v súčastnosti nájdete {{ count($reviews) }} recenzie</h2>
    </div>
    @endif
    @if ( count($reviews) > 4)
        <div class="container-h-center">
            <h2>Na stránke v súčastnosti nájdete {{ count($reviews) }} recenzii</h2>
        </div>
   @endif
<div class="reviews">
    @foreach ($reviews as $review)
        <div class="box">
            @php $cleanWatchName = strtolower(str_replace(' ', '_', $review['watch_name'])); @endphp
            <a class="nav-link" href="{{ url("/reviews/{$cleanWatchName}") }}">
                <img src="{{ route('image.show', ['id' => $review->id]) }}" alt="{{ $review->watch_name }}">
            </a>
            <div class="review-content">
                <a class="header-link" href="{{ url("/reviews/{$cleanWatchName}") }}">
                    <p>{{ $review['watch_name'] }}</p>
                </a>
                @auth
                    @if(auth()->user()->id == $review->user_id || auth()->user()->role === 'admin')
                        <a class="edit-link" href="{{ route('review.updateForm',['watch_name' => $review->watch_name]) }}">
                            <button>Uprav recenziu</button>
                        </a>
                        <a class="delete-link" href="{{ route('review.deleteForm', ['watch_name' => $review->watch_name]) }}">
                            <button>Vymaž recenziu</button>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
