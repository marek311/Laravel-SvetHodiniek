<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galéria hodiniek</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_gallery.css') }}">
</head>
<body>
<a href="{{ route('gallery.createForm') }}" class="add-button">
    <button>Create Gallery Post</button>
</a>
<div class="container-h-center">
    <h1>Galéria</h1>
</div>
<div class="image-container">
@foreach ($galleryPosts as $post)
    <div class="image-wrapper">
        <p>{{ $post->name }}</p>
        <img src="{{ $post->picture }}" alt="{{ $post->name }}" width="300">
        <a href="{{ route('gallery.updateForm', ['id' => $post->id]) }}" class="edit-link">Edit</a>
        <a href="{{ route('gallery.deleteForm', ['id' => $post->id]) }}" class="delete-link">Delete</a>
    </div>
@endforeach
</div>
</body>
</html>
