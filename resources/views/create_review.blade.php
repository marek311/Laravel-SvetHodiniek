<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Review</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<div class="container-h-center">
    <h1>Create Review</h1>
</div>
<div class="form-container">
    <form action="{{ route('review.create') }}" method="post" id="createReviewForm">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="picture">Picture URL:</label>
        <input type="url" id="picture" name="picture" nullable>
        <div id="paragraphsContainer">
            <label for="content">Paragraph:</label>
            <div class="paragraphInputContainer">
                <input type="text" class="paragraphInput" name="content[]" required>
                <button type="button" onclick="deleteParagraph(this)">Delete Paragraph</button>
            </div>
        </div>
        <button type="button" onclick="addParagraph()">Add Paragraph</button>
        <button type="submit">Create Review</button>
    </form>
</div>
<script>
    function addParagraph() {
        const container = document.getElementById('paragraphsContainer');
        const newContainer = document.createElement('div');
        newContainer.classList.add('paragraphInputContainer');
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.classList.add('paragraphInput');
        newInput.name = 'content[]';
        newInput.required = true;
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Delete Paragraph';
        deleteButton.onclick = function () {
            deleteParagraph(this);
        };
        newContainer.appendChild(document.createElement('br'));
        newContainer.appendChild(document.createTextNode('Paragraph: '));
        newContainer.appendChild(newInput);
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
