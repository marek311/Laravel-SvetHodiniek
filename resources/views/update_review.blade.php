<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
    <title>{{ $review->watch_name }} edit review</title>
</head>
<body>
<a href="{{ route('reviews') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<h1>Edit Review</h1>
<form method="post" action="{{ route('review.update', ['watch_name' => $review->watch_name]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="title">Watch Name:</label>
    <input type="text" id="title" name="title" value="{{ $review->watch_name }}" required>
    <div id="paragraphsContainer">
        @foreach ($review->paragraphs as $index => $paragraph)
            <div class="paragraphInputContainer">
                <label for="content{{ $index }}">Review Content:</label>
                <textarea id="content{{ $index }}" name="content[{{ $index }}]">{{ $paragraph->paragraph_text }}</textarea>
                <button type="button" onclick="deleteParagraph(this)">Delete Paragraph</button>
            </div>
        @endforeach
    </div>
    <button type="button" onclick="addParagraph()">Add Paragraph</button>
    <label for="pictureFile">Picture File:</label>
    <input type="file" id="pictureFile" name="pictureFile" accept="image/*" required>
    <button type="submit">Update Review</button>
</form>
<script>
    function addParagraph() {
        const container = document.getElementById('paragraphsContainer');
        const newContainer = document.createElement('div');
        newContainer.classList.add('paragraphInputContainer');
        const newTextarea = document.createElement('textarea');
        newTextarea.name = 'content[]';
        newContainer.appendChild(document.createElement('br'));
        newContainer.appendChild(document.createTextNode('Review Content: '));
        newContainer.appendChild(newTextarea);
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Delete Paragraph';
        deleteButton.onclick = function () {
            deleteParagraph(this);
        };
        newContainer.appendChild(deleteButton);
        container.appendChild(newContainer);
    }
    function deleteParagraph(button) {
        const container = button.parentNode;
        const paragraphsContainer = document.getElementById('paragraphsContainer');
        paragraphsContainer.removeChild(container);
    }
</script>
</body>
</html>
