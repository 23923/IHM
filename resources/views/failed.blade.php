<!doctype html>
<html lang="en">
<head>
    <!-- Meta tags et CSS comme avant -->
    <title>Quiz: {{ $quiz->title }}</title>
</head>
<body>
@include('importation.header')
<section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Évaluation de la formation</h2>
                            <p>{{ $quiz->title }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="container text-center">
    <h2>Résultat du Quiz</h2>
    <p>Votre score : <strong>{{ $score }}%</strong></p>
    <p>Vous n'avez pas atteint le score requis pour obtenir le certificat.</p>
    <a href="{{ route('quiz.show', $quiz->formation_id) }}" class="btn btn-warning mt-3">Réessayer</a>
</div>
</body>
</html>
