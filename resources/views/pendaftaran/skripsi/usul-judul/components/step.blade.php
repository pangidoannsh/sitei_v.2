@php
    use Carbon\Carbon;
@endphp
<div class="card card-timeline px-2 border-none">
    <h5 class="text-center">
        <div class="row text-center justify-content-center mb-5">
            <div class="col-xl-6 col-lg-8">
                <!-- <h2 class="font-weight-bold mt-3">Timeline Progress Skripsi</h2> -->
                <!-- <p class="text-muted"></p> -->
            </div>
        </div>

        <ul class="bs4-order-skripsi">
            @if ($pendaftaran_skripsi->status_skripsi == 'USULAN JUDUL')
                <li class="step active">
                    <div>
                        <i class="fas"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                    $pendaftaran_skripsi->status_skripsi == 'USULKAN JUDUL ULANG')
                <li class="step aktip">
                    <div>
                        <i class="fas"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'JUDUL DISETUJUI')
                <li class="step active">
                    <div>
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>

                </li>

                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                    $pendaftaran_skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' ||
                    $pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>

                </li>

                <li class="step aktip">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>

                </li>

                <li class="step aktip">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif

            @if ($pendaftaran_skripsi->status_skripsi == 'SEMPRO SELESAI')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                    $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' ||
                    $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                    $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' ||
                    $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>

                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>

                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step active">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                    $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>

                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>

                </li>
                <li class="step aktip">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>

                </li>
                <li class="step">
                    <div><i class="fas"></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'SIDANG DIJADWALKAN' ||
                    $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step active">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'SIDANG SELESAI')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if (
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI' ||
                    $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                    $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step ">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step active">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
            @if ($pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step aktip">
                    <div><i class="fas "></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif

            @if ($pendaftaran_skripsi->status_skripsi == 'SKRIPSI SELESAI' || $pendaftaran_skripsi->status_skripsi == 'LULUS')
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> USUL JUDUL</p>
                </li>

                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SEMPRO </p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2">SIDANG </p>
                </li>
                <li class="step active">
                    <div><i class="fas fa-check"></i>
                    </div>
                    <p class="mt-2"> PENYERAHAN BUKU SKRIPSI </p>
                </li>
            @endif
        </ul>


        <!-- ----------BATAS -------------->

        @if (
            $pendaftaran_skripsi->status_skripsi == 'USULAN JUDUL' ||
                $pendaftaran_skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'USULKAN JUDUL ULANG')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 text-muted"> Tanggal diusulkan <br></span>
                    <span
                        class="mt-2 text-muted text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_usuljudul)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col ">

                </div>
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
        @endif
        @if (
            $pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                $pendaftaran_skripsi->status_skripsi == 'SEMPRO DIJADWALKAN')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col ">
                    <span class="mt-0 text-muted"> Tanggal diusulkan <br></span>
                    <span
                        class="mt-2 text-muted text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_sempro)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
        @endif

        @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_sempro_admin)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
        @endif

        @if (
            $pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                $pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'JUDUL DISETUJUI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-2 text-danger"> Batas Daftar Sempro<br></span>
                    <strong class="mt-2 text-danger"><strong class="text-bold"
                            id="timer-batas-daftar-sempro"></strong></strong>
                </div>
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
        @endif
        @if (
            $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' ||
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' ||
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">

                    @if (
                        $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                            $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
                        <span class="mt-0 text-muted"> Tanggal diusulkan <br></span>
                        <span
                            class="mt-2 text-muted text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_perpanjangan1)->translatedFormat('l, d F Y') }}</span>
                    @endif
                    @if ($pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2')
                        <span class="mt-0 text-muted"> Tanggal diusulkan <br></span>
                        <span
                            class="mt-2 text-muted text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_perpanjangan2)->translatedFormat('l, d F Y') }}</span>
                    @endif
                    @if (
                        $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                            $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                        <span class="mt-2 text-danger"> Batas Daftar Sidang<br></span>
                        <strong class="mt-2 text-danger"><strong class="text-bold"
                                id="timer-batas-daftar-sidang-p1"></strong></strong>
                    @endif
                    @if ($pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                        <span class="mt-2 text-danger"> Batas Daftar Sidang<br></span>
                        <strong class="mt-2 text-danger"><strong class="text-bold"
                                id="timer-batas-daftar-sidang-p2"></strong></strong>
                    @endif

                </div>
                <div class="col">

                </div>
            </div>
        @endif

        @if (
            $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'SEMPRO SELESAI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-2 text-danger"> Batas Daftar Sidang<br></span>
                    <strong class="mt-2 text-danger"><strong class="text-bold"
                            id="timer-batas-daftar-sidang"></strong></strong>
                </div>
                <div class="col">
                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG ULANG')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-2 text-danger"> Batas Daftar Sidang<br></span>
                    <strong
                        class="mt-2 text-danger">{{ Carbon::parse($pendaftaran_skripsi->updated_at)->addMonths(1)->translatedFormat('l, d F Y') }}</strong>
                </div>
                <div class="col">
                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 text-muted"> Tanggal diusulkan <br></span>
                    <span
                        class="mt-2 text-muted text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_sidang)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'SIDANG DIJADWALKAN')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                </div>
                <div class="col">
                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_sidang_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                </div>
            </div>
        @endif

        @if ($pendaftaran_skripsi->status_skripsi == 'SIDANG SELESAI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 text-danger"> Batas Unggah <br></span>
                    <strong class="mt-2 text-danger"><strong class="text-bold"
                            id="timer-batas-buku-skripsi"></strong></strong>
                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 text-muted"> Tanggal Usulan <br></span>
                    <span
                        class="mt-2 text-muted text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_revisi)->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        @endif

        @if (
            $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 text-danger"> Batas Unggah Penyerahan Buku Skripsi <br></span>
                    @if ($pendaftaran_skripsi->tgl_revisi_spesial == null)
                        <strong class="mt-2 text-danger"><strong class="text-bold"
                                id="timer-batas-buku-skripsi"></strong></strong>
                    @else
                        <strong
                            class="mt-2 text-danger">{{ Carbon::parse($pendaftaran_skripsi->tgl_revisi_spesial)->translatedFormat('l, d F Y') }}</strong>
                    @endif
                </div>
            </div>
        @endif

        @if (
            $pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    @if ($pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')
                        <span class="mt-0 text-muted"> Tanggal Usulan <br></span>
                        <span
                            class="mt-2 fw-bold text-muted">{{ Carbon::parse($pendaftaran_skripsi->tgl_created_sti_17)->translatedFormat('l, d F Y') }}</span>
                    @endif
                    @if ($pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                        <span class="mt-0 text-danger"> Batas Unggah Buku Skripsi <br></span>

                        @if (
                            (Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->addMonths(1) < now() &&
                                $pendaftaran_skripsi->tgl_revisi_spesial == null &&
                                $pendaftaran_skripsi->tgl_created_revisi == null) ||
                                (Carbon::parse($pendaftaran_skripsi->tgl_revisi_spesial) < now() &&
                                    $pendaftaran_skripsi->tgl_revisi_spesial !== null &&
                                    $pendaftaran_skripsi->tgl_created_revisi == null))
                            <span
                                class="mt-2 fw-bold text-danger">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y') }}</span>
                        @elseif(
                            (Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->addMonths(2) < now() &&
                                $pendaftaran_skripsi->tgl_revisi_spesial == null &&
                                $pendaftaran_skripsi->tgl_created_revisi !== null) ||
                                (Carbon::parse($pendaftaran_skripsi->tgl_revisi_spesial) < now() &&
                                    $pendaftaran_skripsi->tgl_revisi_spesial !== null &&
                                    $pendaftaran_skripsi->tgl_created_revisi !== null))
                            <span
                                class="mt-2 fw-bold text-danger">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y') }}</span>
                        @elseif($pendaftaran_skripsi->tgl_revisi_spesial == null && $pendaftaran_skripsi->tgl_created_revisi == null)
                            <span class="mt-2 fw-bold text-danger">
                                {{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y') }}
                            </span>
                        @elseif($pendaftaran_skripsi->tgl_revisi_spesial == null && $pendaftaran_skripsi->tgl_created_revisi !== null)
                            <span class="mt-2 fw-bold text-danger">
                                {{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y') }}
                            </span>
                        @elseif($pendaftaran_skripsi->tgl_revisi_spesial !== null)
                            <span class="mt-2 fw-bold text-danger">
                                {{ Carbon::parse($pendaftaran_skripsi->tgl_revisi_spesial)->translatedFormat('d F Y') }}
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'SKRIPSI SELESAI' || $pendaftaran_skripsi->status_skripsi == 'LULUS')
            <div class="row biru mb-4">
                <div class="col">
                    <span class="mt-0 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_semproselesai)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-0 "> Tanggal Selesai <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_selesai_sidang)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="col">
                    <span class="mt-2 "> Tanggal disetujui <br></span>
                    <span
                        class="mt-2 text-bold">{{ Carbon::parse($pendaftaran_skripsi->tgl_disetujui_sti_17_koordinator)->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        @endif


</div>
