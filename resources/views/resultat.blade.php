<!doctype html>
<html lang="en">
<head>
    <!-- Meta tags et CSS comme avant -->
    <title>Quiz: {{ $quiz->title }}</title>
</head>
<body>
    @include('importation.header')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Résultats du quiz: {{ $quizz->title }}</h2>
        </div>
        <div class="card-body">
            <div class="alert alert-{{ $passed ? 'success' : 'danger' }}">
                <h4 class="alert-heading">
                    {{ $passed ? 'Félicitations!' : 'Dommage...' }}
                </h4>
                <p>
                    Vous avez obtenu {{ $score }}/{{ $total }} ({{ $percentage }}%)
                    <br>
                    Score minimum pour réussir: {{ $quizz->passing_score }}%
                </p>
            </div>
            
            <a href="{{ route('formation.show', $quizz->formation_id) }}" class="btn btn-primary">
                Retour à la formation
            </a>
        </div>
    </div>
</div>
</body>
</html>