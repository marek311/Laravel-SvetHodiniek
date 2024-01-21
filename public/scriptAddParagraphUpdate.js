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
