<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!--pusher-->
    @if (Route::current()->getName() === 'showQrCode')
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="/vendor/laravel-echo/laravel-echo.js"></script> <!-- Sesuaikan dengan path Laravel Echo Anda -->

        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('9d8ea81e3cc141416745', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(resp) {
                var attendance = resp.data;

                // Filter data absensi berdasarkan kelas mahasiswa
                if (attendance.class_id === '{{ $mataKuliah->id }}') {
                    // Memperbarui tampilan data absensi sesuai dengan data yang diterima
                    notif(attendance);
                }
            });
        </script>
    @endif


    <style>
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

        #datatablesriwayatseminar_length,
        #datatablesriwayatseminar_filter {
            display: none;
        }

        #datatablesriwayatkpdanskripsi_length,
        #datatablesriwayatkpdanskripsi_filter {
            display: none;
        }

        #datatablesbimbinganskripsi_length,
        #datatablesbimbinganskripsi_filter {
            display: none;
        }

        #datatablesbimbingankp_length,
        #datatablesbimbingankp_filter {
            display: none;
        }

        #datatablesjadwalseminarpembimbingpenguji_length,
        #datatablesjadwalseminarpembimbingpenguji_filter {
            display: none;
        }

        #datatablespersetujuankpskripsi_length,
        #datatablespersetujuankpskripsi_filter {
            display: none;
        }

        #datatablesriwayatseminardibatalkan_length,
        #datatablesriwayatseminardibatalkan_filter {
            display: none;
        }

        #datatablesriwayatseminarprodi_length,
        #datatablesriwayatseminarprodi_filter {
            display: none;
        }

        #datatablesMataKuliah_length,
        #datatablesMataKuliah_filter {
            display: none;
        }

        #datatablesSemester_length,
        #datatablesSemester_filter {
            display: none;
        }

        #datatablesAbsensi_length,
        #datatablesAbsensi_filter {
            display: none;
        }

        #datatablesRuangan_length,
        #datatablesRuangan_filter {
            display: none;
        }

        #datatablesAbsensiMahasiswa_length,
    #datatablesAbsensiMahasiswa_filter {
        display: none;
    }

    #datatablesRiwayatMahasiswa_length,
    #datatablesRiwayatMahasiswa_filter {
        display: none;
    }

    #datatablesRiwayatMataKuliah_length,
    #datatablesRiwayatMataKuliah_filter {
        display: none;
    }

    #datatablesDetailAbsensi_length,
    #datatablesDetailAbsensi_filter {
        display: none;
    }
    </style>


</head>

