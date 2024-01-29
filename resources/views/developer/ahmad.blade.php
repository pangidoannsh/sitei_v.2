<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SITEI | UNIVERSITAS RIAU</title>
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('/assets/css/developer.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style>
        * {
            font-family: "Josefin Sans", sans-serif;
            /* letter-spacing: -5px; */
            line-height: 20px;
        }

        .hr {
            border-color: #fff;
        }

        .lebar {
            width: 70%;
        }

        @media screen and (min-width: 769px) {
            .profil {
                display: none;
                visibility: hidden;
            }
        }

        @media screen and (max-width: 768px) {
            .lebar {
                width: 95%;
            }

            .atas {
                margin-top: 350px;
            }
        }
    </style>
</head>

<body>

    <div class="container p-5">
        <div class="position-absolute top-50 start-50 translate-middle atas lebar">
            <h3 class="text-white bg-success text-center p-2 rounded-top profil fw-bold">Profil Developer</h3>
            <div class="card-body">

                <div class="row  p-2">


                    <div class="col-lg-4 shadow text-center rounded-start bg-success">
                        <div class="row text-white p-4 pt-4 row-cols-1">
                            <div class="col">
                                <img src="/assets/img/Ahmad.jpg" class="rounded-circle" alt="naldi" width="100">
                                <h6 class="mt-2 ">Ahmad Fajri</h6>
                                <small>Fullstack Web Developer</small>
                                <hr class="border border-1">
                            </div>
                            <div class="col">
                                <img src="/assets/img/pakedi.jpg" class="rounded-circle" alt="pakedi" width="100">
                                <h6 class="mt-2 ">Edi Susilo, S.Pd., M.Kom., M.Eng.</h6>
                                <small>Pembimbing</small>
                                <hr class="border border-1">
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8 pt-lg-5 shadow bg-white rounded-end">
                        <div class="container pt-5 mb-5">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="fw-bold">INFORMASI</h5>
                                    <hr>
                                </div>
                                <div class="col mb-4">
                                    <div class="row row-lg-cols-2 row-md-cols-1">
                                        <div class="col">
                                            <h6 class="fw-bold">Nim</h6>
                                            <p class="text-muted">2007113809</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="fw-bold">Email</h6>
                                            <p class="text-muted">ahmadfajri1511@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="col float-center pt-3">
                                        <a class="bg-success text-white p-2 rounded-circle fs-5" formtarget="_blank"
                                            target="_blank" href="#"><i
                                                class="fab fa-instagram"></i></a>
                                        <a class="bg-success text-white p-2 rounded-circle fs-5" formtarget="_blank"
                                            target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                                        <a class="bg-success text-white p-2 rounded-circle fs-5" formtarget="_blank"
                                            target="_blank" href="#"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                </div>
                                <div class="col ">
                                    <h5 class="fw-bold mt-4">PROJECT</h5>
                                    <hr>
                                </div>
                                <div class="col">
                                    <div class="row row-lg-cols-2 row-md-cols-1">
                                        <div class="col-lg-6 col-md-12">
                                            <h6 class="fw-bold">Nama Aplikasi</h6>
                                            <p class="text-muted">Inventaris Perkuliahan</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <h6 class="fw-bold">Deskripsi Peran</h6>
                                            <p class="text-muted">Merancang Frontend dan Backend Website Sistem Inventaris
                                                Perkuliahan Jurusan Teknik Elektro Universitas Riau</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
    </div>
</body>

</html>
