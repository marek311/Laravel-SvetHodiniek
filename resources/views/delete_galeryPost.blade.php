<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Gallery Post</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<div class="container-h-center">
    <a href="{{ route('gallery') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1>Delete Gallery Post</h1>
</div>
<div class="form-container">
    <form action="{{ route('gallery.delete', ['id' => $galleryPost->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <label for="submit_button">Are you sure you want to delete this gallery post?</label>
        <div class="button-container">
            <button id="submit_button" type="submit">Delete Gallery Post</button>
            <a href="{{ route('gallery') }}" class="cancel-button">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
