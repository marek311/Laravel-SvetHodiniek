<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Review</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<div class="container-h-center">
    <h1>Delete Review</h1>
</div>
<div class="form-container">
    <form action="{{ route('review.delete', ['watch_name' => $review->watch_name]) }}" method="post">
        @csrf
        @method('DELETE')
        <label for="submit_button">Are you sure you want to delete this review?</label>
        <div class="button-container">
            <button id="submit_button" type="submit">Delete Review</button>
            <a href="{{ route('reviews') }}" class="cancel-button">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
