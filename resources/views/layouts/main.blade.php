
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('/assets/dist/css/bootstrap.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />

 <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
 
   <!-- <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/css/style.css?v=0.001')}}">
  <!--<link rel="stylesheet" href="{{asset('/assets/dataTables/datatables.min.css')}}">-->
  
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/rowgroup/1.4.0/css/rowGroup.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" rel="stylesheet">

<script src="https://kit.fontawesome.com/9c94b38548.js" crossorigin="anonymous"></script>

   <!-- <script type="text/javascript">
        function mousedwn(e){try{if(event.button==2||event.button==3)return false}catch(e){if(e.which==3)return false}}document.oncontextmenu=function(){return false};document.ondragstart=function(){return false};document.onmousedown=mousedwn
        </script> -->
  
</head>
<body class="hold-transition layout-top-nav">
@include('sweetalert::alert')
<div class="wrapper">

  <div class="atas">
  <nav class="navbar navbar-expand-lg main-header fixed-top bayangan">
  <div class="container judul">
    <div class="sia-jte">
  <a>
    <img src="/assets/dist/img/unri.png" alt="" width="30" height="30" class="d-inline-block mr-2">
  </a>
          @if (Str::length(Auth::guard('web')->user()) > 0)
          <a class="navbar-brand mt-1 " href="/form">SITEI
          @elseif (Str::length(Auth::guard('dosen')->user()) > 0)
          <a class="navbar-brand mt-1 " href="/">SITEI
          @elseif (Str::length(Auth::guard('mahasiswa')->user()) > 0)
          <a class="navbar-brand mt-1 " href="/">SITEI
          @endif    
    </a>
    </div>
    <button class="navbar-toggler navbar-light bg-light border border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">

          {{-- Menu Persetujuan --}}

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          <li class="nav-item">
            <a class="nav-link {{Request::is ('persetujuan-kp-skripsi*') ? 'text-success' : '' }} {{Request::is ('persetujuan-koordinator*') ? 'text-success' : '' }}{{Request::is ('riwayat-koordinator*') ? 'text-success' : '' }}" aria-current="page" href="/persetujuan-kp-skripsi">Persetujuan</a>
          </li>
          @endif
          @endif

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          <li class="nav-item">
            <a class="nav-link {{Request::is ('persetujuan-kp-skripsi*') ? 'text-success' : '' }} {{Request::is ('persetujuan-kaprodi*') ? 'text-success' : '' }} {{Request::is ('riwayat-kaprodi*') ? 'text-success' : '' }}" aria-current="page" href="/persetujuan-kp-skripsi">Persetujuan</a>
          </li>
          @endif
          @endif

          {{-- Menu KP/Skripsi --}}

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          <li class="nav-item">
            <a class="nav-link {{Request::is ('pendaftaran*') ? 'text-success' : '' }}{{Request::is ('kp-skripsi*') ? 'text-success' : '' }}{{Request::is ('kerja-praktek*') ? 'text-success' : '' }} {{Request::is ('skripsi*') ? 'text-success' : '' }} {{Request::is ('pembimbing*') ? 'text-success' : '' }}" aria-current="page" href="/kp-skripsi">KP/Skripsi</a>
          </li>
          @endif
          @if (Str::length(Auth::guard('mahasiswa')->user()) > 0)
          <li class="nav-item">
            <a class="nav-link {{Request::is ('kp-skripsi*') ? 'text-success' : '' }}  {{Request::is ('usulankp*') ? 'text-success' : '' }} {{Request::is ('permohonankp*') ? 'text-success' : '' }} {{Request::is ('balasankp*') ? 'text-success' : '' }} {{Request::is ('seminarkp*') ? 'text-success' : '' }} {{Request::is ('usulan-semkp*') ? 'text-success' : '' }} {{Request::is ('kpti10-kp*') ? 'text-success' : '' }} {{Request::is ('usuljudul*') ? 'text-success' : '' }} {{Request::is ('jadwal*') ? 'text-success' : '' }} " aria-current="page" href="/kp-skripsi">KP/Skripsi</a>
          </li>
          
          <!-- <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle   {{Request::is ('kuota-bimbingan*') ? 'text-success' : '' }}">Ketersediaan Pembimbing</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li>                        
                  <a href="/kuota-bimbingan/kp" class="dropdown-item mb-1">Pembimbing KP</a>
                </li>
                <li><a href="/kuota-bimbingan/skripsi" class="dropdown-item mb-1">Pembimbing Skripsi</a></li>
              </ul>
          </li> -->
          
          
          <!-- <li class="nav-item">
            <a class="nav-link  {{Request::is ('jadwal') ? 'text-success' : '' }}" aria-current="page" href="/jadwal">Seminar</a>
          </li> -->


          
          @endif

          {{-- Menu Statistik --}}

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/statistik/kuota-bimbingan">Statistik</a>
          </li>
          @endif
          @endif

          @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/statistik/kuota-bimbingan">Statistik</a>
          </li>
          @endif
          @endif

          @if (Str::length(Auth::guard('web')->user()) > 0)        
          @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
          <li class="nav-item">
            <a class="nav-link {{Request::is ('kerja-praktek*') ? 'text-success' : '' }}{{Request::is ('sempro*') ? 'text-success' : '' }}{{Request::is ('sidang*') ? 'text-success' : '' }}{{Request::is ('daftar-sempro*') ? 'text-success' : '' }}{{Request::is ('persetujuan*') ? 'text-success' : '' }}{{Request::is ('skripsi*') ? 'text-success' : '' }}{{Request::is ('usulan*') ? 'text-success' : '' }}{{Request::is ('daftar-semkp*') ? 'text-success' : '' }}{{Request::is ('suratperusahaan*') ? 'text-success' : '' }}{{Request::is ('usuljudul*') ? 'text-success' : '' }}{{Request::is ('daftar-sidang*') ? 'text-success' : '' }}" aria-current="page" href="/persetujuan/admin/index">KP/Skripsi</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/form">Jadwal</a>
          </li>
          
          
          @if (Auth::guard('web')->user()->role_id == 1 )
          <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data Jurusan</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li>                        
                  <a href="/role" class="dropdown-item mb-1">Hak Akses</a>
                </li>
                <li><a href="/prodi" class="dropdown-item mb-1">Program Studi</a></li>                    
                <li><a href="/konsentrasi" class="dropdown-item mb-1">Konsentrasi</a></li> 
                <li><a href="/ruangan" class="dropdown-item mb-1">Ruangan</a></li>
              </ul>
          </li>
          @endif

          <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link  dropdown-toggle">Data Pengguna</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                @if (Auth::guard('web')->user()->role_id == 1 )
                <li><a href="/dosen" class="dropdown-item mb-1">Dosen</a></li>
                <li><a href="/user" class="dropdown-item mb-1">Staff Jurusan</a></li>
                @endif             
                @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 ) 
                <li><a href="/mahasiswa" class="dropdown-item mb-1 ">Mahasiswa</a></li>
                @endif             
              </ul>
          </li>
          @endif
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
              <a class="nav-link {{Request::is ('profil-mhs*') ? 'text-success' : '' }} dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if (Str::length(Auth::guard('dosen')->user()) > 0)
              {{Auth::guard('dosen')->user()->nama}}
              @elseif (Str::length(Auth::guard('web')->user()) > 0)
              {{Auth::guard('web')->user()->nama}}
              @elseif (Str::length(Auth::guard('mahasiswa')->user()) > 0)
              {{Auth::guard('mahasiswa')->user()->nama}}
              @endif          
              </a>
              <div>
              <ul class="dropdown-menu dropdown-menu-end"style="border-radius:10px;" aria-labelledby="navbarDropdown">
              {{-- @if (Str::length(Auth::guard('dosen')->user()) > 0)
              @if (Auth::guard('dosen')->user())    
              
              <li class="pp"><a class="dropdown-item" href="/profil-dosen"><i class="bi bi-person-circle mr-2"></i>Profil</a></li>
              @endif
              @endif  --}}
              @if (Str::length(Auth::guard('dosen')->user()) > 0)
              @if (Auth::guard('dosen')->user())          
              <li>
              <a class="nav-link dropdown-item" href="/profil-dosen/editpassworddsn/">
                  <i class="bi bipw bi-key"></i> <span>Ubah Password</span>
              </a>
              </li>
              @endif
              @endif
              
              @if (Str::length(Auth::guard('mahasiswa')->user()) > 0)
              @if (Auth::guard('mahasiswa')->user())          
              <li>
              <a class="nav-link {{Request::is ('profil-mhs*') ? 'text-success' : '' }} dropdown-item " href="/profil-mhs/editpasswordmhs/">
                  <i class="bi bipw bi-key"></i> <span>Ubah Password</span>
              </a>
              </li>
              @endif
              @endif 
              
              @if (Str::length(Auth::guard('web')->user()) > 0)
              @if (Auth::guard('web')->user())          
              <li>
              <a class="nav-link dropdown-item" href="/profil-staff/editpasswordstaff/">
                  <i class="bi bipw bi-key"></i> <span>Ubah Password</span>
              </a>
              </li>
              @endif
              @endif 

              <form action="/logout" method="POST">
                  @csrf
                  <li>
                  <button type="submit" class="dropdown-item">
                      <i class="bi bi-box-arrow-right"></i> <span>Keluar</span>
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
          <div class="anak-judul">
            <h4>@yield('sub-title')</h4>
            <hr>
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
  <div class="container kaki-bawah">
  <strong>Dikembangkan oleh Prodi Teknik Informatika UNRI</strong>
  </div>
    <!-- Default to the left -->
    <!-- <strong>Copyright &copy; Jurusan Teknik Elektro</strong> -->
  </footer>
  
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- jQuery -->
<!--<script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>-->
<!--<script src="{{asset('/assets/dataTables/datatables.min.js')}}"></script>-->


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.4.0/js/dataTables.rowGroup.min.js"></script>


