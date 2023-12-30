<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Watchmaking Term</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<a href="{{ route('dictionary') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Delete Watchmaking Term</h1>
</div>
<div class="form-container">
    <form action="{{ route('watchmakingTerm.delete', ['id' => $watchmakingTerm->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <label for="submit_button">Are you sure you want to delete this watchmaking term?</label>
        <div class="button-container">
            <button id="submit_button" type="submit">Delete Watchmaking Term</button>
            <a href="{{ route('dictionary') }}" class="cancel-button">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
