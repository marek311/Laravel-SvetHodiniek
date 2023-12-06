<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
    <title>{{ $review->watch_name }} edit review</title>
</head>
<body>
<h1>Edit Review</h1>
<form method="post" action="{{ route('review.update', ['watch_name' => $review->watch_name]) }}">
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
    <label for="picture">Picture URL:</label>
    <input type="text" id="picture" name="picture" value="{{ $review->picture }}">
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
