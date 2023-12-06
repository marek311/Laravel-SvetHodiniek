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
