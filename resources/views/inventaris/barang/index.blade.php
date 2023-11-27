
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>    Stok Barang | SIA ELEKTRO
</title>
    <link rel="shortcut icon" href="https://sitei.ft.unri.ac.id/assets/dist/img/logo.ico" type="image/x-icon">
    
  {{-- <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://sitei.ft.unri.ac.id/cloudme.fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://sitei.ft.unri.ac.id/assets/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://sitei.ft.unri.ac.id/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://sitei.ft.unri.ac.id/assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://sitei.ft.unri.ac.id/assets/css/styles.css?v=0.001">
  <link rel="stylesheet" href="https://sitei.ft.unri.ac.id/assets/dataTables/datatables.min.css"> --}}

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('/assets/dist/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/assets/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/styles.css?v=0.001')}}">
    <link rel="stylesheet" href="{{asset('/assets/dataTables/datatables.min.css')}}">
  

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <div class="atas">
  <nav class="navbar navbar-expand-lg main-header fixed-top bayangan">
  <div class="container judul">
    <div class="sia-jte">
  <a>
    <img src="https://sitei.ft.unri.ac.id/assets/dist/img/unri.png" alt="" width="30" height="30" class="d-inline-block mr-2">
  </a>
                    <a class="navbar-brand mt-1 " href="/jadwal">SITEI
              
    </a>
    </div>
    <button class="navbar-toggler navbar-light bg-light border border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
                    
                              <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/jadwal">Seminar</a>
          </li>

          
          
                    
                                  <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Formulir</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Usulan KP</a></li>
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Usulan MBKM</a></li>
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Usulan Skripsi</a></li> 
              </ul>  
			</li>
            <li class="nav-item dropdown baru">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Status</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"style="border-radius:10px;">
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Usulan Anda</a></li> 
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Status KP Anda</a></li>
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Status MKBM Anda</a></li>
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Status Skripsi Anda</a></li>
                <li><a href="#" target="_blank" class="dropdown-item mb-1">Kuota Bimbingan</a></li>
              </ul>  
			</li>
          <li class="nav-item"><a class="nav-link" aria-current="page" href="" target="_blank" >Classroom KP/TA</a></li>
          <li class="nav-item"><a class="nav-link" aria-current="page" href="#" target="_blank" >Inventaris</a></li>
                              

        </ul>
        
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown baru">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->nama }}
                        
              </a>
              <div>
              <ul class="dropdown-menu dropdown-menu-end"style="border-radius:10px;" aria-labelledby="navbarDropdown">
                                      
              <li>
              <a class="nav-link dropdown-item mb-1" href="/profil-mhs/editpasswordmhs/">
                  <i class="bi bipw bi-key"></i> <span>Ubah Password</span>
              </a>
              </li>
                             
              <form action="/logout" method="POST">
                @csrf
                  <li>
                  <button type="submit" class="dropdown-item mb-1">
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
          <div class="anak-judul">
            <h4>    Peminjaman Barang
</h4><hr>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <!-- Button trigger modal -->
        <a href="/tambahbarang" type="button" class="mb-4 w-85 btn btn-success rounded border" data-toggle="modal" data-target="#exampleModal">
          + Tambah Barang
        </a>
  

            <ol class="breadcrumb col-lg-12">
                <li class="breadcrumb-item"><a  href="{{ route('peminjamanadm') }}">Daftar Pinjam ({{ $jumlah_pinjaman }})</a></li>    
                <li class="breadcrumb-item"><a class="breadcrumb-item" href="{{ route('riwayatadm') }}">Riwayat ({{ $jumlah_riwayat }})</a></li>
                <li class="breadcrumb-item active fw-bold text-black"><a  href="{{ route('stok') }}">Inventaris ({{ $jumlah_barang }})</a></li>  
            </ol>

      <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
          <thead class="table-dark">
            <tr>      
                <th class="text-center" scope="col">Kode Barang</th>
                <th class="text-center" scope="col">Nama Barang</th>
                <th class="text-center" scope="col">Jumlah</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Aksi</th>      
            </tr>
          </thead>


        <tbody>
          @foreach ($barang as $barang)
          <tr>
            <td class="text-center">{{ $barang->kode_barang }}</td>                             
            <td class="text-center">{{ $barang->nama_barang }}</td>                     
            <td class="text-center">{{ $barang->jumlah }}</td>
            @if($barang->status == 'Dipinjam')
            <td class="text-center bg-danger">{{ $barang->status }}</td>
            @else
            <td class="text-center bg-success">{{ $barang->status }}</td>
            @endif                    
            <td class="text-center">
                  <a type="button" href="{{ route('editbarang', $barang->id) }}" class="badge bg-warning border-0" >
                    <i><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                    </i>
                  </a>
                <form action="{{  route('deletebarang', $barang->id)  }}" method="POST" class="d-inline">
                  @method('DELETE')
                  @csrf
                  <button class="badge bg-danger border-0">
                    <i><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                    </i>
                  </button>
                </form> 
            </td>                     
          </tr>
          @endforeach
        </tbody>
    </table>
    
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer bg-dark">
  <div class="container">
  <strong></strong>
</div>
    <!-- Default to the left -->
    <!-- <strong>Copyright &copy; Jurusan Teknik Elektro</strong> -->
  </footer>
  
</div>
<!-- ./wrapper -->
@include('barang.modal')
<!-- REQUIRED SCRIPTS -->


{{-- <!-- jQuery -->
<script src="https://sitei.ft.unri.ac.id/assets/plugins/jquery/jquery.min.js"></script>
<script src="https://sitei.ft.unri.ac.id/assets/dataTables/datatables.min.js"></script>
<script type="text/javascript">$('#datatables').DataTable();
</script>

<!-- Bootstrap 4 -->
<script src="https://sitei.ft.unri.ac.id/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://sitei.ft.unri.ac.id/assets/dist/js/adminlte.min.js"></script>
<script src="https://sitei.ft.unri.ac.id/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://sitei.ft.unri.ac.id/assets/dist/js/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

 <!-- jQuery -->
 <script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('/assets/dataTables/datatables.min.js')}}"></script>
 <script type="text/javascript">$('#datatables').DataTable();
 </script>

 <!-- Bootstrap 4 -->
 <script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
 <script src="{{asset('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
 <script src="{{asset('assets/dist/js/sweetalert2.all.min.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
</body>
</html>