{{-- <script type="text/javascript">
$(document).ready(function() {
    var table = $('#datatables').DataTable( {
        "lengthMenu": [ 50, 100, 150, 200, 250 ],
        buttons: [ 'copy', 'excel','print', 'pdf' ],
        dom:
        "<'row'<'col-md-2'l><'col-md-5'B><'col-md-4'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>"
        
    } );
 
    table.buttons().container()
        .appendTo( '#datatables_wrapper .col-md-5:eq(0)' );
} );
</script> --}}

<script type="text/javascript">

$(document).ready(function() {
    var table = $('#datatables').DataTable( {
      "lengthMenu": [ 10, 25, 50, 100, 200 ],
      "language": {
      "sProcessing": "Sedang memproses...",
      "sLengthMenu": "Tampilkan _MENU_ entri",
      "sZeroRecords": "Tidak ditemukan data yang sesuai",
      "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
      "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
      "sInfoPostFix": "",
      "sSearch": "Cari:",
      "sUrl": "",
      "oPaginate": {
        "sFirst": "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext": "Selanjutnya",
        "sLast": "Terakhir"
        }
      }
    })
} );

</script>

<script type="text/javascript">

$(document).ready(function() {
    var table = $('#datatables2').DataTable( {
      "lengthMenu": [ 10, 25, 50, 100, 200 ],
      "language": {
      "sProcessing": "Sedang memproses...",
      "sLengthMenu": "Tampilkan _MENU_ entri",
      "sZeroRecords": "Tidak ditemukan data yang sesuai",
      "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
      "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
      "sInfoPostFix": "",
      "sSearch": "Cari:",
      "sUrl": "",
      "oPaginate": {
        "sFirst": "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext": "Selanjutnya",
        "sLast": "Terakhir"
        }
      }
    })
} );

</script>



<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/dist/js/sweetalert2.all.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@stack('scripts')
</body>
</html>