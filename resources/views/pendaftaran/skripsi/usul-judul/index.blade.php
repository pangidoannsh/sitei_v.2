@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Skripsi
@endsection
@section('sub-title')
    Skripsi
@endsection


@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @php
        $tanggalDisetujuiUsulJudul = $pendaftaran_skripsi->tgl_disetujui_usuljudul_kaprodi;
        $tanggalGagalSempro = $pendaftaran_skripsi->tgl_created_sempro;
        $tanggalSelesaiSempro = $pendaftaran_skripsi->tgl_semproselesai;
        $tanggalPerpanjangan1 = $pendaftaran_skripsi->tgl_disetujui_perpanjangan1;
        $tanggalDitolakSidang = $pendaftaran_skripsi->tgl_created_sidang;
        $tanggalDisetujuiSidang = $pendaftaran_skripsi->tgl_selesai_sidang;
    @endphp

    <div class="container-fluid">
        @include('pendaftaran.skripsi.usul-judul.components.step')

        @if (
            $pendaftaran_skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                $pendaftaran_skripsi->status_skripsi == 'USULKAN JUDUL ULANG')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Usulkan Judul
                        Skripsi Ulang!</span>
                </div>
            </div>
        @endif

        @if ($pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Daftar Sempro
                        Ulang!</span>

                </div>
            </div>
        @endif

        @if ($batal_sempro != null)
            @if (
                $pendaftaran_skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI' ||
                    $pendaftaran_skripsi->keterangan == 'Daftar Sempro Dibatalkan')
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle fw-bold"></i> <span class="pl-2">Jadwal Sempro
                            dibatalkan.</span> <span class="fw-bold">{{ $batal_sempro->alasan }}</span>, <span> Sempro
                            akan dijadwalkan ulang.</span>

                    </div>
                </div>
            @endif
        @endif

        @if ($batal_sidang != null)
            @if (
                $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI' ||
                    $pendaftaran_skripsi->keterangan == 'Daftar Sidang Dibatalkan')
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle fw-bold"></i> <span class="pl-2">Jadwal Sidang
                            dibatalkan.</span> <span class="fw-bold">{{ $batal_sidang->alasan }}</span>, <span> Sidang
                            akan dijadwalkan ulang.</span>

                    </div>
                </div>
            @endif
        @endif

        @if (
            $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                $pendaftaran_skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Daftar Sidang
                        Skripsi Ulang!</span>

                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Daftar Sidang atau
                        Usulkan Perpanjangan Waktu Skripsi Ulang!</span>

                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Daftar Sidang atau
                        Usulkan Perpanjangan Waktu Skripsi Ulang!</span>

                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Unggah Bukti
                        Penyerahan Buku Skripsi atau Usulkan Perpanjangan Revisi Skripsi Ulang!</span>

                </div>
            </div>
        @endif
        @if ($pendaftaran_skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle fw-bold"></i> <span
                        class="pl-2 fw-bold">{{ $pendaftaran_skripsi->alasan }}</span>, <span>Silahkan Unggah Bukti
                        Penyerahan Buku Skripsi Ulang!</span>

                </div>
            </div>
        @endif

        @include('pendaftaran.skripsi.usul-judul.components.tableusulan')
        <br>
        <div class="anak-judul">
            <h4>Progress Report</h4>
            <hr>
        </div>
        {{-- Button Create --}}
        @if (in_array($pendaftaran_skripsi->status_skripsi, ['JUDUL DISETUJUI', 'DAFTAR SEMPRO DITOLAK']))
            @if ($lastProposal && $lastProposal->created_at->translatedFormat('d F Y') === $currentDate)
                <button id="addLogbook" class="btn mahasiswa btn-success mb-3 font-weight-bold">
                    + Proposal
                </button>
            @else
                <a href="/progress/proposal/tambah" class="btn mahasiswa btn-success mb-3 font-weight-bold">+ Proposal</a>
            @endif
        @elseif(in_array($pendaftaran_skripsi->status_skripsi, [
                'SEMPRO SELESAI',
                'PERPANJANGAN 1',
                'PERPANJANGAN 1 DISETUJUI',
                'PERPANJANGAN 1 DITOLAK',
                'PERPANJANGAN 2',
                'PERPANJANGAN 2 DISETUJUI',
                'PERPANJANGAN 2 DITOLAK',
                'DAFTAR SIDANG DITOLAK',
            ]))
            @if ($lastSkripsi && $lastSkripsi->created_at->translatedFormat('d F Y') === $currentDate)
                <button id="addLogbook" class="btn mahasiswa btn-success mb-3 font-weight-bold">
                    + Skripsi</button>
            @else
                <a href="/progress/skripsi/tambah" class="btn mahasiswa btn-success mb-3 font-weight-bold">+ Skripsi</a>
            @endif
        @endif

        @if (isset($isRiwayat))
            @include('pendaftaran.skripsi.usul-judul.components.pr-riwayat')
        @else
            @include('pendaftaran.skripsi.usul-judul.components.pr-persetujuan')
        @endif

        {{-- Modal Approve Progress Report --}}
        <div class="modal fade" id="ModalApprove">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2">
                            <h3 class="text-center">Batas Maksimal LogBook</h3>
                            <p class="text-center">LogBook maksimal 1 kali 1 hari, coba lagi besok</p>
                            <div class="row text-center">
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn p-2 px-3 btn-secondary"
                                        data-dismiss="modal">Tidak</button>
                                </div>
                                <div class="col-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>

@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
    </section>
@endsection

<!-- Script untuk mengurangi jumlah hari setiap hari -->
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
    <script>
        $('#addLogbook').on('click', (e) => {
            Swal.fire({
                title: 'Batas Maksimal Logbook',
                text: 'LogBook maksimal 1 kali 1 hari, coba lagi besok',
                icon: 'info',
            })
        })
    </script>
    <script>
        // Fungsi untuk menghitung waktu tersisa
        moment.locale('id');

        function hitungWaktuBatasDaftarSempro(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalDisetujuiUsulJudul = moment(targetDate);

            var tanggalTerakhirDaftar = tanggalDisetujuiUsulJudul.add(6, 'months');

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftar.format('dddd, D MMMM YYYY');

            document.getElementById("timer-batas-daftar-sempro").textContent = formatTanggalTerakhirDaftar;
        }

        hitungWaktuBatasDaftarSempro("{{ $tanggalDisetujuiUsulJudul }}");
    </script>
    <script>
        // Fungsi untuk menghitung waktu tersisa
        moment.locale('id');

        // Fungsi untuk menghitung waktu tersisa
        function hitungWaktuTersisa(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalGagalSempro = moment(targetDate);

            // Menambahkan satu bulan ke tanggal disetujui KP
            var tanggalSeminarKP = tanggalGagalSempro.add(1, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)
            var formatTanggal = tanggalSeminarKP.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-gagal-sempro").textContent = formatTanggal;
        }

        hitungWaktuTersisa("{{ $tanggalGagalSempro }}");

        function hitungWaktuBatas(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalGagalSempro = moment(targetDate);


            var tanggalTerakhirDaftarSeminarKP = tanggalGagalSempro.add(6, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminarKP.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-batas-daftar-gagal-sempro").textContent = formatTanggalTerakhirDaftar;
        }

        // Memanggil fungsi hitungWaktuBatas dengan tanggal disetujui KP

        hitungWaktuBatas("{{ $tanggalGagalSempro }}");
    </script>
    <script>
        moment.locale('id');

        function hitungWaktuBatas(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalSelesaiSempro = moment(targetDate);


            var tanggalTerakhirDaftarSeminar = tanggalSelesaiSempro.add(6, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminar.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-batas-daftar-sidang").textContent = formatTanggalTerakhirDaftar;
        }

        // Memanggil fungsi hitungWaktuBatas dengan tanggal disetujui KP

        hitungWaktuBatas("{{ $tanggalSelesaiSempro }}");
    </script>
    <script>
        moment.locale('id');

        function hitungWaktuBatas(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalSelesaiSempro = moment(targetDate);


            var tanggalTerakhirDaftarSeminar = tanggalSelesaiSempro.add(9, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminar.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-batas-daftar-sidang-p1").textContent = formatTanggalTerakhirDaftar;
        }

        // Memanggil fungsi hitungWaktuBatas dengan tanggal disetujui KP

        hitungWaktuBatas("{{ $tanggalSelesaiSempro }}");
    </script>
    <script>
        moment.locale('id');

        function hitungWaktuBatas(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalSelesaiSempro = moment(targetDate);


            var tanggalTerakhirDaftarSeminar = tanggalSelesaiSempro.add(12, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminar.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-batas-daftar-sidang-p2").textContent = formatTanggalTerakhirDaftar;
        }

        // Memanggil fungsi hitungWaktuBatas dengan tanggal disetujui KP

        hitungWaktuBatas("{{ $tanggalSelesaiSempro }}");
    </script>
    <script>
        // Fungsi untuk menghitung waktu tersisa
        moment.locale('id');

        // Fungsi untuk menghitung waktu tersisa
        function hitungWaktuTersisa(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalDitolakSidang = moment(targetDate);

            // Menambahkan satu bulan ke tanggal disetujui KP
            var tanggalSeminar = tanggalDitolakSidang.add(1, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)
            var formatTanggal = tanggalSeminar.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-sidang-ulang").textContent = formatTanggal;
        }

        hitungWaktuTersisa("{{ $tanggalDitolakSidang }}");

        function hitungWaktuBatas(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalDitolakSidang = moment(targetDate);


            var tanggalTerakhirDaftarSeminar = tanggalDitolakSidang.add(6, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminar.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-batas-daftar-sidang-ulang").textContent = formatTanggalTerakhirDaftar;
        }

        // Memanggil fungsi hitungWaktuBatas dengan tanggal disetujui KP

        hitungWaktuBatas("{{ $tanggalDitolakSidang }}");
    </script>
    <script>
        // Fungsi untuk menghitung waktu tersisa
        moment.locale('id');

        function hitungWaktuBatas(targetDate) {
            // Mengubah tanggal disetujui KP menjadi objek moment
            var tanggalDisetujuiSidang = moment(targetDate);


            var tanggalTerakhirDaftarSeminar = tanggalDisetujuiSidang.add(1, 'months');

            // Mendapatkan format tanggal yang diinginkan (Hari, 1 Juli 2023)

            var formatTanggalTerakhirDaftar = tanggalTerakhirDaftarSeminar.format('dddd, D MMMM YYYY');

            // Menampilkan tanggal di dalam elemen dengan id "timer"
            document.getElementById("timer-batas-buku-skripsi").textContent = formatTanggalTerakhirDaftar;
        }

        // Memanggil fungsi hitungWaktuBatas dengan tanggal disetujui KP

        hitungWaktuBatas("{{ $tanggalDisetujuiSidang }}");
    </script>
@endpush
