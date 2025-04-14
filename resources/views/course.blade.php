<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Etrain</title>
    <!-- Favicon avec asset() -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
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
    <style>
        /* Style pour uniformiser les images */
        .special_img {
            width: 100%;
            height: 200px; /* Ajustez cette valeur selon vos besoins */
            object-fit: cover; /* Pour conserver les proportions de l'image */
            object-position: center; /* Pour centrer l'image */
        }
        
        /* Pour s'assurer que toutes les cartes ont la même hauteur */
        .single_special_cource {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .special_cource_text {
            flex: 1;
        }
        
         /* Style pour le menu déroulant du niveau */
         
    .dropdown-menu {
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
        min-width: 220px;
        animation: fadeInUp 0.4s ease-out;
        position: absolute;
        z-index: 1000;
        left: 0; /* Aligne le menu à gauche */

    }

    /* Animation pour faire apparaître le menu déroulant */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        padding: 12px 20px;
        border-radius: 6px;
        font-weight: 500;
        background-color: transparent;
        transition: all 0.3s ease;
        cursor: pointer;

    }


    .dropdown-toggle::after {
        content: ' ▼';
        font-size: 0.8em;
        transition: transform 0.3s;
        margin-left: 5px;
    }

    .dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }

    /* Ajout d'un effet d'ombre portée autour du menu au survol */
    .dropdown:hover .dropdown-menu {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
        
    .niveau-box {
        background-color:rgb(226, 224, 224); /* Fond clair pour la boîte */
        border-radius: 10px; 
        padding: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
        max-width: 250px;
        margin-left: 0; /* Aligne à gauche */
        margin-right: auto; /* Évite un éventuel alignement à droite */
    }
        /* Style pour les badges de niveau */
        .badge-niveau {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-bottom: 10px;
            display: inline-block;
        }
        
        .debutant {
            background-color: #4caf50;
            color: white;
        }
        
        .intermediaire {
            background-color: #2196f3;
            color: white;
        }
        
        .avance {
            background-color: #f44336;
            color: white;
        }
        /* Forcer la couleur du texte à noir pour l'élément 'a' avec la classe 'niveau' */
a.nav-link.niveau {
    color: black !important; /* Texte en noir avec priorité */
    text-align: left; /* Aligner le texte à gauche */

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
                            <h2>Nos cours</h2>
                            <p>Home<span>/</span>Cours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
 


    <section class="special_cource padding_top">
        <div class="container">
            <!-- Dropdown Niveau -->
            <div class="niveau-box">
<div class="dropdown">
    <a class="nav-link niveau" href="#" id="niveauDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Request::query('niveau') ? ucfirst(Request::query('niveau')) : 'Sélectionnez un niveau' }}
    </a>
    <div class="dropdown-menu" aria-labelledby="niveauDropdown">
        <a class="dropdown-item filter-level-item" data-value="" style="color: black ;">Tous les niveaux</a>
        @isset($niveaux)
            @foreach($niveaux as $niveau)
                @if($niveau) 
                    <a class="dropdown-item filter-level-item" data-value="{{ $niveau }}">
                        {{ ucfirst($niveau) }}
                    </a>
                @endif
            @endforeach
        @endisset
    </div>
</div>
</div>

<script>
    // Ajout de l'événement pour changer de niveau
    document.querySelectorAll('.filter-level-item').forEach(item => {
        item.addEventListener('click', function() {
            let niveau = this.getAttribute('data-value');
            let url = new URL(window.location.href);
            if (niveau) {
                url.searchParams.set('niveau', niveau);
            } else {
                url.searchParams.delete('niveau');
            }
            window.location.href = url;
        });
    });
</script>

            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <h2>Formations</h2>
                    </div>
                </div>
            </div>
          

        
            @if(isset($sousCategorie))
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="text-center">Formations en {{ $sousCategorie->nomscategorie }}</h3>
                    </div>
                </div>
            @endif
            
            <div class="row">
                @forelse($formations as $formation)
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="single_special_cource">
                            <img src="{{ $formation['image'] }}" class="special_img" alt="{{ $formation['titre'] }}">
                            <div class="special_cource_text">
                                <!-- Badge de niveau amélioré -->
                                @if($formation->niveau)
                                    <span class="badge-niveau 
                                        {{ $formation->niveau == 'débutant' ? 'debutant' : '' }}
                                        {{ $formation->niveau == 'intermédiaire' ? 'intermediaire' : '' }}
                                        {{ $formation->niveau == 'avancé' ? 'avance' : '' }}">
                                        {{ $formation->niveau }}
                                    </span>
                                @endif
                                <h4>{{ $formation['prix'] ?? 'Gratuit' }}</h4>
                                <a href="{{ route('course.show',$formation->id) }}">
                                    <h3>{{ $formation['titre'] }}</h3>
                                </a>
                                <div class="author_info">
                                    <div class="author_info_text">
                                        <p>Formateur:</p>
                                        <h5>{{ $formation['formateur']['name'] }}</h5>
                                    </div>
                               <!-- Affichage de la note et du formulaire de notation pour les candidats -->
                        @if(auth()->user()->role === 'candidat')
                            @php
                                // Récupérer la note de l'utilisateur pour cette formation
                                $userRating = $formation->ratings->where('user_id', auth()->id())->first();
                                
                                // Calculer la note moyenne
                                $averageRating = number_format($formation->ratings->avg('note') ?? 0, 1);
                            @endphp

                            <div class="author_rating">
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <a href="#" class="star" data-value="{{ $i }}" @if($userRating && $i <= $userRating->note) style="pointer-events: none;" @endif>
                                            <img src="{{ asset($userRating && $i <= $userRating->note ? 'img/icon/color_star.svg' : 'img/icon/star.svg') }}" 
                                                 alt="{{ $i }} star"
                                                 class="star-icon"
                                                 data-star="{{ $i }}">
                                        </a>
                                    @endfor
                                </div>
                                <p>{{ $averageRating }} ({{ $formation->ratings->count() }} avis)</p>
                                
                                <!-- Formulaire pour enregistrer la note -->
                                <form id="ratingForm-{{ $formation->id }}" action="{{ route('ratings.store') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="formation_id" value="{{ $formation->id }}">
                                    <input type="hidden" name="note" id="noteInput-{{ $formation->id }}" value="{{ $userRating->note ?? '' }}">
                                </form>
                            </div>

                           <script>
    // Gestion des étoiles de notation
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function(e) {
            e.preventDefault();
            const value = this.getAttribute('data-value');
            const formationId = this.closest('.single_special_cource').querySelector('input[name="formation_id"]').value;
            const formId = `ratingForm-${formationId}`;
            
            // Mise à jour de l'affichage des étoiles
            const ratingContainer = this.closest('.rating');
            ratingContainer.querySelectorAll('.star-icon').forEach(icon => {
                const starValue = icon.getAttribute('data-star');
                icon.src = (starValue <= value) 
                    ? "{{ asset('img/icon/color_star.svg') }}" 
                    : "{{ asset('img/icon/star.svg') }}";
            });
            
            // Soumettre le formulaire
            document.getElementById(`noteInput-${formationId}`).value = value;
            document.getElementById(formId).submit();
        });
    });
</script>
                        @endif


    </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Aucune formation disponible</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('importation.footer')
</body>
</html>