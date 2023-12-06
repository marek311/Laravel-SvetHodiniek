<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $review->watch_name }} Review</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_review.css') }}">
</head>
<body>
<div class="container-h-center">
    <h1>{{ $review->watch_name }}</h1>
</div>
<div class="review-container">
    @foreach($review->paragraphs as $paragraph)
        <div class="review-section">
            <p>
                {{ $paragraph->paragraph_text }}
            </p>
        </div>
    @endforeach
</div>
</body>
</html>
