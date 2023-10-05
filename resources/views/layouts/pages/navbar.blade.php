  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Profil Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-sign-out-alt mr-2"></i>
          {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          {{-- <span class="dropdown-header">15 Notifications</span> --}}
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item" 
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
{{ __('Logout') }}
           
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
         
         
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->