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
@auth
    <a href="{{ route('gallery.createForm') }}" class="add-button">
        <button>Create Gallery Post</button>
    </a>
@endauth
<a href="{{ route('home') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Galéria</h1>
</div>
@if ( count($galleryPosts) == 0)
    <div class="container-h-center">
        <h2>Na tejto stránke nenájdete zaujímavé hodinky na inšpiráciu</h2>
    </div>
@endif
@if ( 1 <= count($galleryPosts)  && count($galleryPosts) <= 4)
    <div class="container-h-center">
        <h2>Na tejto stránke nájdete presne {{ count($galleryPosts) }} zaujímavé hodinky na inšpiráciu</h2>
    </div>
@endif
@if ( count($galleryPosts) > 4)
    <div class="container-h-center">
        <h2>Na tejto stránke nájdete presne {{ count($galleryPosts) }} zaujímavých hodiniek na inšpiráciu</h2>
    </div>
@endif
<div class="image-container">
    @php $count = 0; @endphp
    @foreach ($galleryPosts as $post)
        @if ($count < 2)
            <div class="image-wrapper">
                <p>{{ $post->name }}</p>
                <img class="infinite-scroll-trigger" src="{{ $post->picture }}" alt="{{ $post->name }}" width="300">
                @auth
                    @if(auth()->user()->id === $post->user_id || auth()->user()->role === 'admin')
                        <a href="{{ route('gallery.updateForm', ['id' => $post->id]) }}" class="edit-link">Edit</a>
                        <a href="{{ route('gallery.deleteForm', ['id' => $post->id]) }}" class="delete-link">Delete</a>
                    @endif
                @endauth
            </div>
            @php
                $count++;
            @endphp
        @endif
    @endforeach
</div>
<div class="container-h-center">
    <button id="loadMoreButton">Load More</button>
</div>
<script>
    const userRole = "{{ auth()->check() ? auth()->user()->role : 'guest' }}";
    document.addEventListener("DOMContentLoaded", function () {
        let offset = 0;
        let initialLoadCount = 2;
        const imageContainer = document.querySelector('.image-container');
        const loadMoreButton = document.getElementById('loadMoreButton');
        loadMoreButton.addEventListener('click', function () {
            offset += 2;
            fetchImages(offset);
        });
        function createEditDeleteLinks(postId, userId, userRole) {
            const isAuthor = userId === {{ auth()->check() ? auth()->user()->id : 'null' }};
            const isAdmin = userRole === 'admin';
            if (isAuthor || isAdmin) {
                return `
            <a href="/gallery/${postId}/edit" class="edit-link">Edit</a>
            <a href="/gallery/delete/${postId}/confirm" class="delete-link">Delete</a>
            `;
            }
            return '';
        }
        function fetchImages(offset) {
            fetch("/gallery/fetchMore?count=" + (offset === 0 ? initialLoadCount : 2) + "&offset=" + offset)
                .then(response => response.json())
                .then(data => {
                    const totalImages = data.total;
                    if (offset === 0) {
                        imageContainer.innerHTML = '';
                    }
                    data.images.forEach(post => {
                        const imageWrapper = document.createElement('div');
                        imageWrapper.className = 'image-wrapper';
                        imageWrapper.innerHTML = `
                            <p>${post.name}</p>
                            <img class="infinite-scroll-trigger" src="${post.picture}" alt="${post.name}" width="300">
                            ${createEditDeleteLinks(post.id, post.user_id, userRole)}
                        `;
                        imageContainer.appendChild(imageWrapper);
                    });
                    if (offset >= totalImages - 2) {
                        loadMoreButton.disabled = true;
                    }
                })
                .catch(error => console.error('Error fetching images:', error));
        }
        fetchImages(offset);
    });
</script>
</body>
</html>
