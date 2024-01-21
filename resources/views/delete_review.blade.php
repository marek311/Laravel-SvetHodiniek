<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vymazanie recenzie</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<a href="{{ route('reviews') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Vymazanie recenzie</h1>
</div>
<div class="container-h-center">
    <h1>{{ $review->watch_name }}</h1>
    <img src="{{ route('image.show', ['id' => $review->id]) }}" alt="{{ $review->watch_name }}" style="width: 30%;">
    <div class="author-section">
        <p>Autor: {{ $review->user->name }}</p>
    </div>
    @foreach($review->paragraphs as $paragraph)
        <div class="review-section">
            <p>
                {{ $paragraph->paragraph_text }}
            </p>
        </div>
    @endforeach
</div>
<div class="form-container">
    <form action="{{ route('review.delete', ['watch_name' => $review->watch_name]) }}" method="post">
        @csrf
        @method('DELETE')
        <label for="submit_button">Naozaj chceš vymazať túto recenziu?</label>
        <div class="button-container">
            <button id="submit_button" type="submit">Vymazať</button>
            <a href="{{ route('reviews') }}" class="cancel-button">Zrušiť</a>
        </div>
    </form>
</div>
</body>
</html>
