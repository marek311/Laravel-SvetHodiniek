<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $review->watch_name }} Review</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_review.css') }}">
</head>
<body>
<a href="{{ route('reviews') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>{{ $review->watch_name }}</h1>
</div>
<div class="container-h-center">
    <img src="{{ asset($review->picture) }}" alt="{{ $review->watch_name }}" style="width: 30%;">
</div>
<div class="review-container">
    <div class="author-section">
        <p>Author: {{ $review->user->name }}</p>
    </div>
    @foreach($review->paragraphs as $paragraph)
        <div class="review-section">
            <p>
                {{ $paragraph->paragraph_text }}
            </p>
        </div>
    @endforeach
        <div class="comment-section">
            <h2>Comments:{{ count($review->comments) }}</h2>
            @foreach($review->comments as $comment)
                <div class="comment">
                    <div class="author-section">
                        <p>Author: {{ $comment->user->name }}</p>
                    </div>
                    <p>{{ $comment->content }}</p>
                    @auth
                        @if(auth()->user()->id === $comment->user_id || auth()->user()->role === 'admin')
                            <form action="{{ route('comment.delete', ['watchName' => $review->watch_name, 'commentId' => $comment->id]) }}" method="post" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button id="delete-comment" type="submit">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endforeach
            @auth
                <form action="{{ route('comment.create', ['watchName' => $review->watch_name]) }}" method="post">
                    @csrf
                    <label for="comment_content">Add a Comment:</label>
                    <textarea name="content" id="comment_content" rows="3" required></textarea>
                    <button type="submit">Add Comment</button>
                </form>
            @endauth
        </div>
</div>
</body>
</html>
