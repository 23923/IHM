<!doctype html>
<html lang="fr">
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du Quiz - {{ $quiz->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .result-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #e6e9f0 100%);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .score-display {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(to right,rgb(225, 141, 6),rgb(2, 4, 51));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 20px 0;
        }
        .retry-btn {
            background: linear-gradient(to right,rgb(225, 141, 6),rgb(2, 4, 51));
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: white !important;
        }
        .retry-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: white;
        }
        .sad-emoji {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .encouragement-text {
            color: #6c757d;
            font-style: italic;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @include('importation.header')

    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Résultat du Quiz 😞</h2>
                            <p>Vous n'avez pas réussi <strong>{{ $quiz->title }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center result-container animate__animated animate__fadeIn">
                <div class="sad-emoji">😞</div>
                <h2 class="mb-4">Votre Performance</h2>
                
                <div class="score-display">{{ $score }}%</div>
                
                <div class="mb-4">
                    <p class="fs-5">Malheureusement, vous n'avez pas atteint le score requis.</p>
                    <p class="encouragement-text">Ne vous découragez pas ! Chaque tentative est une occasion d'apprendre.</p>
                </div>
                
                <a href="{{ route('quiz.show', $quiz->formation_id) }}" 
                   class="btn retry-btn btn-lg mt-3">
                    <i class="fas fa-redo me-2"></i> Réessayer le quiz
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>