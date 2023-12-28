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
<div class="container-h-center">
    <h1>{{ $review->watch_name }}</h1>
</div>
<div class="review-container">
    @foreach($review->paragraphs as $paragraph)
        <div class="review-section">
            <p>
                {{ $paragraph->paragraph_text }}
            </p>
        </div>
    @endforeach
    <div class="comment-section">
        <h2>Comments</h2>
        @foreach($review->comments as $comment)
            <div class="comment">
                <p>{{ $comment->content }}</p>
                <form action="{{ route('comment.delete', ['watchName' => $review->watch_name, 'commentId' => $comment->id]) }}" method="post" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
        <form action="{{ route('comment.create', ['watchName' => $review->watch_name]) }}" method="post">
            @csrf
            <label for="comment_content">Add a Comment:</label>
            <textarea name="content" id="comment_content" rows="3" required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    </div>
</div>
</body>
</html>
