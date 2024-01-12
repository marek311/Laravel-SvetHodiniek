<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hodinkársky slovník</title>
    <link rel="stylesheet" href="{{ asset('styling_general.css') }}">
    <link rel="stylesheet" href="{{ asset('styling_dictionary.css') }}">
</head>
<body>
@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('watchmakingTerm.createForm') }}" class="add-button">
            <button>Create Watchmaking Term</button>
        </a>
    @endif
@endauth
<a href="{{ route('home') }}" class="back-link">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gold" class="back-arrow" width="5%">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
</a>
<div class="container-h-center">
    <h1>Slovník hodinkára</h1>
</div>
<div class="container-h-center">
    <h2>Zopár pojmov zo slovníka nadšencov do hodiniek:</h2>
</div>
<div class="container-h-center">
    <h1>{{ count($watchmakingTerms) }}</h1>
</div>
<ul>
    @foreach($watchmakingTerms as $term)
        <li>
            <label for="{{ 'word' . $term->id }}" class="arrow-label">{{ $term->term }}</label>
            <input type="checkbox" id="{{ 'word' . $term->id }}" class="arrow-checkbox">
            <div class="term-details" data-term-id="{{ $term->id }}">

                <button class="edit-term-button" data-term-id="{{ $term->id }}">Edit</button>
                <textarea class="editable-explanation" style="display: none;">{{ $term->explanation }}</textarea>
                <button class="update-term-button" style="display: none;">Update</button>

                <div class="explanation">
                    <p>{{ $term->explanation }}</p>
                </div>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('watchmakingTerm.deleteForm', ['id' => $term->id]) }}" class="add-button">
                            <button class="delete-button" style="display: none;">Delete</button>
                        </a>
                    @endif
                @endauth
            </div>
        </li>
    @endforeach
</ul>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll('.arrow-checkbox');
        const termDetailsList = document.querySelectorAll('.term-details');
        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function () {
                termDetailsList.forEach((termDetails, i) => {
                    if (index === i) {
                        termDetails.querySelector('.explanation').style.display = this.checked ? 'block' : 'none';
                        termDetails.querySelector('.delete-button').style.display = this.checked ? 'block' : 'none';
                    } else {
                        termDetails.querySelector('.explanation').style.display = 'none';
                        termDetails.querySelector('.delete-button').style.display = 'none';
                    }
                });
            });
        });

        const editButtons = document.querySelectorAll('.edit-term-button');
        const updateButtons = document.querySelectorAll('.update-term-button');
        const editableExplanations = document.querySelectorAll('.editable-explanation');

        editButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                const termId = this.getAttribute('data-term-id');

                // Fetch term details via Ajax
                $.ajax({
                    url: `/dictionary/get-term-details/${termId}`,
                    type: 'GET',
                    success: function (response) {
                        // Show editable fields and hide non-editable ones
                        editableExplanations[index].style.display = 'block';
                        editableExplanations[index].value = response.explanation;

                        updateButtons[index].style.display = 'block';
                    }
                });
            });
        });

        updateButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                const termId = editButtons[index].getAttribute('data-term-id');
                const updatedExplanation = editableExplanations[index].value;

                // Update explanation via Ajax
                $.ajax({
                    url: `/dictionary/update-term/${termId}`,
                    type: 'POST',
                    data: {
                        explanation: updatedExplanation,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        // Hide edit fields and display updated explanation
                        editableExplanations[index].style.display = 'none';
                        updateButtons[index].style.display = 'none';

                        // Fetch and update term details dynamically
                        fetchAndUpdateTermDetails(termId, index);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        function fetchAndUpdateTermDetails(termId, index) {
            // Fetch term details via Ajax
            $.ajax({
                url: `/dictionary/get-term-details/${termId}`,
                type: 'GET',
                success: function (response) {
                    // Display the updated term and explanation dynamically
                    const termDetailsContainer = termDetailsList[index];

                    if (termDetailsContainer) {
                        const explanationElement = termDetailsContainer.querySelector('.explanation');
                        const paragraphElement = explanationElement.querySelector('p');

                        if (explanationElement && paragraphElement) {
                            paragraphElement.innerText = response.explanation;

                            // Show the updated term details container
                            termDetailsContainer.style.display = 'block';
                        } else {
                            console.error('Error: explanationElement or paragraphElement not found.');
                        }
                    } else {
                        console.error('Error: termDetailsContainer not found.');
                    }
                }
            });
        }

    });


</script>
</body>
</html>
