<!-- Footer part start -->
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<footer class="footer-area bg-light text-dark pt-5 pb-3">
    <div class="container">
        <div class="row g-4 justify-content-lg-between">
            
            <!-- Logo and description -->
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                <div class="single-footer-widget footer_1 pe-lg-4">
                    <a href="/course" class="d-inline-block transition-normal mb-3"> 
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="hover-opacity" style="max-height: 100px; width: auto;"> 
                    </a>
                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        Plateforme e-learning innovante offrant des cours de qualité pour votre développement professionnel et personnel.
                    </p>
                    <div class="social-icons d-flex gap-3">
                        <a href="#" class="text-muted hover-dark transition-normal fs-5">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-muted hover-dark transition-normal fs-5">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-muted hover-dark transition-normal fs-5">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-muted hover-dark transition-normal fs-5">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact information -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="single-footer-widget footer_2">
                    <h4 class="mb-4 fs-5 fw-bold text-uppercase letter-spacing-1">
                        Contactez-nous
                    </h4>
                    <ul class="list-unstyled contact-info">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt mt-1 me-2 fs-6 text-dark"></i>
                            <span class="text-muted"> Route Tunis km 11, Sfax </span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-phone mt-1 me-2 fs-6 text-dark"></i>
                            <span class="text-muted">+123 456 7890</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-envelope mt-1 me-2 fs-6 text-dark"></i>
                            <span class="text-muted">contact@elearning-site.com</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="fas fa-clock mt-1 me-2 fs-6 text-dark"></i>
                            <span class="text-muted">Lundi-Vendredi: 9h-18h</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright section -->
        <div class="border-top border-light mt-5 pt-4">
            <div class="row align-items-center gy-3">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted fs-14">
                        &copy; 2025 E-Learning. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="d-flex gap-3 justify-content-center justify-content-md-end">
                        <a href="#" class="text-muted hover-dark transition-normal text-decoration-none fs-14">
                            Politique de confidentialité
                        </a>
                        <a href="#" class="text-muted hover-dark transition-normal text-decoration-none fs-14">
                            Conditions d'utilisation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!-- Footer part end -->