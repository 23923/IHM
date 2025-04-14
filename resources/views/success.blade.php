<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats du Quiz</title>
</head>
<body>
    @include('importation.header')

    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Félicitations ! 🎉</h2>
                            <p>Vous avez réussi le quiz <strong>{{ $quiz->title }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container text-center">
        <h3>Votre Score : <strong>{{ $score }}%</strong></h3>
        @if ($certificat)
            <p>Vous avez obtenu votre <strong>certificat de réussite</strong> !</p>
            <a href="{{ route('certificat.show', ['quiz' => $quiz->id]) }}" class="btn btn-success">
    Voir mon certificat
</a>   @endif
    </div>
</body>
</html>
