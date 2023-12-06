<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
    <title>{{ $galleryPost->name }} edit review</title>
</head>
<body>
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
