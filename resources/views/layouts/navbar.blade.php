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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          {{Auth::guard('dosen')->user()->nama}}
          @elseif (Str::length(Auth::guard('web')->user()) > 0)
          {{Auth::guard('web')->user()->nama}}
          @endif          
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user())    
          <li><a class="dropdown-item" href="/profil-dosen"><i class="fa-solid fa-circle-user"></i> Profil</a></li>
          <li><hr class="dropdown-divider"></li>
          @endif
          @endif          
          <form action="/logout" method="POST">
            @csrf
            <li>
              <button type="submit" class="dropdown-item" href="#">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
            </li>
          </form>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->