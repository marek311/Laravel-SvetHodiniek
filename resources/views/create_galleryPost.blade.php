<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pridanie nového postu</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<a href="{{ route('gallery') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Pridanie nového postu</h1>
</div>
<div class="form-container">
    <form action="{{ route('gallery.create') }}" method="post">
        @csrf
        <label for="name">Meno hodiniek:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" pattern="[A-Za-z0-9\s]+" title="Prosím, zadajte platné meno (písmená, číslice a medzery)" required>
        <label for="picture">URL adresa:</label>
        <input type="url" id="picture" name="picture" value="{{ old('picture') }}" title="Prosím, zadajte platnú URL adresu" required>
        <button type="submit">Pridať nový post</button>
    </form>
</div>
</body>
</html>
