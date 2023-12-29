<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
    <title>{{ $galleryPost->name }} edit review</title>
</head>
<body>
<a href="{{ route('gallery') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
 <h1>Update Gallery Post</h1>
    <form action="{{ route('gallery.update', ['id' => $galleryPost->id]) }}" method="post">
        @csrf
        @method('PUT')
        <label for="update_name">Name:</label>
        <input type="text" id="update_name" name="name" value="{{ $galleryPost->name }}" required>
        <label for="update_picture">Picture URL:</label>
        <input type="url" id="update_picture" name="picture" value="{{ $galleryPost->picture }}" required>
        <button type="submit">Update Gallery Post</button>
    </form>
</body>
</html>
