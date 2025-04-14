<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $formation->titre }} - Détails</title>
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
</head>

<body>
    @include('importation.header')

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Détails de la formation</h2>
                            <p>Home<span>/</span>Formations<span>/</span>{{ $formation->titre }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!-- Course Details Area -->
    <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                        @if($formation->image)
                        <img src="{{ $formation['image'] }}" class="special_img" alt="{{ $formation['titre'] }}">
                        @else
                            <img class="img-fluid" src="{{ asset('img/single_cource.png') }}" alt="Image par défaut">
                        @endif
                    </div>
                    <div class="content_wrapper">
                        <h4 class="title_top">Description</h4>
                        <div class="content">
                            {{ $formation->description ?? 'Aucune description disponible.' }}
                        </div>

                    

                        @if($formation->programme)
                        <h4 class="title">Programme</h4>
                        <div class="content">
                            {!! nl2br(e($formation->programme)) !!}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Formateur</p>
                                    <span class="color">{{ $formation->formateur->name }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Catégorie</p>
                                    <span>{{ $formation->sousCategorie->nomscategorie }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Prix</p>
                                    <span>{{ $formation->prix ? $formation->prix.' €' : 'Gratuit' }}</span>
                                </a>
                            </li>
                         
                        </ul>
                                   
                        <a href="{{ route('quiz.show', $formation->id) }}" class="btn_1 d-block">
    Passer le test
</a>
<!--             
@if($formation->quiz)
    <a href="{{ route('quiz.show', $formation->id) }}" class="btn_1 d-block">
        Passer le test
    </a>
@else
    <button class="btn_1 d-block" disabled>
        Test non disponible
    </button>
@endif
                    -->
                </div>
            </div>
        </div>
    </section>

    @include('importation.footer')

    <!-- jquery plugins here-->
    <script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
