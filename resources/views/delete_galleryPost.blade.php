<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vymazanie postu</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<a href="{{ route('gallery') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Vymazanie postu</h1>
</div>
<div class="container-h-center">
    <div class="image-container">
        <div class="image-wrapper">
            <p>{{ $galleryPost->name }}</p>
            <img class="infinite-scroll-trigger" src="{{ $galleryPost->picture }}" alt="{{ $galleryPost->name }}" width="300">
        </div>
    </div>
</div>
<div class="form-container">
    <form action="{{ route('gallery.delete', ['id' => $galleryPost->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <label for="submit_button">Naozaj chceš vymazať tento post?</label>
        <div class="button-container">
            <button id="submit_button" type="submit">Vymazať</button>
            <a href="{{ route('gallery') }}" class="cancel-button">Zrušiť</a>
        </div>
    </form>
</div>
</body>
</html>
