<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  {{-- @include('layouts.navbar') --}}

  {{-- @include('layouts.sidebar') --}}
  <div class="atas">
  <nav class="main-header navbar navbar-expand-md ">
    <div class="container">             
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"> 
        <nav>
  <div class="container judul">
  <a href="">
  <img src="/assets/dist/img/unri.png" alt="" width="30" height="30" class="d-inline-block mr-2">
  </a>
    <a class="navbar-brand mt-1" href="#">SIA ELEKTRO
    </a>

  </div>
</nav>
        <ul class="navbar-nav">
          @if (Str::length(Auth::guard('dosen')->user()) > 0)         
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Penilaian</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow "style="border-radius:10px;">
              <li><a class="nav-item active" style="margin-left:-5px;" href="/penilaian-kp" class="dropdown-item">Kerja Praktek</a></li>
              <li><a class="nav-item"style="margin-left:-5px;" href="/penilaian-sempro" class="dropdown-item">Proposal</a></li>                    
              <li><a class="nav-item"style="margin-left:-5px;" href="/penilaian-skripsi" class="dropdown-item">Skripsi</a></li>                    
            </ul>
          </li>

          @if (Str::length(Auth::guard('dosen')->user()) > 0) 
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          <li class="nav-item dropdown jarak2">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Jadwal</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li>                        
                  <a href="/form-kp" class="dropdown-item">Kerja Praktek</a>
                </li>
                <li><a href="/form-sempro" class="dropdown-item">Proposal</a></li>                    
                <li><a href="/form-skripsi" class="dropdown-item">Skripsi</a></li>                    
              </ul>
          </li>
          @endif
          @endif
          @endif

          @if (Str::length(Auth::guard('web')->user()) > 0) 
          <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Jurusan</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li>                        
                  <a href="/role" class="dropdown-item">Hak Akses</a>
                </li>
                <li><a href="/prodi" class="dropdown-item">Program Studi</a></li>                    
                <li><a href="/konsentrasi" class="dropdown-item">Konsentrasi</a></li>                    
              </ul>
          </li>

          <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Pengguna</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
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
              <div>
              <ul class="dropdown-menu dropdown-menu-end"style="border-radius:10px;" aria-labelledby="navbarDropdown">
              @if (Str::length(Auth::guard('dosen')->user()) > 0)
              @if (Auth::guard('dosen')->user())    
              
              <li class="pp"><a class="dropdown-item" href="/profil-dosen"><i class="bi bi-person-circle mr-2"></i>Profil</a></li>
              @endif
              @endif 
              
              <form action="/logout" method="POST">
                  @csrf
                  <li>
                  <button type="submit" class="dropdown-item" href="#">
                      <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                  </button>
                  </li>
              </form>
              </ul>
              </div>
          </li>
      </ul>

      </div>
    </div>
  </nav>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @yield('isi')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer bg-dark">
  <div class="container">
  <strong>Copyright &copy; Jurusan Teknik Elektro</strong>
</div>
    <!-- Default to the left -->
    <!-- <strong>Copyright &copy; Jurusan Teknik Elektro</strong> -->
  </footer>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/assets/dist/js/demo.js')}}"></script>
@stack('scripts')
</body>
</html>
