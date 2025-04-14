<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Login | Mantis Bootstrap 5 Admin Template</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('style_authentification/assets/images/favicon.svg') }}" type="image/x-icon"> <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet"  href="{{ asset('style_authentification/assets/fonts/tabler-icons.min.css') }}" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet"  href="{{ asset('style_authentification/assets/fonts/feather.css') }}" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{ asset('style_authentification/assets/fonts/fontawesome.css') }}" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{ asset('style_authentification/assets/fonts/material.css') }}" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{ asset('style_authentification/assets/css/style.css') }}" id="main-style-link" >
<link rel="stylesheet" href="{{ asset('style_authentification/assets/css/style-preset.css') }}" >

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="/register" class="link-primary">Vous n'avez pas de compte ?</a>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
              @csrf
              
              <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password" placeholder="Password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              
              <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                  <input class="form-check-input input-primary" type="checkbox" 
                         name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label text-muted" for="remember">Keep me signed in</label>
                </div>
              </div>
              
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="{{ asset('style_authentification/assets/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('style_authentification/assets/js/plugins/simplebar.min.js') }}"></script>
  <script src="{{ asset('style_authentification/assets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('style_authentification/assets/js/fonts/custom-font.js') }}"></script>
  <script src="{{ asset('style_authentification/assets/js/pcoded.js') }}"></script>
  <script src="{{asset('style_authentification/assets/js/plugins/feather.min.js')}}"></script>

  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  
    
 
</body>
<!-- [Body] end -->

</html>