<!-- PENDAFTARAN SKRIPSI -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> SITEI | Persetujuan Kerja Praktek dan Skripsi
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                            <img src="/assets/dist/img/unri.png" alt="" width="30" height="30"
                                class="d-inline-block mr-2">
                        </a>
                        <a class="navbar-brand mt-1 " href="/">SITEI
                        </a>
                    </div>
                    <button class="navbar-toggler navbar-light bg-light border border-secondary" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">


                            <li class="nav-item">
                                <a class="nav-link  " aria-current="page" href="/inventaris/peminjaman-dosen">Progress
                                    Report</a>

                            </li>

                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div>
                                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius:10px;"
                                        aria-labelledby="navbarDropdown">

                                        <li>
                                            <a class="nav-link dropdown-item " href="/profil-dosen/editpassworddsn/">
                                                <i class="bi bipw bi-key"></i> Ubah Password
                                            </a>
                                        </li>

                                        <form action="/logout" method="POST">
                                            <input type="hidden" name="_token"
                                                value="1kf09BSG9Hzwus1sOH2nUzbqaEWfNVVz6tdaH9nz">
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
                    <div class="container card  p-4">

                        <ol class="breadcrumb col-lg-12">
                            <li>
                                <a href="/persetujuan-kp-skripsi" class="px-1">Persetujuan
                                    (<span>{{ $jumlah }}</span>)
                                </a>
                            </li>

                            <span class="px-2">|</span>
                            <li>
                                <a href="/dosen/riwayat" class="px-1">Riwayat (<span>{{ $jumlah_skripsi }}</span>)
                                </a>
                            </li>

                            <span class="px-2">|</span>
                            <li>
                                <a href="/pembimbing/skripsi" class="px-1">Bimbingan</a>
                            </li>

                            {{-- @if (Auth::user()->role == 2)
                                <span class="px-2">|</span>
                                <li>
                                    <a href="/admin/pengelola" class="px-1">Pengelola</a>
                                </li>
                            @endif --}}

                        </ol>

                        <ol class="breadcrumb col-lg-12">
                            <h5>Data Statistik <span class="fw-bold fs-5">{{ $namaMahasiswa->name }}</span></h5>
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
                                        <div id="container2" style="width:100%; height:400px;"></div>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <div id="container" style="width:100%; height:400px;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-4 mb-4 rounded bg-success ">
                                <div class="p-2 pt-3">
                                    <h5 class="text-center text-bold">
                                        Riwayat
                                    </h5>
                                </div>
                            </div>

                            <table class="table table-responsive-lg table-bordered table-striped" width="100%"
                                id="datatables">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" scope="col">Bimbingan</th>
                                        <th class="text-center" scope="col">Progress</th>
                                        <th class="text-center" scope="col">Pembimbing</th>
                                        <th class="text-center" scope="col">Status</th>
                                        <th class="text-center" scope="col">Tanggal</th>
                                        <th class="text-center" scope="col">Keterangan</th>
                                        <th class="text-center " scope="col"
                                            style="padding-left: 50px; padding-right:50px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($skripsis as $skripsi)
                                        <tr>
                                            <td class="text-center ">{{ $skripsi->bimbingan }}</td>
                                            <td class="text-center ">{{ $skripsi->progress_report }} %</td>
                                            <td class="text-center ">{{ $skripsi->pembimbing_nama }}</td>
                                            <td class="text-center bg-info ">{{ $skripsi->status }}</td>
                                            <td class="text-center ">
                                                {{ $skripsi->created_at->translatedFormat('l, d F Y') }}</td>
                                            @if (!$skripsi->keterangan)
                                                <td class="text-center ">{{ $skripsi->keterangan }}</td>
                                            @elseif ($skripsi->keterangan == 'Sangat Baik' || $skripsi->keterangan == 'Baik')
                                                <td class="text-center bg-success ">{{ $skripsi->keterangan }}</td>
                                            @elseif ($skripsi->keterangan == ' Diterima' || $skripsi->keterangan == 'Cukup Diterima')
                                                <td class="text-center bg-warning ">{{ $skripsi->keterangan }}</td>
                                            @else
                                                <td class="text-center bg-danger ">{{ $skripsi->keterangan }}</td>
                                            @endif
                                            <td class="text-center">

                                                <a href='/progress/skripsi/{{ $skripsi->id }}' type="button"
                                                    class="badge bg-info rounded border-0"><i
                                                        class="fa fa-circle-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($proposals as $proposal)
                                        <tr>
                                            <td class="text-center ">{{ $proposal->bimbingan }}</td>
                                            <td class="text-center ">{{ $proposal->progress_report }} %</td>
                                            <td class="text-center ">{{ $proposal->pembimbing_nama }}</td>
                                            <td class="text-center bg-info ">{{ $proposal->status }}</td>
                                            <td class="text-center ">
                                                {{ $proposal->created_at->translatedFormat('l, d F Y') }}</td>
                                            @if (!$proposal->keterangan)
                                                <td class="text-center ">{{ $proposal->keterangan }}</td>
                                            @elseif ($proposal->keterangan == 'Sangat Baik' || $proposal->keterangan == 'Baik')
                                                <td class="text-center bg-success ">{{ $proposal->keterangan }}</td>
                                            @elseif ($proposal->keterangan == 'Diterima' || $proposal->keterangan == 'Cukup Diterima')
                                                <td class="text-center bg-warning ">{{ $proposal->keterangan }}</td>
                                            @else
                                                <td class="text-center bg-danger ">{{ $proposal->keterangan }}</td>
                                            @endif
                                            <td class="text-center">

                                                <a href='/progress/proposal/{{ $proposal->id }}' type="button"
                                                    class="badge bg-info rounded border-0"><i
                                                        class="fa fa-circle-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
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
                <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                        formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
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
            let dataProgresProposalBab1 = <?php echo json_encode($proposalSubBab1); ?>;
            let dataProgresProposalBab2 = <?php echo json_encode($proposalSubBab2); ?>;
            let dataProgresProposalBab3 = <?php echo json_encode($proposalSubBab3); ?>;
            let dataBimbinganProposal = <?php echo json_encode($bimbinganProposal); ?>;

            document.addEventListener('DOMContentLoaded', function() {
                const chart = Highcharts.chart('container2', {
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    title: {
                        text: 'Persentase Progress Proposal',
                        align: 'center'
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
                            text: 'Persentase Progress'
                        },
                        stackLabels: {
                            enabled: true
                        }
                    },
                    legend: {
                        align: 'left',
                        x: 100,
                        verticalAlign: 'top',
                        y: 45,
                        floating: true,
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false,
                        layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
                    },
                    tooltip: {
                        headerFormat: '<b>Bimbingan Ke {point.key}</b><br/>',
                        pointFormat: '{series.name}: {point.y} %<br/>Total: {point.stackTotal} %'
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
                            name: 'BAB 1',
                            data: dataProgresProposalBab1
                        },
                        {
                            name: 'BAB 2',
                            data: dataProgresProposalBab2
                        },
                        {
                            name: 'BAB 3',
                            data: dataProgresProposalBab3
                        },
                    ]

                });
            });
        </script>

        <script>
            let dataProgresSkripsiBab1 = <?php echo json_encode($skripsiSubBab1); ?>;
            let dataProgresSkripsiBab2 = <?php echo json_encode($skripsiSubBab2); ?>;
            let dataProgresSkripsiBab3 = <?php echo json_encode($skripsiSubBab3); ?>;
            let dataProgresSkripsiBab4 = <?php echo json_encode($skripsiSubBab4); ?>;
            let dataProgresSkripsiBab5 = <?php echo json_encode($skripsiSubBab5); ?>;
            let dataBimbinganSkripsi = <?php echo json_encode($bimbinganSkripsi); ?>;

            document.addEventListener('DOMContentLoaded', function() {
                const chart = Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    title: {
                        text: 'Persentase Progress Skripsi',
                        align: 'center'
                    },
                    xAxis: {
                        categories: dataBimbinganSkripsi
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
                            text: 'Persentase Progress'
                        },
                        stackLabels: {
                            enabled: true
                        }
                    },
                    legend: {
                        align: 'left',
                        x: 100,
                        verticalAlign: 'top',
                        y: 45,
                        floating: true,
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false,
                        layout: 'vertical', // Atur layout menjadi vertical untuk membuat 2 kolom
                    },
                    tooltip: {
                        headerFormat: '<b>Bimbingan Ke {point.key}</b><br/>',
                        pointFormat: '{series.name}: {point.y} %<br/>Total: {point.stackTotal} %'
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
                            name: 'BAB 1',
                            data: dataProgresSkripsiBab1
                        },
                        {
                            name: 'BAB 2',
                            data: dataProgresSkripsiBab2
                        },
                        {
                            name: 'BAB 3',
                            data: dataProgresSkripsiBab3
                        },
                        {
                            name: 'BAB 4',
                            data: dataProgresSkripsiBab4
                        },
                        {
                            name: 'BAB 5',
                            data: dataProgresSkripsiBab5
                        },
                    ]

                });
            });
        </script>

</body>

</html>
