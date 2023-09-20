<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('/assets/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
</head>
<body class="layout-top-nav">
    <div class="wrapper">
        
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
          <div class="container-fluid">             
            <div class="collapse navbar-collapse order-3" id="navbarCollapse"> 

              <ul class="navbar-nav">
                @if (Str::length(Auth::guard('dosen')->user()) > 0)         
                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Penilaian</a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item">Kerja Praktek</a></li>
                    <li><a href="/penilaian-sempro" class="dropdown-item">Proposal</a></li>                    
                    <li><a href="#" class="dropdown-item">Skripsi</a></li>                    
                  </ul>
                </li>

                @if (Str::length(Auth::guard('dosen')->user()) > 0) 
                @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Seminar</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      <li>                        
                        <a href="/form-kp" class="dropdown-item">Kerja Praktek</a>
                      </li>
                      <li><a href="/form-sempro" class="dropdown-item">Proposal</a></li>                    
                      <li><a href="#" class="dropdown-item">Skripsi</a></li>                    
                    </ul>
                </li>
                @endif
                @endif
                @endif

                @if (Str::length(Auth::guard('web')->user()) > 0) 
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Jurusan</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      <li>                        
                        <a href="/role" class="dropdown-item">Hak Akses</a>
                      </li>
                      <li><a href="/prodi" class="dropdown-item">Program Studi</a></li>                    
                      <li><a href="/konsentrasi" class="dropdown-item">Konsentrasi</a></li>                    
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Pengguna</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      <li>                        
                        <a href="/dosen" class="dropdown-item">Dosen</a>
                      </li>
                      <li><a href="/mahasiswa" class="dropdown-item">Mahasiswa</a></li>                    
                      <li><a href="/user" class="dropdown-item">Staff Jurusan</a></li>                    
                    </ul>
                </li>
                @endif

              </ul>

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
                    <li><a class="dropdown-item" href="/profil-dosen"><i class="bi bi-person"></i> Profil</a></li>
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

            </div>
          </div>
        </nav>
                                
          <div class="content-wrapper">            
            <div class="content-header">
              <div class="container">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    @yield('sub-title')
                  </div>
                </div>
              </div>
            </div>

            <div class="content">
              <div class="container">
                @yield('content')
              </div>
            </div>    
          </div>          
      
        <footer class="main-footer">            
            <strong>Copyright &copy; Jurusan Teknik Elektro</strong>
        </footer>
      </div>

  <script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
  <script src="{{asset('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
  @stack('scripts')
</body>
</html>