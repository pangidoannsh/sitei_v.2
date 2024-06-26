<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> SITEI | Detail Mahasiswa
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />

    <!-- <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css?v=0.001') }}">
    <!--<link rel="stylesheet" href="{{ asset('/assets/dataTables/datatables.min.css') }}">-->

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowgroup/1.4.0/css/rowGroup.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/9c94b38548.js" crossorigin="anonymous"></script>

    <!-- <script type="text/javascript">
        function mousedwn(e) {
            try {
                if (event.button == 2 || event.button == 3) return false
            } catch (e) {
                if (e.which == 3) return false
            }
        }
        document.oncontextmenu = function() {
            return false
        };
        document.ondragstart = function() {
            return false
        };
        document.onmousedown = mousedwn
    </script> -->

    <style>
        .dropdown-menu {
            border-left: 0.01px solid rgba(0, 0, 0, 0.05);
            border-right: 0.01px solid rgba(0, 0, 0, 0.05);
            border-bottom: 0.01px solid rgba(0, 0, 0, 0.05);
            border-top: 0.01px solid rgba(0, 0, 0, 0.05);
            /* border: none; */
            box-shadow: none;
        }

        .dropdown-menu li:hover {
            background-color: rgba(41, 52, 47, 0.05);
        }

        .dropdown-menu form li:hover {
            background-color: rgba(41, 52, 47, 0.05);
        }


        @media screen and (max-width: 768px) {
            .cardskripsi {
                margin-bottom: 50px;
            }

            .dropdown-menu form li i {
                margin-left: -15px;
            }

            .navbar-collapse {
                /*background: rgba(0, 0, 0, 0.05);*/
                padding-left: 25px;
                padding-right: 25px;
            }

            .dropdown-menu {
                background: radial-gradient(circle at top left, #ffffff, #e5e5e5);

            }

            .navbar-nav li a {
                text-align: center;
            }

            .navbar-nav li button {
                text-align: center;
            }

        }

        .dropdown-item:hover {
            color: #0c8a4f;
            background-color: rgba(41, 52, 47, 0.05);
        }

        form li button:hover {
            color: #0c8a4f;
            background-color: rgba(41, 52, 47, 0.05);
        }

        .cursor-default {
            cursor: default !important;

        }

        .cursor-default:hover {
            cursor: default !important;
            color: #192f59 !important;
            background-color: white !important;
        }
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <div class="atas">
            <nav class="navbar navbar-expand-lg main-header fixed-top bayangan">
                <div class="container judul">
                    <div class="sia-jte">
                        <a>
                            <img src="/assets/dist/img/unri.png" alt="" width="30" height="30" class="d-inline-block mr-2">
                        </a>
                        <a class="navbar-brand mt-1 " href="/">SITEI
                        </a>
                    </div>
                    <button class="navbar-toggler navbar-light bg-light border border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">


                            <li class="nav-item">
                                <a class="nav-link  " aria-current="page" href="/inventaris/peminjaman-dosen">Progress Report</a>

                            </li>

                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div>
                                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius:10px;" aria-labelledby="navbarDropdown">

                                        <li>
                                            <a class="nav-link dropdown-item " href="/profil-dosen/editpassworddsn/">
                                                <i class="bi bipw bi-key"></i> Ubah Password
                                            </a>
                                        </li>

                                        <form action="/logout" method="POST">
                                            <input type="hidden" name="_token" value="1kf09BSG9Hzwus1sOH2nUzbqaEWfNVVz6tdaH9nz">
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
                            <h4> Detail Mahasiswa
                            </h4>
                            <hr>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    <section class="mb-5">
                        <div class="container">
                            <a href="{{ url()->previous() }}" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
                        </div>

                        <div class="container">
                            <div class="row rounded shadow-sm">
                                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                                    <h5 class="text-bold">Mahasiswa</h5>
                                    <hr>
                                    <p class="card-title text-secondary text-sm ">Nama</p>
                                    <p class="card-text text-start">{{ $skripsi->mahasiswa_nama }}</p>
                                    <p class="card-title text-secondary text-sm ">NIM</p>
                                    <p class="card-text text-start">{{ $skripsi->mahasiswa_nim }}</p>
                                    <p class="card-title text-secondary text-sm ">Program Studi</p>
                                    <p class="card-text text-start">{{ $prodi->nama_prodi }}</p>
                                    <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                                    <p class="card-text text-start">{{ $konsentrasi->nama_konsentrasi }}</p>
                                </div>
                                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                                    <h5 class="text-bold">Dosen Pembimbing</h5>
                                    <hr>
                                    <p class="card-title text-secondary text-sm">Nama</p>
                                    <p class="card-text text-start">{{ $skripsi->pembimbing_nama }}</p>
                                    <p class="card-title text-secondary text-sm">NIP</p>
                                    <p class="card-text text-start">{{ $skripsi->pembimbing_nip }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="container">
                            <div class="row rounded shadow-sm">
                                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                                    <h5 class="text-bold">Data Usulan</h5>
                                    <hr>
                                    <p class="card-title text-secondary text-sm">Judul Laporan</p>
                                    <p class="card-text text-start"> {{ $pendaftaran_skripsi->judul }}</p>
                                    <p class="card-title text-secondary text-sm">BAB 1</p>
                                    <ul>
                                        @foreach ($skripsi->bab1 as $bab1)
                                        <li class="card-text">{{ $bab1 }}</li>
                                        @endforeach
                                    </ul>

                                    @if($skripsi->bab2)
                                    <p class="card-title text-secondary text-sm">BAB 2</p>
                                    <ul>
                                        @foreach ($skripsi->bab2 as $bab2)
                                        <li class="card-text">{{ $bab2 }}</li>
                                        @endforeach
                                    </ul>
                                    @endif


                                    @if($skripsi->bab3)
                                    <p class="card-title text-secondary text-sm">BAB 3</p>
                                    <ul>
                                        @foreach ($skripsi->bab3 as $bab3)
                                        <li class="card-text">{{ $bab3 }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                    @if($skripsi->bab4)
                                    <p class="card-title text-secondary text-sm">BAB 4</p>
                                    <ul>
                                        @foreach ($skripsi->bab4 as $bab4)
                                        <li class="card-text">{{ $bab4 }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                    @if($skripsi->bab5)
                                    <p class="card-title text-secondary text-sm">BAB 5</p>
                                    <ul>
                                        @foreach ($skripsi->bab5 as $bab5)
                                        <li class="card-text">{{ $bab5 }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                    <p class="card-title text-secondary text-sm">Naskah</p>
                                    <p class="card-text  text-start"><a formtarget="_blank" target="_blank" href="{{ asset('storage/' . $skripsi->naskah) }}" class="badge bg-dark px-3 py-2">Buka</a></p>

                                </div>
                                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                                    <h5 class="text-bold">Keterangan skripsi</h5>
                                    <hr>
                                    <p class="card-title text-secondary text-sm">Jenis Usulan</p>
                                    <p class="card-text text-start"><span>{{ $skripsi->status }}</span></p>
                                    <p class="card-title text-secondary text-sm">Bimbingan Ke </p>
                                    <p class="card-text text-start"><span>{{ $skripsi->bimbingan }}</span></p>
                                    <p class="card-title text-secondary text-sm ">Diskusi</p>
                                    <p class="card-text text-start"><span>{{ $skripsi->diskusi }}</span></p>
                                    <p class="card-title text-secondary text-sm">komentar</p>
                                    @if($skripsi->komentar)
                                    <p class="card-text text-start"><span>{{ $skripsi->komentar }}</span></p>
                                    @else
                                    <p class="card-text text-start"><span> - </span></p>
                                    @endif
                                    <p class="card-title text-secondary text-sm">Keterangan</p>
                                    @if($skripsi->keterangan)
                                    <p class="card-text text-start"><span>{{ $skripsi->keterangan }}</span></p>
                                    @else
                                    <p class="card-text text-start"><span> - </span></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="container">
                        </div>
                    </section>
                    <br>
                    <br>
                    <br>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->

        <section class="bg-dark p-1">
            <div class="container">
                <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
            </div>
        </section>
        <!-- <div class="footer bg-dark">
        <div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI</p>
        </div>
      </div> -->


        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->


        <!-- jQuery -->
        <!--<script src="http://127.0.0.1:8000/assets/plugins/jquery/jquery.min.js"></script>-->
        <!--<script src="http://127.0.0.1:8000/assets/dataTables/datatables.min.js"></script>-->


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




        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#datatables').DataTable({
                    "lengthMenu": [10, 25, 50, 100, 200],
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
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#datatables3').DataTable({
                    "lengthMenu": [10, 25, 50, 100, 200],
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
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#datatables2').DataTable({
                    "lengthMenu": [50, 100, 150, 200],
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
            });
        </script>



        <!-- Bootstrap 4 -->
        <script src="http://127.0.0.1:8000/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="http://127.0.0.1:8000/assets/dist/js/adminlte.min.js"></script>
        <script src="http://127.0.0.1:8000/assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://127.0.0.1:8000/assets/dist/js/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="http://127.0.0.1:8000/js/sweetalert2.min.js"></script>
        <script>
            $('.setujui-semkp-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Seminar KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemKPPemb() {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar KP',
                            html: `
                        <form id="reasonForm" action="/usulan-semkp/pembimbing/tolak/1" method="POST">
                        <input type="hidden" name="_method" value="put">                            <input type="hidden" name="_token" value="avZDn8D7Vzag0nJbDLjCTdzJ2zMwedCNOrqpTeeZ">                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
        </script>

</body>

</html>