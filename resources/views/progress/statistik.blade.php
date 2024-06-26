<!-- PENDAFTARAN SKRIPSI -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> SITEI | Persetujuan Kerja Praktek dan Skripsi
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
    <script src="https://code.highcharts.com/highcharts.js"></script>

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
                            <h4>Progress Report
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

                    <a href="/progress/proposal/tambah" class="btn mahasiswa btn-success mb-3 font-weight-bold">+ Proposal</a>
                    <a href="/progress/skripsi/tambah" class="btn mahasiswa btn-success mb-3 font-weight-bold">+ Skripsi</a>

                    <div class="container card  p-4">

                        <ol class="breadcrumb col-lg-12">
                            <li>
                                <a href="/progress" class="px-1">Persetujuan
                                    (<span>{{ $jumlah }}</span>)
                                </a>
                            </li>

                            <span class="px-2">|</span>
                            <li>
                                <a href="/progress/riwayat" class="px-1">Riwayat (<span>{{ $jumlah_skripsi }}</span>) </a>
                            </li>

                            <span class="px-2">|</span>
                            <li>
                                <a href="/progress/statistik" class="breadcrumb-item active fw-bold text-success px-1">Statistik</a>
                            </li>

                        </ol>

                        <div class="container-fluid">

                            <div class="card mt-4 mb-4 rounded bg-success ">
                                <div class="p-2 pt-3">
                                    <h5 class="text-center text-bold">
                                        Laporan Kemajuan
                                    </h5>
                                </div>
                            </div>

                            <div class="card pt-4 pb-4">
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div id="container" style="width:100%; height:400px;"></div>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <div id="container2" style="width:100%; height:400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


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
            let dataProgressSkripsi = <?php echo json_encode($progressReportSkripsi) ?>;
            let dataBimbinganSkripsi = <?php echo json_encode($bimbinganSkripsi) ?>;
             document.addEventListener('DOMContentLoaded', function() {
                const chart = Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    title: {
                        text: 'Persentase Progress Skripsi'
                    },
                    xAxis: {
                        categories: dataBimbinganSkripsi,
                        
                    },
                    yAxis: {
                        min: 0,
                        max: 100,
                        labels: {
                            formatter: function() {
                                return this.value + "%";
                            }
                        },
                        title: {
                            text: 'Persentase'
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>Bimbingan Ke {point.key}</b><br/>',
                        pointFormat: '{series.name}: {point.y}%<br/>Total: {point.stackTotal}',
                        shared: true
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true,
                                format: '{y} %',
                                style: {
                                    textOutline: 'none'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Progress Report',
                        data: dataProgressSkripsi
                    }]
                });
            });
        </script>

        <script>
            let dataProgresProposal = <?php echo json_encode($progressReportProposal) ?>;
            let dataBimbinganProposal = <?php echo json_encode($bimbinganProposal) ?>;

            document.addEventListener('DOMContentLoaded', function() {
                const chart = Highcharts.chart('container2', {
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    title: {
                        text: 'Persentase Progress Proposal'
                    },
                    xAxis: {
                        categories: dataBimbinganProposal
                        
                    },
                    yAxis: {
                        min: 0,
                        max: 100,
                        labels: {
                            formatter: function() {
                                return this.value + "%";
                            }
                        },
                        title: {
                            text: 'Persentase'
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>Bimbingan Ke {point.key}</b><br/>',
                        pointFormat: '{series.name}: {point.y}%<br/>Total: {point.stackTotal}',
                        shared: true
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true,
                                format: '{y} %',
                                style: {
                                    textOutline: 'none'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Progress Report',
                        data: dataProgresProposal
                    }]
                });
            });
        </script>

</body>

</html>