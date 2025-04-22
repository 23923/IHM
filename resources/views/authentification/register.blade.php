<!DOCTYPE html>
<html lang="en">
<head>
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
      background-image: url("{{ asset('img/background.jpg') }}");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      margin: 0;
    }

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
      color: #4c83ff !important;
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
      max-width: 500px;
      animation: fadeInUp 0.6s ease-in-out;
    }

    .auth-card h3 {
      font-weight: bold;
      color: rgb(1, 27, 83);
      margin-bottom: 1.5rem;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      transition: 0.3s;
    }

    .form-control:focus {
      border-color: rgb(2, 8, 67);
      box-shadow: 0 0 0 0.2rem rgba(3, 24, 74, 0.25);
    }

    .btn-primary {
      background: linear-gradient(to right, rgb(225, 141, 6), rgb(2, 4, 51));
      border: none;
      padding: 10px;
      border-radius: 10px;
      font-weight: bold;
      width: 200px;
      height: auto;
    }

    .d-grid {
      display: flex;
      justify-content: center;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, rgb(225, 141, 6), rgb(2, 4, 51));
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

    .text-muted {
      color: #6c757d !important;
    }

    .link-primary {
      color: #4c83ff;
      text-decoration: none;
    }

    .link-primary:hover {
      text-decoration: underline;
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
            <a class="nav-link" href="/login">Se connecter</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Formulaire d'inscription -->
  <div class="auth-wrapper">
    <div class="auth-card">
      <h3 class="mb-3">Créer un compte</h3>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="/register" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="name" class="form-label">Nom</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Votre nom">
              @error('name')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" 
                     id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Votre email">
              @error('email')
                <span class="text-danger small">{{ $message }}</span>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Mot de passe</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" 
                 id="password" name="password" required autocomplete="new-password" placeholder="Mot de passe">
          @error('password')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
          <input type="password" class="form-control" id="password-confirm" 
                 name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer le mot de passe">
        </div>
        
        <div class="mb-3">
          <label for="role" class="form-label">Vous êtes</label>
          <select class="form-select @error('role') is-invalid @enderror" name="role" id="role" required>
            <option value="">Sélectionnez votre rôle</option>
            <option value="candidat" {{ old('role') == 'candidat' ? 'selected' : '' }}>Candidat</option>
            <option value="formateur" {{ old('role') == 'formateur' ? 'selected' : '' }}>Formateur</option>
          </select>
          @error('role')
            <span class="text-danger small">{{ $message }}</span>
          @enderror
        </div>
        
        <!-- Champs spécifiques formateur (cachés par défaut) -->
        <div id="formateurFields" style="display: none;">
          <div class="mb-3">
            <label for="specialite" class="form-label">Spécialité</label>
            <input type="text" class="form-control @error('specialite') is-invalid @enderror" 
                   id="specialite" name="specialite" value="{{ old('specialite') }}" placeholder="Votre spécialité">
            @error('specialite')
              <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="competence" class="form-label">Compétences</label>
            <textarea class="form-control @error('competence') is-invalid @enderror" 
                      id="competence" name="competence" rows="3" placeholder="Décrivez vos compétences">{{ old('competence') }}</textarea>
            @error('competence')
              <span class="text-danger small">{{ $message }}</span>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="cv" class="form-label">CV (PDF)</label>
            <input type="file" class="form-control @error('cv') is-invalid @enderror" 
                   id="cv" name="cv" accept=".pdf">
            @error('cv')
              <span class="text-danger small">{{ $message }}</span>
            @enderror
            <small class="text-muted">Taille max: 2MB</small>
          </div>
        </div>
        
        <div class="d-grid mt-4">
          <button type="submit" class="btn_1">Créer un compte</button>
        </div>
      </form>

      <div class="mt-3 text-center">
        <a href="/login" class="text-decoration-none text-primary">Vous avez déjà un compte ? Connectez-vous</a>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const roleSelect = document.getElementById('role');
      const formateurFields = document.getElementById('formateurFields');
      
      // Gérer l'affichage initial
      if (roleSelect.value === 'formateur') {
        formateurFields.style.display = 'block';
      }
      
      // Écouter les changements
      roleSelect.addEventListener('change', function() {
        if (this.value === 'formateur') {
          formateurFields.style.display = 'block';
        } else {
          formateurFields.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>