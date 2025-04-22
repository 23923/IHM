<!-- Navbar Header -->
 <head><link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
</head>
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
  <div class="container-fluid">
   

    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
     
  
    

      <li class="nav-item topbar-user dropdown hidden-caret">
        <a
          class="dropdown-toggle profile-pic"
          data-bs-toggle="dropdown"
          href="#"
          aria-expanded="false"
        >
        
          <span class="profile-username">
            <span class="op-7">Hi,</span>
            <span class="fw-bold">{{ Auth::user()->name }}</span>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-user animated fadeIn">
          <div class="dropdown-user-scroll scrollbar-outer">
            <li>
              <div class="user-box">
             
                <div class="u-text">
                  <h4>{{ Auth::user()->name }}</h4>

                  <p class="text-muted">{{ Auth::user()->email }}</p>
                  <a
                  href="/profile/{{ auth()->id() }}"
                                      class="btn btn-xs btn-secondary btn-sm"
                    >View Profile</a
                  >
                </div>
              </div>
            </li>
            <li>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('profile', ['profile' => Auth::id()]) }}">My Profile</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="dropdown-item" href="{{ route('logout') }}" 
             onclick="event.preventDefault(); this.closest('form').submit();">
            Logout
          </a>
        </form>
      </li>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<!-- End Navbar -->

<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
