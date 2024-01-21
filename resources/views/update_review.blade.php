<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
    <script src="{{ asset('scriptAddParagraphUpdate.js') }}"></script>
    <script src="{{ asset('scriptDeleteParagraph.js') }}"></script>
    <script src="{{ asset('scriptHandleFileSelect.js') }}"></script>
    <title>Upravenie recenzie {{ $review->watch_name }}</title>
</head>
<body>
<a href="{{ route('reviews') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<h1>Upravenie recenzie</h1>
<form method="post" action="{{ route('review.update', ['watch_name' => $review->watch_name]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="title">Meno hodiniek:</label>
    <input type="text" id="title" name="title" value="{{ $review->watch_name }}" pattern="[A-Za-z0-9\s.,!?]+" title="Prosím, zadajte platný popis, iba písmená, číslice, medzery a .,!?" required>
    <div id="paragraphsContainer">
        @foreach ($review->paragraphs as $index => $paragraph)
            <div class="paragraphInputContainer">
                <label for="content{{ $index }}">Obsah recenzie:</label>
                <textarea id="content{{ $index }}" name="content[{{ $index }}]" required pattern="[A-Za-z0-9\s.,!?]+" title="Prosím, zadajte platný popis, iba písmená, číslice, medzery a .,!?">{{ $paragraph->paragraph_text }}</textarea>
                <button type="button" onclick="deleteParagraph(this)">Vymaž paragraf</button>
            </div>
        @endforeach
    </div>
    <button type="button" onclick="addParagraph()">Pridaj paragraf</button>
    <label for="pictureFile">Súbor obrázku:</label>
    <input type="file" id="pictureFile" name="pictureFile" accept="image/*" required>
    <span id="file-name-placeholder"></span>
    <button type="submit">Uprav recenziu</button>
</form>
</body>
</html>
