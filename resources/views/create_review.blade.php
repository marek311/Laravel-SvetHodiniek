<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Review</title>
    <link rel="stylesheet" href="{{ asset('styling_editPage.css') }}">
</head>
<body>
<a href="{{ route('reviews') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Create Review</h1>
</div>
<div class="form-container">
    <form action="{{ route('review.create') }}" method="post" id="createReviewForm" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="pictureFile">Picture File:</label>
        <input type="file" id="pictureFile" name="pictureFile" accept="image/*" required>
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