<body class="hold-transition layout-top-nav">
    @include('sweetalert::alert')
    <div class="wrapper">

        <div class="atas">
            @include('layouts.navbar')
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0">
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

    @yield('footer')
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- jQuery -->
    <!--<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>-->
    <!--<script src="{{ asset('/assets/dataTables/datatables.min.js') }}"></script>-->


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
                "lengthMenu": [50, 100, 150, 200, 250],
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
                "lengthMenu": [50, 100, 150, 200, 250],
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
            var table = $('#datatables4').DataTable({
                "lengthMenu": [50, 100, 150, 200, 250],
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
            var table = $('#datatables5').DataTable({
                "lengthMenu": [50, 100, 150, 200, 250],
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
                "lengthMenu": [50, 100, 150, 200, 250],
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
            var table = $('#datatablesMataKuliah').DataTable({
                "lengthMenu": [50, 100, 150, 200, 250],
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
            });

            // Event listener untuk perubahan pada filter status
            $('#statusFilterRiwayatKPSkripsiProdi').on('change', function() {
                var status = $(this).val();
                // Lakukan filtering berdasarkan status yang dipilih
                filterByStatus(status);
            });

            function filterByStatus(status) {
                // Lakukan filtering menggunakan DataTables
                table.column(3).search(status ? '^' + status + '$' : '', true, false).draw();
            }

            // Event listener untuk perubahan pada filter status Mobile
            $('#statusFilterMobileRiwayatKPSkripsiProdi').on('change', function() {
                var status = $(this).val();
                // Lakukan filtering berdasarkan status yang dipilih Mobile
                filterByStatusMobileRiwayatKPSkripsiProdi(status);
            });

            function filterByStatusMobileRiwayatKPSkripsiProdi(status) {
                // Lakukan filtering menggunakan DataTables Mobile
                table.column(3).search(status ? '^' + status + '$' : '', true, false).draw();
            }

            // Filter Prodi
            $('#prodiFilterMatakuliahProdi').on('change', function() {
                var val = $(this).val();
                console.log("Selected Prodi:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });


            // Filter Prodi Mobile
            $('#prodiFilterMobileMatakuliahProdi').on('change', function() {
                var val = $(this).val();
                if (val) {
                    table.column(3).search(val).draw();
                } else {
                    table.column(3).search('').draw();
                }
            });

            
            
            // Event handler untuk panjang menu
            $('#lengthMenuMatakuliahProdi').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            // Event handler untuk panjang menu Mobile
            $('#lengthMenuMobileMatakuliahProdi').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            // Filter Pencarian
            $('#searchFilterMatakuliahSkripsiProdi').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                table.search(value).draw();
            });

            // Filter Pencarian Mobile
            $('#searchFilterMobileMatakuliahProdi').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                table.search(value).draw();
            });

            $('#datatables2_length').after($('.filter'));

            

           
        });
    </script>

<script type="text/javascript">
            $(document).ready(function() {
                var table = $('#datatablesRiwayatMataKuliah').DataTable({
                    "lengthMenu": [50, 100, 150, 200, 250],
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
                });
        
                // Filter Prodi
                $('#prodiFilterMatakuliahProdi').on('change', function() {
                var val = $(this).val();
                console.log("Selected Prodi:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val).draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('').draw(); // Corrected column index to 3 based on your table structure
                }
            });


                // Filter Prodi Mobile
                $('#prodiFilterMobileMatakuliahProdi').on('change', function() {
                    var val = $(this).val();
                    if (val) {
                        table.column(3).search(val).draw();
                    } else {
                        table.column(3).search('').draw();
                    }
                });

                  $('#semesterFilterRiwayat').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(6).search(val).draw(); 
                } else {
                    table.column(6).search('').draw(); 
                }
            });

             // Filter Prodi MobileKajur
            $('#semesterFilterMobileProdiKajur').on('change', function() {
                var val = $(this).val();
                if (val) {
                    table.column(6).search(val).draw();
                } else {
                    table.column(6).search('').draw();
                }
            });

            // Filter Prodi Mobile
            $('#semesterFilterMobileProdi').on('change', function() {
                var val = $(this).val();
                if (val) {
                    table.column(5).search(val).draw();
                } else {
                    table.column(5).search('').draw();
                }
            });
             
            $('#semesterFilterRiwayatMatakuliah').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(5).search(val).draw();
                } else {
                    table.column(5).search('').draw();
                }
            });

            $('#semesterFilterRiwayatMatakuliahKajur').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(6).search(val).draw();
                } else {
                    table.column(6).search('').draw();
                }
            });


                // Event handler untuk panjang menu
                $('#lengthMenuMatakuliahProdi').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });

                // Event handler untuk panjang menu Mobile
                $('#lengthMenuMobileMatakuliahProdi').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });

                // Filter Pencarian
                $('#searchFilterSemesterRiwayatProdi').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    table.search(value).draw();
                });

                // Filter Pencarian Mobile
                $('#searchFilterMobileRiwayatSemester').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    table.search(value).draw();
                });

                $('#datatables2_length').after($('.filter'));
              
            // Filter Prodi Mobile
                $('#semesterFilterMobileProdi').on('change', function() {
                    var val = $(this).val();
                    if (val) {
                        table.column(6).search(val).draw();
                    } else {
                        table.column(6).search('').draw();
                    }
                });

                // Filter Prodi MobileKajur
                $('#semesterFilterMobileProdiKajur').on('change', function() {
                    var val = $(this).val();
                    if (val) {
                        table.column(6).search(val).draw();
                    } else {
                        table.column(6).search('').draw();
                    }
                });
            });
        </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatablesSemester').DataTable({
                "lengthMenu": [50, 100, 150, 200, 250],
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
            });

            // Event listener untuk perubahan pada filter status
            $('#statusFilterRiwayatKPSkripsiProdi').on('change', function() {
                var status = $(this).val();
                // Lakukan filtering berdasarkan status yang dipilih
                filterByStatus(status);
            });

            function filterByStatus(status) {
                // Lakukan filtering menggunakan DataTables
                table.column(3).search(status ? '^' + status + '$' : '', true, false).draw();
            }

            // Event listener untuk perubahan pada filter status Mobile
            $('#statusFilterMobileRiwayatKPSkripsiProdi').on('change', function() {
                var status = $(this).val();
                // Lakukan filtering berdasarkan status yang dipilih Mobile
                filterByStatusMobileRiwayatKPSkripsiProdi(status);
            });

            function filterByStatusMobileRiwayatKPSkripsiProdi(status) {
                // Lakukan filtering menggunakan DataTables Mobile
                table.column(3).search(status ? '^' + status + '$' : '', true, false).draw();
            }

            // Filter Prodi
            $('#semesterFilterRiwayat').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(6).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(6).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });


            // Filter Prodi Mobile
            $('#semesterFilterMobileProdi').on('change', function() {
                var val = $(this).val();
                if (val) {
                    table.column(6).search(val).draw();
                } else {
                    table.column(6).search('').draw();
                }
            });

            // Event handler untuk panjang menu
            $('#lengthMenuRiwayatSemester').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            // Event handler untuk panjang menu Mobile
            $('#lengthMenuMobileSemesterProdi').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            // Filter Pencarian
            $('#searchFilterSemesterRiwayatProdi').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                table.search(value).draw();
            });

            // Filter Pencarian Mobile
            $('#searchFilterMobileRiwayatSemester').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                table.search(value).draw();
            });

            // Tambahkan filter jenis seminar, bulan, dan tahun di samping tombol Tampilkan
            $('#datatables2_length').after($('.filter'));
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatablesAbsensi').DataTable({
                "lengthMenu": [50, 100, 150, 200, 250],
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
            });



        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatablesRuangan').DataTable({
                "lengthMenu": [50, 100, 150, 200, 250],
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
            });

            // Event listener untuk perubahan pada filter status
            $('#statusFilterRiwayatKPSkripsiProdi').on('change', function() {
                var status = $(this).val();
                // Lakukan filtering berdasarkan status yang dipilih
                filterByStatus(status);
            });

            function filterByStatus(status) {
                // Lakukan filtering menggunakan DataTables
                table.column(3).search(status ? '^' + status + '$' : '', true, false).draw();
            }

            // Event listener untuk perubahan pada filter status Mobile
            $('#statusFilterMobileRiwayatKPSkripsiProdi').on('change', function() {
                var status = $(this).val();
                // Lakukan filtering berdasarkan status yang dipilih Mobile
                filterByStatusMobileRiwayatKPSkripsiProdi(status);
            });

            function filterByStatusMobileRiwayatKPSkripsiProdi(status) {
                // Lakukan filtering menggunakan DataTables Mobile
                table.column(3).search(status ? '^' + status + '$' : '', true, false).draw();
            }

            // Filter ruangan mobile
            $('#ruanganFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(2).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(2).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter menu ruangan absensi mobile
            $('#menuRuanganFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(2).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(2).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter hari mobile
            $('#hariFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter menu hari absensi mobile
            $('#menuHariFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter semester ruangan desktop
            $('#semesterFilterRuangan').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(2).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(2).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter semester hari desktop
            $('#semesterFilterHari').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter menu  ruangan desktop
            $('#menuFilterRuangan').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(2).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(2).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter semester hari desktop
            $('#menuFilterHari').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({
                    search: 'applied'
                }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val)
                        .draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('')
                        .draw(); // Corrected column index to 3 based on your table structure
                }
            });
            // Filter Prodi Mobile
            $('#matakuliahMobileRuangan').on('change', function() {
                var val = $(this).val();
                if (val) {
                    table.column(2).search(val).draw();
                } else {
                    table.column(2).search('').draw();
                }
            });

            // Event handler untuk panjang menu
            $('#lengthMenuRuanganMatakuliah').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            $('#lengthMenuRiwayatSemester').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });

            // Event handler untuk panjang menu Mobile
            $('#lengthMenuMobileRuangan').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });

            // Filter Pencarian
            $('#searchFilterRuanganMatakuliah').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                table.search(value).draw();
            });

            // Filter Pencarian Mobile
            $('#searchFilterMobileMatakuliahRuangan').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                table.search(value).draw();
            });

            // Tambahkan filter jenis seminar, bulan, dan tahun di samping tombol Tampilkan
            $('#datatables2_length').after($('.filter'));
        });

        $(document).ready(function() {
            var table = $('#datatablesAbsensiMahasiswa').DataTable({
                // Konfigurasi DataTables Anda di sini
            });

            $('#ruanganFilterMahasiswa').on('change', function() {
                var val = $(this).val();
                    console.log("Selected Ruangan:", val); // Debugging

                    // Log filtered data
                    var filteredData = table.rows({ search: 'applied' }).data().toArray();
                    console.log("Filtered Data:", filteredData);

                    if (val) {
                        table.column(2).search(val).draw(); // Pastikan indeks kolom benar
                    } else {
                        table.column(2).search('').draw(); // Pastikan indeks kolom benar
                    }
                });
            // Filter semester hari desktop
                $('#menuHariMahasiswa').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val).draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('').draw(); // Corrected column index to 3 based on your table structure
                }
            });

            $('#lengthMenuMobileRuangan').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });
            // Filter menu ruangan absensi mobile
                $('#menuRuanganFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(2).search(val).draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(2).search('').draw(); // Corrected column index to 3 based on your table structure
                }
            });

            // Filter menu hari absensi mobile
                $('#menuHariFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val).draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('').draw(); // Corrected column index to 3 based on your table structure
                }
            });

            
            });

            $(document).ready(function() {
            var table = $('#datatablesRiwayatMahasiswa').DataTable({
                // Konfigurasi DataTables Anda di sini
            });

            $('#semesterFilterRiwayat').on('change', function() {
                var val = $(this).val();
                    console.log("Selected Semester:", val); // Debugging

                    // Log filtered data
                    var filteredData = table.rows({ search: 'applied' }).data().toArray();
                    console.log("Filtered Data:", filteredData);

                    if (val) {
                        table.column(6).search(val).draw(); // Pastikan indeks kolom benar
                    } else {
                        table.column(6).search('').draw(); // Pastikan indeks kolom benar
                    }
                });
            // Filter semester hari desktop
                $('#menuHariMahasiswa').on('change', function() {
                var val = $(this).val();
                console.log("Selected Hari:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(3).search(val).draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(3).search('').draw(); // Corrected column index to 3 based on your table structure
                }
            });

            $('#lengthMenuRiwayatSemester').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });

                $('#searchFilterSemesterRiwayatProdi').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    table.search(value).draw();
                });
            $('#lengthMenuMobileSemesterProdi').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });

            // Filter menu ruangan absensi mobile
                $('#menuRuanganFilterMobile').on('change', function() {
                var val = $(this).val();
                console.log("Selected Semester:", val); // Add this line for debugging

                // Log filtered data
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                console.log("Filtered Data:", filteredData);

                if (val) {
                    table.column(2).search(val).draw(); // Corrected column index to 3 based on your table structure
                } else {
                    table.column(2).search('').draw(); // Corrected column index to 3 based on your table structure
                }
            });

            //filter semester mobile

            
            });

        </script>

        <script type="text/javascript">
        
            $(document).ready(function() {
            var table = $('#datatablesDetailAbsensi').DataTable({
                // Konfigurasi DataTables Anda di sini
            });

            $('#lengthMenuRiwayatSemester').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });

                $('#searchFilterSemesterRiwayatProdi').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    table.search(value).draw();
                });
            $('#lengthMenuMobileMatakuliahProdi').on('change', function() {
                    var length = $(this).val();
                    table.page.len(length).draw();
                });
            $('#searchFilterSemesterRiwayatMobile').on('keyup', function() {
                                var value = $(this).val().toLowerCase();
                                table.search(value).draw();
                            });
            
            });

    </script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"
        integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('js')
    @stack('scripts')


</body>

</html>
