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
<div class="container-h-center">
    <h1>Slovník hodinkára</h1>
</div>
<div class="container-h-center">
    <h2>Zopár pojmov zo slovníka nadšencov do hodiniek:</h2>
</div>
<ul>
    @foreach($watchmakingTerms as $term)
        <li>
            <label for="{{ 'word' . $term->id }}" class="arrow-label">{{ $term->term }}</label>
            <input type="checkbox" id="{{ 'word' . $term->id }}" class="arrow-checkbox">
            <div class="explanation" data-term-id="{{ $term->id }}">
                <p>{{ $term->explanation }}</p>
            </div>
        </li>
    @endforeach
</ul>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll('.arrow-checkbox');
        const explanations = document.querySelectorAll('.explanation');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                explanations.forEach(explanation => {
                    explanation.style.display = 'none';
                });
                const termId = this.id.replace('word', '');
                const selectedExplanation = document.querySelector(`[data-term-id="${termId}"]`);
                selectedExplanation.style.display = this.checked ? 'block' : 'none';
            });
        });
    });
</script>
</body>
</html>
