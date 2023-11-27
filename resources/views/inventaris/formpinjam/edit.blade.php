
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>    Form Usulan Peminjaman
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  

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
          <li class="nav-item"><a class="nav-link" aria-current="page" href="#" target="_blank" >Classroom KP/TA</a></li>
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
                             
              <form action="/logout" method="post">                
                <li>
                  @csrf
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
        

<ol class="breadcrumb col-lg-12">    
    <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/seminar">Usulan Peminjaman</a></li>  
</ol>

<div class="card">
    <div class="card-header bg-dark">
      Edit Usulan
    </div>
    <div class="card-body">
      <div class="row justify-content-center">
      <div class="col-sm-5">
          <form action="/update/{{ $pinjaman->id }}" method="POST" class="mx-auto" id="input-form">
            @method('put')
            @csrf
            <div class="form-group row justify-content-center">
              <label for="inputPassword3" class="col-sm-5 col-form-label">Tujuan</label>
              <div class="col-sm-7">
                <select class="custom-select" name="tujuan">
                    <option selected>{{ $pinjaman->tujuan }}</option>
                    <option value="Perkuliahan">Perkuliahan</option>
                    <option value="Rapat">Rapat</option>
                    <option value="Lainnya">Lainnya</option>\
                  </select>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label for="lokasi" class="col-sm-5 col-form-label">Lokasi</label>
              <div class="col-sm-7">
                <input type="lokasi" class="form-control" id="ruangan" placeholder="Lokasi" name="ruangan" value="{{ $pinjaman->ruangan }}">
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label for="inputPassword3" class="col-sm-5 col-form-label">Jaminan</label>
              <div class="col-sm-7">
                <select class="custom-select" name="jaminan">
                    <option selected>{{ $pinjaman->jaminan }}</option>
                    <option value="KTM">KTM</option>
                    <option value="KTP">KTP</option>
                    <option value="SIM">SIM</option>
                </select>
              </div>
            </div>
            <div id="product_row1" class="form-group row justify-content-center">
              <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 1</label>
              <div class="col-sm-7">
                <select class="custom-select" name="barang_satu">
                  @foreach ($nama_barang as $barangs)
                  @if(old('barang_satu', $pinjaman->barang_satu) == $barangs->id)
                  <option value="{{ $barangs->id }}" selected>{{ $barangs->nama_barang }}</option>
                  @else
                  <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                  @endif       
                  @endforeach
                </select>
              </div>
            </div>

            <div id="product_row1" class="form-group row justify-content-center">
              <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 2</label>
              <div class="col-sm-7">
                <select class="custom-select" name="barang_dua">
                  <option value="">Pilih Barang</option>
                  @foreach ($nama_barang as $barangs)
                  @if(old('barang_dua', $pinjaman->barang_dua) == $barangs->id)
                  <option value="{{ $barangs->id }}" selected>{{ $barangs->nama_barang }}</option>
                  @else
                  <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                  @endif  
                  @endforeach
                </select>
              </div>
            </div>

            <div id="product_row1" class="form-group row justify-content-center">
              <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 3</label>
              <div class="col-sm-7">
                <select class="custom-select" name="barang_tiga">
                  <option value="">Pilih Barang</option>
                  @foreach ($nama_barang as $barangs)
                  @if(old('barang_tiga', $pinjaman->barang_tiga) == $barangs->id)
                  <option value="{{ $barangs->id }}" selected>{{ $barangs->nama_barang }}</option>
                  @else
                  <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                  @endif  
                  @endforeach
                </select>
              </div>
            </div>

      </div>
      </div>
          <div class="form-group row justify-content-center">
              <button type="submit" class="col-sm-2 btn btn-success justify-content-center">Usulkan Ulang</button>
          </div>
        </form>
    </div>
  </div>

    
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

<script>
  $(document).ready(function(){
  $('select').on('change', function(event ) {
    var prevValue = $(this).data('previous');
    $('select').not(this).find('option[value="'+prevValue+'"]').show();
    var value = $(this).val();
    $(this).data('previous',value);
    $('select').not(this).find('option[value="'+value+'"]').hide();
  });
});
</script>

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