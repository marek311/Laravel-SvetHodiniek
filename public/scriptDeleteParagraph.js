function deleteParagraph(button) {
    const container = button.parentNode;
    const paragraphsContainer = document.getElementById('paragraphsContainer');
    paragraphsContainer.removeChild(container);
}
