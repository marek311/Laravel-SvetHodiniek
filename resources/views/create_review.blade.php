<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pridanie novej recenzie</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
    <script src="{{ asset('scriptAddParagraphCreate.js') }}"></script>
    <script src="{{ asset('scriptDeleteParagraph.js') }}"></script>
    <script src="{{ asset('scriptHandleFileSelect.js') }}"></script>
</head>
<body>
<a href="{{ route('reviews') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Pridanie novej recenzie</h1>
</div>
<div class="form-container">
    <form action="{{ route('review.create') }}" method="post" id="createReviewForm" enctype="multipart/form-data">
        @csrf
        <label for="title">Názov:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" pattern="[A-Za-z0-9\s.,!?]+" title="Prosím, zadajte platný názov, iba písmená, číslice, medzery a .,!?" required>
        <label for="pictureFile">Súbor obrázku:</label>
        <input type="file" id="pictureFile" name="pictureFile" accept="image/*" required>
        <span id="file-name-placeholder"></span>
        <div id="paragraphsContainer">
            <label for="content">Paragraf:</label>
            @if(old('content'))
                @foreach(old('content') as $paragraph)
                    <div class="paragraphInputContainer">
                        <input type="text" class="paragraphInput" name="content[]" value="{{ $paragraph }}" pattern="[A-Za-z0-9\s.,!?]+" title="Prosím, zadajte platný názov, iba písmená, číslice, medzery a .,!?" required>
                        <button type="button" onclick="deleteParagraph(this)">Vymaž Paragraf</button>
                    </div>
                @endforeach
            @else
                <div class="paragraphInputContainer">
                    <input type="text" class="paragraphInput" name="content[]" pattern="[A-Za-z0-9\s.,!?]+" title="Prosím, zadajte platný názov, iba písmená, číslice, medzery a .,!?" required>
                    <button type="button" onclick="deleteParagraph(this)">Vymaž paragraf</button>
                </div>
            @endif
        </div>
        <button type="button" onclick="addParagraph()">Pridaj paragraf</button>
        <button type="submit">Vytvor recenziu</button>
    </form>
</div>
</body>
</html>
