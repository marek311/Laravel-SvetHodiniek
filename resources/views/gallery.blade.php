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
<a href="{{ route('home') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Galéria</h1>
</div>
<div class="container-h-center">
    <h1>{{ count($galleryPosts) }}</h1>
</div>
<div class="image-container">
    @foreach ($galleryPosts as $post)
        <div class="image-wrapper">
            <p>{{ $post->name }}</p>
            <img class="infinite-scroll-trigger" src="{{ $post->picture }}" alt="{{ $post->name }}" width="300">
            <a href="{{ route('gallery.updateForm', ['id' => $post->id]) }}" class="edit-link">Edit</a>
            <a href="{{ route('gallery.deleteForm', ['id' => $post->id]) }}" class="delete-link">Delete</a>
            </div>
    @endforeach
</div>

<button id="loadMoreButton">Load More</button>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetchImages(6);

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    fetchImages(6);
                }
            });
        });

        const images = document.querySelectorAll('.infinite-scroll-trigger');
        images.forEach(image => {
            observer.observe(image);
        });

        const loadMoreButton = document.getElementById('loadMoreButton');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                fetchImages(6);
            });
        }
    });

    function fetchImages(count) {
        fetch("{{ route('gallery.fetchMore') }}?count=" + count)
            .then(response => response.json())
            .then(data => {
                // Append new images to the image container
                const imageContainer = document.querySelector('.image-container');
                data.forEach(post => {
                    const imageWrapper = document.createElement('div');
                    imageWrapper.className = 'image-wrapper';
                    imageWrapper.innerHTML = `
                    <p>${post.name}</p>
                    <img class="infinite-scroll-trigger" src="${post.picture}" alt="${post.name}" width="300">
                    <a href="{{ route('gallery.updateForm', ['id' => $post->id]) }}" class="edit-link">Edit</a>
                    <a href="{{ route('gallery.deleteForm', ['id' => $post->id]) }}" class="edit-link">Edit</a>
                `;
                    imageContainer.appendChild(imageWrapper);
                });
            })
            .catch(error => console.error('Error fetching images:', error));
    }

</script>

</body>
</html>
