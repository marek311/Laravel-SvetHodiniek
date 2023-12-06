<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Gallery Post</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<div class="container-h-center">
    <h1>Add Gallery Post</h1>
</div>
<div class="form-container">
    <form action="{{ route('gallery.create') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="picture">Picture URL:</label>
        <input type="url" id="picture" name="picture" required>
        <button type="submit">Add Gallery Post</button>
    </form>
</div>
</body>
</html>
