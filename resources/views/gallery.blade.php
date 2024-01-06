
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
<div class="container-h-center">
    <h1>{{ count($galleryPosts) }}</h1>
</div>
<div class="image-container">
    @php $count = 0; @endphp
    @foreach ($galleryPosts as $post)
        @if ($count < 2)
            <div class="image-wrapper">
                <p>{{ $post->name }}</p>
                <img class="infinite-scroll-trigger" src="{{ $post->picture }}" alt="{{ $post->name }}" width="300">
                @auth
                    <a href="{{ route('gallery.updateForm', ['id' => $post->id]) }}" class="edit-link">Edit</a>
                    <a href="{{ route('gallery.deleteForm', ['id' => $post->id]) }}" class="delete-link">Delete</a>
                @endauth
            </div>
            @php $count++; @endphp
        @endif
    @endforeach
</div>
<div class="container-h-center">
    <button id="loadMoreButton">Load More</button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let offset = 0;
        let initialLoadCount = 2;
        const imageContainer = document.querySelector('.image-container');
        const loadMoreButton = document.getElementById('loadMoreButton');
        loadMoreButton.addEventListener('click', function () {
            offset += 2;
            fetchImages(offset);
        });

        function createEditDeleteLinks(postId) {
            return `
                <a href="/gallery/${postId}/edit" class="edit-link">Edit</a>
                <a href="/gallery/delete/${postId}/confirm" class="delete-link">Delete</a>
            `;
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
                            ${createEditDeleteLinks(post.id)}
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
