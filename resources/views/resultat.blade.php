<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School</title>
    <!-- Favicon avec asset() -->
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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