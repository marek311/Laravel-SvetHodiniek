<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pridanie nového pojmu</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<a href="{{ route('dictionary') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Pridanie nového pojmu</h1>
</div>
<div class="form-container">
    <form action="{{ route('watchmakingTerm.create') }}" method="post">
        @csrf
        <label for="term">Pojem:</label>
        <input type="text" id="term" name="term" value="{{ old('term') }}" pattern="[A-Za-z0-9\s]+" title="Prosím, zadajte platný pojem, iba písmená, číslice a medzery" required>
        <label for="explanation">Vysvetlenie:</label>
        <textarea id="explanation" name="explanation" rows="4" pattern="[A-Za-z0-9\s.,!?]+" title="Prosím, zadajte platné vysvetlenie, iba písmená, číslice, medzery a .,!?" required>{{ old('explanation') }}</textarea>
        <button type="submit">Pridať nový pojem</button>
    </form>
</div>
</body>
</html>
