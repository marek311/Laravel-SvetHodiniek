document.addEventListener('DOMContentLoaded', function () {
    const pictureFileInput = document.getElementById('pictureFile');
    const fileNamePlaceholder = document.getElementById('file-name-placeholder');

    if (pictureFileInput) pictureFileInput.addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const selectedFile = event.target.files[0];
        if (selectedFile) fileNamePlaceholder.textContent = selectedFile.name;
        else fileNamePlaceholder.textContent = '';
    }
});
