<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Register</title>
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
    <!-- [ Pre-loader ] reste inchangé -->
    <div class="auth-main">
      <div class="auth-wrapper v3">
        <div class="auth-form">
          <div class="card my-5">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-end mb-4">
                <h3 class="mb-0"><b>Register</b></h3>
                <a href="/login" class="link-primary">Vous avez déjà un compte ?</a>
              </div>
              
              <form method="POST" action="/register" enctype="multipart/form-data">                @csrf
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Nom</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nom">
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                
                <div class="form-group mb-3">
                  <label class="form-label">Confirmer Password</label>
                  <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer Password">
                </div>
                
                <!-- Sélection du rôle -->
                <div class="form-group mb-3">
                  <label class="form-label">Vous êtes</label>
                  <select class="form-select @error('role') is-invalid @enderror" name="role" id="roleSelect" required>
                    <option value="">Sélectionnez votre rôle</option>
                    <option value="candidat" {{ old('role') == 'candidat' ? 'selected' : '' }}>Candidat</option>
                    <option value="formateur" {{ old('role') == 'formateur' ? 'selected' : '' }}>Formateur</option>
                  </select>
                  @error('role')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                
                <!-- Champs spécifiques formateur (cachés par défaut) -->
                <div id="formateurFields" style="display: none;">
                  <div class="form-group mb-3">
                    <label class="form-label">Spécialité</label>
                    <input type="text" class="form-control @error('specialite') is-invalid @enderror" name="specialite" value="{{ old('specialite') }}" placeholder="Votre spécialité">
                    @error('specialite')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  
                  <div class="form-group mb-3">
                    <label class="form-label">Compétences</label>
                    <textarea class="form-control @error('competence') is-invalid @enderror" name="competence" placeholder="Décrivez vos compétences">{{ old('competence') }}</textarea>
                    @error('competence')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  
                  <div class="form-group mb-3">
                    <label class="form-label">CV (PDF)</label>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" accept=".pdf">
                    @error('cv')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <small class="text-muted">Taille max: 2MB</small>
                  </div>
                </div>
                
                <div class="d-grid mt-3">
                  <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
              </form>
            </div>
          </div>
          <div class="auth-footer row"></div>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const roleSelect = document.getElementById('roleSelect');
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




 <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
  <div class="offcanvas-header bg-primary">
    <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="pct-body" style="height: calc(100% - 60px)">
    <div class="offcanvas-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-layout-sidebar f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Layout</h6>
                <span>Choose your layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse1">
            <div class="pct-content">
              <div class="pc-rtl">
                <p class="mb-1">Direction</p>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                  <label class="form-check-label" for="layoutmodertl">RTL</label>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-brush f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Mode</h6>
                <span>Choose light or dark mode</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse2">
            <div class="pct-content">
              <div class="theme-color themepreset-color theme-layout">
                <a href="#!" class="active" onclick="layout_change('light')" data-value="false"
                  ><span><img src="{{asset('style_authentification//assets/images/customization/default.svg')}}" alt="img"></span><span>Light</span></a
                >
                <a href="#!" class="" onclick="layout_change('dark')" data-value="true"
                  ><span><img src="{{asset('style_authentification/assets/images/customization/dark.svg')}}" alt="img"></span><span>Dark</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-color-swatch f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Color Scheme</h6>
                <span>Choose your primary theme color</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse3">
            <div class="pct-content">
                <div class="theme-color preset-color">
                    <a href="#!" class="active" data-value="preset-1">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 1</span>
                    </a>
                    <a href="#!" class="" data-value="preset-2">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 2</span>
                    </a>
                    <a href="#!" class="" data-value="preset-3">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 3</span>
                    </a>
                    <a href="#!" class="" data-value="preset-4">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 4</span>
                    </a>
                    <a href="#!" class="" data-value="preset-5">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 5</span>
                    </a>
                    <a href="#!" class="" data-value="preset-6">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 6</span>
                    </a>
                    <a href="#!" class="" data-value="preset-7">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 7</span>
                    </a>
                    <a href="#!" class="" data-value="preset-8">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 8</span>
                    </a>
                    <a href="#!" class="" data-value="preset-9">
                      <span><img src="{{ asset('style_authentification/assets/images/customization/theme-color.svg') }}" alt="img"></span>
                      <span>Theme 9</span>
                    </a>
                  </div>
            </div>
          </div>
        </li>
        <li class="list-group-item pc-boxcontainer">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-border-inner f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Layout Width</h6>
                <span>Choose fluid or container layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse4">
            <div class="pct-content">
              <div class="theme-color themepreset-color boxwidthpreset theme-container">
                <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img src="{{asset('style_authentification/assets/images/customization/default.svg')}}" alt="img"></span><span>Fluid</span></a>
                <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img src="{{asset('style_authentification/assets/images/customization/container.svg')}}" alt="img"></span><span>Container</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-typography f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Font Family</h6>
                <span>Choose your font family.</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse5">
            <div class="pct-content">
              <div class="theme-color fontpreset-color">
                <a href="#!" class="active" onclick="font_change('Public-Sans')" data-value="Public-Sans"
                  ><span>Aa</span><span>Public Sans</span></a
                >
                <a href="#!" class="" onclick="font_change('Roboto')" data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                <a href="#!" class="" onclick="font_change('Poppins')" data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                <a href="#!" class="" onclick="font_change('Inter')" data-value="Inter"><span>Aa</span><span>Inter</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="collapse show">
            <div class="pct-content">
              <div class="d-grid">
                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</body>
<!-- [Body] end -->

</html>