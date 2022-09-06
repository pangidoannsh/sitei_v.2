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
  <link rel="stylesheet" href="{{asset('/assets/dataTables/datatables.min.css')}}">

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <div class="atas">
  <nav class="main-header navbar navbar-expand-md fixed-top bayangan">
    <div class="container">             
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"> 
        <nav>
  <div class="container judul">
  <a href="">
  <img src="/assets/dist/img/unri.png" alt="" width="30" height="30" class="d-inline-block mr-2">
  </a>
    <a class="navbar-brand mt-1" href="#">SIA JTE
    </a>

  </div>
</nav>
        <ul class="navbar-nav">
          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/penilaian">Seminar</a>
          </li>
          @endif

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/persetujuan-koordinator">Persetujuan</a>
          </li>
          @endif
          @endif

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/persetujuan-kaprodi">Persetujuan</a>
          </li>
          @endif
          @endif

          @if (Str::length(Auth::guard('web')->user()) > 0) 
          @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/form">Jadwal</a>
          </li>
          {{-- <li class="nav-item dropdown jarak2">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Jadwal</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li>                        
                  <a href="/form-kp" class="dropdown-item">Kerja Praktek</a>
                </li>
                <li><a href="/form-sempro" class="dropdown-item">Proposal</a></li>                    
                <li><a href="/form-skripsi" class="dropdown-item">Skripsi</a></li>                    
              </ul>              
          </li> --}}
          @endif          
                
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
              {{-- @if (Str::length(Auth::guard('dosen')->user()) > 0)
              @if (Auth::guard('dosen')->user())    
              
              <li class="pp"><a class="dropdown-item" href="/profil-dosen"><i class="bi bi-person-circle mr-2"></i>Profil</a></li>
              @endif
              @endif  --}}
              
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
        <div>
          <div>
            <h4>@yield('sub-title')</h4><hr>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @yield('content')
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
<script src="{{asset('/assets/dataTables/datatables.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#datatables').DataTable();
});
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></scri>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>