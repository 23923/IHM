<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion | Mantis</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Public Sans', sans-serif;
      background: linear-gradient(135deg, #4c83ff, #00c9a7);
      margin: 0;
    }

    .navbar-custom {
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      padding: 1rem 2rem;
    }

    .navbar-custom .nav-link {
      color: #333 !important;
      font-weight: 500;
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
      max-width: 450px;
      animation: fadeInUp 0.6s ease-in-out;
    }

    .auth-card h3 {
      font-weight: bold;
      color: #4c83ff;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      transition: 0.3s;
    }

    .form-control:focus {
      border-color: #4c83ff;
      box-shadow: 0 0 0 0.2rem rgba(76, 131, 255, 0.25);
    }

    .btn-primary {
      background: linear-gradient(to right, #4c83ff, #00c9a7);
      border: none;
      padding: 10px;
      border-radius: 10px;
      font-weight: bold;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #00c9a7, #4c83ff);
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
      <a class="navbar-brand text-primary fw-bold" href="#">Mantis</a>
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

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="remember"
                 {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label text-muted" for="remember">Rester connecté</label>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
      </form>

      <div class="mt-3 text-center">
        <a href="/register" class="text-decoration-none text-primary">Vous n’avez pas de compte ? Créez-en un</a>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
