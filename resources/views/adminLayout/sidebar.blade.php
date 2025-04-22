<head>
    
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
</head>
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
  <a href="" class="logo">
    <img
      src="{{ asset('img/dasbord.png')  }}"
      alt="navbar brand"
      class="navbar-brand"
      height="70"
    />
  </a>
  <h1 class="school-title" style="color: white; margin: 0; padding-left: 15px;">School</h1>
  <div class="nav-toggle">
    <button class="btn btn-toggle toggle-sidebar">
      <i class="gg-menu-right"></i>
    </button>
    <button class="btn btn-toggle sidenav-toggler">
      <i class="gg-menu-left"></i>
    </button>
  </div>
  <button class="topbar-toggler more">
    <i class="gg-more-vertical-alt"></i>
  </button>
</div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
     
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">les listes</h4>
          </li>
          @auth

          @if(auth()->user()->isAdmin())

          <li class="nav-item">
              <a href="/list" title="Go to Categories">
                <i class="fas fa-layer-group"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/souscategories" title="Go to Categories">
                <i class="fas fa-layer-group"></i>
                <p>Sous Categories</p>
              </a>
            </li>
           
             
            <li class="nav-item">
              <a href="/admin/candidats" title="Go to Categories">
                <i class="fas fa-layer-group"></i>
                <p>Gérer candidats</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/formateurs" title="Go to Categories">
                <i class="fas fa-layer-group"></i>
                <p>Gérer formateurs</p>
              </a>
            </li>
            @endif
            @if(auth()->user()->isFormateur())

            <li class="nav-item">
              <a href="/formations" title="Go to Categories">
                <i class="fas fa-layer-group"></i>
                <p>Formations</p>
              </a>
            </li>
            @endif
            @endauth
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->

  
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Kaiadmin JS -->
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/setting-demo.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>
<script>
  $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(231, 141, 22, 0.14)",
  });

  $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
  });

  $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
  });
</script>
