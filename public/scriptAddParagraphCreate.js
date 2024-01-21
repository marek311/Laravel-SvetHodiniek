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
