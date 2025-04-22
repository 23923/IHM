<!DOCTYPE html>
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
    <style>
    body {
      font-family: 'Public Sans', sans-serif;
      /* Remplacement du gradient par l'image de fond */
      background-image: url("{{ asset('img/background.jpg') }}");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      margin: 0;
    }

    /* Ajout d'un overlay semi-transparent pour améliorer la lisibilité */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: -1;
    }

    .navbar-custom {
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      padding: 1rem 2rem;
    }

    .navbar-custom .nav-link {
      color: #333 !important;
      font-weight: 300px!important;
    }

    .navbar-custom .nav-link:hover {
      color:rgb(241, 102, 16) !important;
    }
    .custom-link-color {
      color:rgb(1, 27, 83);
}
.custom-link-color:hover {
  color:rgb(241, 102, 16) !important;
  text-decoration: none;
}

    .navbar-custom .btn-primary {
      background: linear-gradient(to right, #4c83ff, #00c9a7);
      border: none;
      border-radius: 20px;
      padding: 6px 16px;
      font-weight: 500;
    }

    .auth-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .auth-card {
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      animation: fadeInUp 0.6s ease-in-out;
    }

    .auth-card h3 {
      font-weight: bold;
      color:rgb(1, 27, 83);
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      transition: 0.3s;
    }

    .form-control:focus {
      border-color:rgb(2, 8, 67);
      box-shadow: 0 0 0 0.2rem rgba(3, 24, 74, 0.25);
    }

    .btn-primary {
      background: linear-gradient(to right,rgb(225, 141, 6),rgb(2, 4, 51));
      border: none;
      padding: 10px;
      border-radius: 10px;
      font-weight: bold;
      
    }
    .btn-primary {
  width: 200px;  
  height: auto; 
   
}
.d-grid {
    display: flex;
    justify-content: center; /* Centre horizontalement */
}
    .btn-primary:hover {
      background: linear-gradient(to right,rgb(225, 141, 6),rgb(2, 4, 51));
      transform: scale(1.02);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
      
    }
  </style>
</head>
<body>

  <!-- Navbar personnalisée -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
    <img src="{{ asset('img/logo.png') }}" alt="logo" style="max-height: 80px; width: auto;"> 
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Créer un compte</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Formulaire de connexion -->
  <div class="auth-wrapper">
    <div class="auth-card">
      <h3 class="mb-3">Connexion</h3>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Adresse email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror"
                 id="email" name="email" value="{{ old('email') }}" required autofocus>
          @error('email')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Mot de passe</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror"
                 id="password" name="password" required>
          @error('password')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>



        <div class="d-grid">
          <button type="submit"  class="btn_1">Se connecter</button>
        </div>
      </form>

      <div class="mt-3 text-center">
  <a href="/register" class=" custom-link-color">Vous n'avez pas de compte ? Créez-en un</a>
</div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>