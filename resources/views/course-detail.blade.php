<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        :root {
            --primary-color:rgb(10, 2, 118);
            --secondary-color: #2c3e50;
            --accent-color: #2980b9;
            --light-color: #ecf0f1;
            --text-color: #34495e;
            --success-color: #27ae60;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background-color: #f9f9f9;
            line-height: 1.6;
        }
        
        .breadcrumb_bg {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            padding: 2.5rem 0;
            margin-bottom: 3rem;
        }
        
        .breadcrumb_iner_item h1 {
            color: white;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 2.2rem;
        }
        
        .breadcrumb_iner_item p.lead {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
        }
        
        .formation-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        
        .formation-content {
            padding: 2.5rem;
        }
        
        .formation-content h3 {
            color: var(--secondary-color);
            border-bottom: 2px solid var(--light-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .formation-content h3 i {
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        .programme-content {
            white-space: pre-line;
            line-height: 1.8;
        }
        
        .formation-sidebar {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        .formation-sidebar h4 {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-color);
        }
        
        .info-item {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-item span {
            color: var(--text-color);
        }
        
        .info-item strong {
            color: var(--secondary-color);
            font-weight: 600;
        }
        
        .text-success {
            color: var(--success-color) !important;
        }
        
        .test-section {
            background: white;
            border-radius: 8px;
            padding: 3rem;
            margin: 3rem 0;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            border-top: 4px solid var(--primary-color);
        }
        
        .test-section h2 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .test-section p.lead {
            color: var(--text-color);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto 1.5rem;
        }
        
        .btn-test {
            background: var(--primary-color);
            color: white;
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn-test:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(41, 128, 185, 0.4);
            color: white;
        }
        
        .btn-test i {
            margin-right: 8px;
        }

.formation-image {
    max-width: 100%; 
    max-height: 100%; 
    width: auto;
    height: auto;
    object-fit: contain; 
    transition: transform 0.4s ease;
    display: block; 
    margin: 0 auto;
}

.formation-image[width] > [height] {
    height: 100%;
    width: auto;
}


@media (max-width: 768px) {
    .formation-image-container {
        height: 300px !important;
    }
    
    .formation-image {
        max-width: 95%;
        max-height: 95%;
    }
}

@media (max-width: 500px) {
    .formation-image-container {
        height: 250px !important;
    }
            
    .formation-content {
        padding: 1.5rem;
    }
            
    .test-section {
        padding: 2rem 1.5rem;
    }
}
    </style>
</head>

<body>
@include('importation.header')

@auth
    @if(auth()->user()->role === 'candidat')
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb_iner text-center">
                            <div class="breadcrumb_iner_item">
                                <h1>{{ $formation->titre }}</h1>
                                <p class="lead mb-0">Développez vos compétences avec notre formation professionnelle</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>

        <!-- Contenu principal -->
        <section class="container">
            <div class="row">
                <!-- Contenu de gauche -->
                <div class="col-lg-8">
                    <div class="formation-container">
                        <!-- Image de la formation -->
                        <div class="formation-image-container">
                            @if($formation->image)
                                <img src="{{ $formation['image'] }}" class="formation-image" alt="{{ $formation['titre'] }}">
                            @else
                                <img src="{{ asset('img/single_cource.png') }}" class="formation-image" alt="Formation {{ $formation->titre }}">
                            @endif
                        </div>
                        
                        <!-- Description -->
                        <div class="formation-content">
                            <h3><i class="fas fa-info-circle"></i> Description du cours</h3>
                            <div class="description-text">
                                {{ $formation->description ?? 'Aucune description disponible.' }}
                            </div>
                        </div>
                        
                        <!-- Programme -->
                        @if($formation->programme)
                        <div class="formation-content">
                            <h3><i class="fas fa-list-ol"></i> Programme détaillé</h3>
                            <div class="programme-content">
                                {!! nl2br(e($formation->programme)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Sidebar droite -->
                <div class="col-lg-4">
                    <div class="formation-sidebar sticky-top" style="top: 20px;">
                        <h4><i class="fas fa-info-circle"></i> Détails de la formation</h4>
                        
                        <div class="info-item">
                            <span><i class="fas fa-chalkboard-teacher"></i> Formateur</span>
                            <strong>{{ $formation->formateur->name }}</strong>
                        </div>
                        
                        <div class="info-item">
                            <span><i class="fas fa-layer-group"></i> Catégorie</span>
                            <strong>{{ $formation->sousCategorie->nomscategorie }}</strong>
                        </div>
                        
                        <div class="info-item">
                            <span><i class="fas fa-tags"></i> Prix</span>
                            <strong class="text-success">{{ $formation->prix ? $formation->prix.' €' : 'Gratuit' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section Test -->
            <div class="test-section">
                <h2>Évaluation finale</h2>
                <p class="lead">Testez vos connaissances acquises durant cette formation pour obtenir votre certification officielle.</p>
                
                <a href="{{ route('quiz.show', $formation->id) }}" class="btn-test">
                    <i class="fas fa-graduation-cap"></i>Commencer le test
                </a>
            </div>
        </section>
    @else
        <!-- Redirection vers la page de login pour les non-candidats -->
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
@else
    <!-- Redirection vers la page de login pour les utilisateurs non connectés -->
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

@include('importation.footer')

<!-- Scripts -->
<script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>