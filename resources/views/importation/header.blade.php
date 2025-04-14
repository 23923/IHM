
<!--::header part start::-->
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
</head>
     <!--::header part start::-->
<!--::header part start::-->
<!--::header part start::-->
<header class="main_menu single_page_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand logo_1" href="index.html"> 
                        <img src="{{ asset('img/single_page_logo.png') }}" alt="logo"> 
                    </a>
                    <a class="navbar-brand logo_2" href="index.html"> 
                        <img src="{{ asset('img/logo.png') }}" alt="logo"> 
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item justify-content-end"
                        id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center">
                            @php
                                $categories = App\Models\Categorie::with('scategories')->get();
                            @endphp
                            
                            @foreach($categories as $category)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $category->id }}" 
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $category->nomcategorie }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                                    @foreach($category->scategories as $subcategory)
                                        <a class="dropdown-item" href="{{ route('course', ['scategorie' => $subcategory->id]) }}">
                                            {{ $subcategory->nomscategorie }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                            
                            

                         

                            <li class="d-none d-lg-block">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn_1" >
            Logout
        </button>
    </form>
</li>



                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
