@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Bimbingan Mahasiswa
@endsection

@section('sub-title')
    Riwayat Bimbingan Mahasiswa
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                <li>
                    <a href="/persetujuan-kp-skripsi" class="px-1">Persetujuan @if (Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11 )
                       (<span>{{$jml_persetujuan_kp + $jml_persetujuan_skripsi + $jml_persetujuan_seminar}}</span>)
                      @endif
                    @if(Auth::guard('dosen')->user()->role_id == 5 || Auth::guard('dosen')->user()->role_id == null)
                        (<span>{{$jml_persetujuan_kp + $jml_persetujuan_skripsi}}</span>)
                    @endif</a>
                </li>

                <span class="px-2">|</span>
                <li><a href="/kp-skripsi/seminar-pembimbing-penguji" class="px-1">Seminar (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a></li>
                <span class="px-2">|</span>
                <li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP (<span>{{ $jml_bimbingankp }}</span>)</a>
                </li>
                <span class="px-2">|</span>
                <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi (<span>{{ $jml_bimbingan_skripsi }}</span>)</a>
                </li>
                <span class="px-2">|</span>
                <li><a href="/pembimbing-penguji/riwayat-bimbingan"
                        class="breadcrumb-item active fw-bold text-success px-1">Riwayat
                        (<span>{{ $jml_riwayat_kp + $jml_riwayat_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_sidang }}</span>)</a></li>
                <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>
            @endif

            @if (Str::length(Auth::guard('web')->user()) > 0)

                @if (Str::length(Auth::guard('web')->user()) > 0)
                    @if (Auth::guard('web')->user()->role_id == 2 ||
                            Auth::guard('web')->user()->role_id == 3 ||
                            Auth::guard('web')->user()->role_id == 4)
                        <a href="/persetujuan/admin/index" class="btn bg-light border  border-bottom-0"
                            style="border-top-left-radius: 15px;">Persetujuan</a>
                    @endif
                @endif
                <a href="/kerja-praktek/admin/index" class="btn bg-light border  border-bottom-0 ">
                    <span class="button-text">Kerja Praktek</span>
                    <span class="badge-link">
                        <a href="/kerja-praktek/pembimbing/nilai-keluar" class="sejarah pt-2 bg-success ">
                            <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i
                                    class="fas fa-history"></i></i></span>
                        </a>
                    </span>
                </a>
                <a href="/sidang/admin/index" class="btn bg-light border  border-bottom-0 ">
                    <span class="button-text">Skripsi</span>
                    <span class="badge-link">
                        <a href="/skripsi/pembimbing/nilai-keluar" class="sejarah pt-2 bg-light "
                            style="border-top-right-radius: 15px;">
                            <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i
                                    class="fas fa-history"></i></i></span>
                        </a>
                    </span>
                </a>
            @endif

        </ol>

        <div class="container-fluid">

            <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Riwayat KP dan Skripsi</h5>
                    <hr>
                </div>
            </div>
            
            @php
            // Kumpulkan semua status KP dan Skripsi
            $all_statuses = [];
            foreach ($pendaftaran_kp as $kp) {
                $all_statuses[] = $kp->status_kp;
            }
            foreach ($pendaftaran_skripsi as $skripsi) {
                $all_statuses[] = $skripsi->status_skripsi;
            }
            // Hapus duplikat status dan urutkan
            $unique_statuses = array_unique($all_statuses);
            sort($unique_statuses);
            @endphp

            <!-- Desktop Version -->
            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenuRiwayatKPSkripsi">Tampilkan</label>
                        <select id="lengthMenuRiwayatKPSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="statusFilterRiwayatKPSkripsi">Status</label>
                        <select id="statusFilterRiwayatKPSkripsi" class="custom-select custom-select-md rounded-3 py-1">
                            <option value="">Semua</option>
                            @foreach ($unique_statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterRiwayatKPSkripsi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterRiwayatKPSkripsi" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileRiwayatKPSkripsi">Tampilkan</label>
                    <select id="lengthMenuMobileRiwayatKPSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="statusFilterMobileRiwayatKPSkripsi">Status</label>
                    <select id="statusFilterMobileRiwayatKPSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 83px;">
                        <option value="">Semua</option>
                        @foreach ($unique_statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobileRiwayatKPSkripsi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileRiwayatKPSkripsi" placeholder="">
                </div>
            </div>

            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatablesriwayatkpdanskripsi">
                <thead class="table-dark">
                    <tr>
                        <!-- <th class="text-center" scope="col">No.</th> -->
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <!-- <th class="text-center" scope="col">Konsentrasi</th>   -->
                        <!-- <th class="text-center" scope="col">Jenis Usulan</th> -->
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Durasi</th>
                        <th class="text-center" scope="col">Semester</th>
                        <th class="text-center" scope="col">Keterangan</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pendaftaran_kp as $kp)
                        <div></div>
                        <tr>
                            <!-- <td class="text-center">{{ $loop->iteration }}</td>                              -->
                            <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                            <!-- <td class="text-center">{{ $kp->mahasiswa->konsentrasi->nama_konsentrasi }}</td>            -->
                            <!-- <td class="text-center">{{ $kp->jenis_usulan }}</td>                       -->
                            <td class="text-center bg-info">{{ $kp->status_kp }}</td>
                            @php
                                $tanggalMulaiKP = $kp->tgl_disetujui_balasan ? Carbon::parse($kp->tgl_disetujui_balasan) : null;
                                $tanggalSelesai = $kp->tgl_disetujui_kpti_10_kaprodi ? Carbon::parse($kp->tgl_disetujui_kpti_10_kaprodi) : null;

                                $durasiKP = $tanggalMulaiKP ? $tanggalMulaiKP->diffInMonths($tanggalSelesai) : null;
                                $bulan = $durasiKP ? floor($durasiKP) : null;
                                $hari = $tanggalMulaiKP ? $tanggalMulaiKP->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                            @endphp

                            <td class="text-center px-1 py-2">
                                <b>{{ $bulan ?? 0}}</b> <small>Bulan</small> <br> <b>{{ $hari }}</b> <small>Hari</small>
                            </td>

                            @php
                                    $tanggalSelesai = $kp->tgl_disetujui_kpti_10_koordinator;

                                    $semester = App\Models\Semester::where('tanggal_mulai', '<=', $tanggalSelesai)
                                        ->where('tanggal_selesai', '>=', $tanggalSelesai)
                                        ->first();
                            @endphp
                            <td class="text-center pl-3 pr-1">
                                {{ $semester->semester ?? '-' }} {{ $semester->tahun_ajaran ?? '' }} 
                            </td>

                            <td class="text-center">{{ $kp->keterangan }}</td>

                            <td class="text-center">
                                <a href="/kpti10/detail/riwayat/pembimbingprodi/{{ $kp->id }}" class="badge btn btn-info p-1"
                                    data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a> <br>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($pendaftaran_skripsi as $skripsi)
                        <div></div>
                        <tr>
                            <!-- <td class="text-center">{{ $loop->iteration }}</td>-->
                            <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <!-- <td class="text-center">{{ $skripsi->konsentrasi->nama_konsentrasi }}</td>-->

                            <!-- <td class="text-center">{{ $skripsi->jenis_usulan }}</td>    -->
                            <!-- USUL JUDUL  -->
                            

                            @if ($skripsi->status_skripsi == 'LULUS')
                                <td class="text-center bg-info">{{ $skripsi->status_skripsi }}</td>
                            @endif
                            <!-- ___________batas____________ -->

                            @php
                                $tanggalMulaiSkripsi = $skripsi->tgl_disetujui_usuljudul_kaprodi ? Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi) : null;
                                $tanggalSelesai = $skripsi->tgl_disetujui_sti_17_koordinator ? Carbon::parse($skripsi->tgl_disetujui_sti_17_koordinator) : null;

                                $durasiSkripsi = $tanggalMulaiSkripsi ? $tanggalMulaiSkripsi->diffInMonths($tanggalSelesai) : null;
                                $bulan = $durasiSkripsi ? floor($durasiSkripsi) : null;
                                $hari = $tanggalMulaiSkripsi ? $tanggalMulaiSkripsi->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                                @endphp

                                <td class="text-center px-1 py-2">
                                    <b>{{ $bulan ?? 0 }}</b> <small>Bulan</small> <br> <b>{{ $hari }}</b> <small>Hari</small>
                                </td>

                            @php
                                    $tanggalLulus = $skripsi->tgl_disetujui_sti_17_koordinator;

                                    $semester = App\Models\Semester::where('tanggal_mulai', '<=', $tanggalLulus)
                                        ->where('tanggal_selesai', '>=', $tanggalLulus)
                                        ->first();
                            @endphp
                            <td class="text-center">
                                {{ $semester->semester ?? '-' }} {{ $semester->tahun_ajaran ?? '' }} 
                            </td>

                            <td class="text-center">{{ $skripsi->keterangan }}</td>
                            <!-- USUL JUDUL  -->
                            @if ($skripsi->status_skripsi == 'LULUS')
                                <td class="text-center">
                                    <a href="/kp-skripsi/riwayat/pembimbing/bukti-buku-skripsi/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>


            </table>
        </div>
    </div>

    <div class="container card p-4 mt-5">
        <div class="container-fluid">
            <!-- <hr class="pt-1 mt-2 bg-dark"> -->

            <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Riwayat Seminar</h5>
                    <hr>
                </div>
            </div>
            
            @php
                $jenis_seminar = [];

            // Ambil jenis seminar dari data seminar KP dan tambahkan ke dalam array
            foreach ($penjadwalan_kps as $kp) {
                $jenis_seminar[] = $kp->jenis_seminar;
            }

            // Ambil jenis seminar dari data seminar Sempro dan tambahkan ke dalam array
            foreach ($penjadwalan_sempros as $sempro) {
                $jenis_seminar[] = $sempro->jenis_seminar;
            }

            // Ambil jenis seminar dari data seminar Skripsi dan tambahkan ke dalam array
            foreach ($penjadwalan_skripsis as $skripsi) {
                $jenis_seminar[] = $skripsi->jenis_seminar;
            }

            // Hilangkan duplikasi jenis seminar
            $jenis_seminar = array_unique($jenis_seminar);

            // Tetapkan semua jenis seminar yang diinginkan
            $all_jenis_seminar = ['Seminar KP', 'Seminar Proposal', 'Sidang Skripsi'];

            // Gabungkan semua jenis seminar yang ada dengan semua jenis seminar yang diinginkan
            $jenis_seminar = array_merge($all_jenis_seminar, $jenis_seminar);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $jenis_seminar = array_unique($jenis_seminar);

            @endphp

            @php
            // Array tetap berisi semua nama bulan dalam bahasa Indonesia
            $bulan_tetap = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Inisialisasi array untuk opsi bulan
            $bulan_options = [];

            // Ambil bulan dari data seminar KP
            foreach ($penjadwalan_kps as $kp) {
                $bulan = Carbon::parse($kp->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Ambil bulan dari data seminar Sempro
            foreach ($penjadwalan_sempros as $sempro) {
                $bulan = Carbon::parse($sempro->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Ambil bulan dari data seminar Skripsi
            foreach ($penjadwalan_skripsis as $skripsi) {
                $bulan = Carbon::parse($skripsi->tanggal)->translatedFormat('F');
                if (!in_array($bulan, $bulan_options)) {
                    $bulan_options[] = $bulan;
                }
            }

            // Gabungkan semua nama bulan yang ditemukan dengan array tetap bulan
            $bulan_options = array_merge($bulan_tetap, $bulan_options);

            // Hilangkan duplikasi
            $bulan_options = array_unique($bulan_options);

            // Urutkan nama bulan sesuai dengan urutan bulan Indonesia
            usort($bulan_options, function($a, $b) use ($bulan_tetap) {
                return array_search($a, $bulan_tetap) - array_search($b, $bulan_tetap);
            });
            @endphp

            @php
            // Inisialisasi array untuk opsi tahun
            $tahun_options = [];

            // Ambil tahun dari data seminar KP
            foreach ($penjadwalan_kps as $kp) {
                $tahun = Carbon::parse($kp->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Ambil tahun dari data seminar Sempro
            foreach ($penjadwalan_sempros as $sempro) {
                $tahun = Carbon::parse($sempro->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Ambil tahun dari data seminar Skripsi
            foreach ($penjadwalan_skripsis as $skripsi) {
                $tahun = Carbon::parse($skripsi->tanggal)->year;
                if (!in_array($tahun, $tahun_options)) {
                    $tahun_options[] = $tahun;
                }
            }

            // Urutkan tahun dari yang terkecil
            sort($tahun_options);
            @endphp
            
            <!-- Desktop Version -->
            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenu">Tampilkan</label>
                        <select id="lengthMenu" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="seminarFilter">Seminar</label>
                        <select id="seminarFilter" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($jenis_seminar as $jenis)
                                <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="bulanFilter">Bulan</label>
                        <select id="bulanFilter" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($bulan_options as $bulan)
                                <option value="{{ $bulan }}" class="text-capitalize">{{ $bulan }}</option>
                            @endforeach
                        </select>                    
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="tahunFilter">Tahun</label>
                        <select id="tahunFilter" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                            <option value="" selected>Semua</option>
                            @foreach ($tahun_options as $tahun)
                                <option value="{{ $tahun }}" class="text-capitalize">{{ $tahun }}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilter">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilter" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobile">Tampilkan</label>
                    <select id="lengthMenuMobile" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterMobile">Seminar</label>
                    <select id="seminarFilterMobile" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="bulanFilterMobile">Bulan</label>
                    <select id="bulanFilterMobile" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($bulan_options as $bulan)
                            <option value="{{ $bulan }}" class="text-capitalize">{{ $bulan }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="tahunFilterMobile">Tahun</label>
                    <select id="tahunFilterMobile" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($tahun_options as $tahun)
                            <option value="{{ $tahun }}" class="text-capitalize">{{ $tahun }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobile">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobile" placeholder="">
                </div>
            </div>

            <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatablesriwayatseminar">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Seminar</th>
                        <th class="text-center" scope="col">Prodi</th>
                        <th class="text-center" scope="col">Tanggal</th>
                        <th class="text-center" scope="col">Waktu</th>
                        <th class="text-center" scope="col">Lokasi</th>
                        <th class="text-center" scope="col">Pembimbing</th>
                        <th class="text-center" scope="col">Penguji</th>
                        <!-- <th class="text-center" scope="col">Hasil</th> -->
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($penjadwalan_kps as $kp)
                        <tr>
                            <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                            <td class="bg-primary text-center">{{ $kp->jenis_seminar }}</td>
                            <td class="text-center">{{ $kp->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}</td>
                            <td class="text-center">{{ $kp->waktu }}</td>
                            <td class="text-center">{{ $kp->lokasi }}</td>
                            <td class="text-center">
                                <p>{{ $kp->pembimbing->nama_singkat }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $kp->penguji->nama_singkat }}</p>
                            </td>
                            <!-- @if ($kp->status_seminar == 1)
                                <td class="text-center">Lulus</td>
                            @else
                                <td class="text-center">Belum Lulus</td>
                            @endif -->

                            <td class="text-center">
                                <a formtarget="_blank" target="_blank"
                                    href="/undangan-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-secondary p-2 mb-1"style="border-radius:20px;">Undangan</a>
                                    <br>
                                 @if ($kp->penguji_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-info p-2"style="border-radius:20px;">Perbaikan</a>
                                <a formtarget="_blank" target="_blank" href="/nilai-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-success mt-1 mb-1 p-2"style="border-radius:20px;">Form Nilai</a>
                            @endif
                            @if ($kp->pembimbing_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujikp/{{ Crypt::encryptString($kp->id) }}/{{ $kp->penguji->nip }}"
                                    class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/beritaacara-kp/{{ Crypt::encryptString($kp->id) }}"
                                    class="badge bg-danger mt-1 p-2"style="border-radius:20px;">Berita Acara</a>
                            @endif
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($penjadwalan_sempros as $sempro)
                        <tr>
                            <td class="text-center">{{ $sempro->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $sempro->mahasiswa->nama }}</td>
                            <td class="bg-success text-center">{{ $sempro->jenis_seminar }}</td>
                            <td class="text-center">{{ $sempro->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">{{ $sempro->waktu }}</td>
                            <td class="text-center">{{ $sempro->lokasi }}</td>
                            <td class="text-center">
                                @if ($sempro->pembimbingsatu == !null)
                                <p>1. {{ $sempro->pembimbingsatu->nama_singkat }}</p>
                                @endif
                                @if ($sempro->pembimbingdua == !null)
                                    <p>2. {{ $sempro->pembimbingdua->nama_singkat }}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <p>1. {{ $sempro->pengujisatu->nama_singkat }}</p>
                                <p>2. {{ $sempro->pengujidua->nama_singkat }}</p>
                                @if ($sempro->pengujitiga == !null)
                                    <p>3. {{ $sempro->pengujitiga->nama_singkat }}</p>
                                @endif
                            </td>
                            <!-- @if ($sempro->status_seminar == 1)
                                <td class="text-center">Lulus</td>
                            @else
                                <td class="text-center">Belum Lulus</td>
                            @endif -->

                            <td class="text-center">
                                <a formtarget="_blank" target="_blank"
                                    href="/undangan-sempro/{{ Crypt::encryptString($sempro->id) }}"
                                    class="badge bg-secondary p-2 mb-1"style="border-radius:20px;">Undangan</a>
                                    <br>
                               <a formtarget="_blank" target="_blank"
                                href="/nilai-sempro/{{ Crypt::encryptString($sempro->id) }}" class="badge bg-success p-2"
                                style="border-radius:20px;">Lihat Nilai</a> <br>

                            @if (
                                $sempro->pengujisatu_nip == auth()->user()->nip ||
                                    $sempro->pengujidua_nip == auth()->user()->nip ||
                                    $sempro->pengujitiga_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-sempro/{{ Crypt::encryptString($sempro->id) }}"
                                    class="badge bg-primary p-2 my-1" style="border-radius:20px;">Perbaikan</a>
                            @endif

                            @if ($sempro->pembimbingsatu_nip == auth()->user()->nip || $sempro->pembimbingdua_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujisempro/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujisatu->nip }}"
                                    class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujisempro/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujidua->nip }}"
                                    class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
                                @if ($sempro->pengujitiga == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/perbaikan-pengujisempro/{{ Crypt::encryptString($sempro->id) }}/{{ $sempro->pengujitiga->nip }}"
                                        class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji
                                        3</a>
                                @endif
                            @endif

                            @if ($sempro->pengujisatu_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/penilaian-sempro/beritaacara-sempro/{{ Crypt::encryptString($sempro->id) }}"
                                    class="badge bg-warning p-2" style="border-radius:20px;">Berita Acara</a>
                            @endif

                            </td>
                        </tr>
                    @endforeach

                    @foreach ($penjadwalan_skripsis as $skripsi)
                        <tr>
                            <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                            <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>
                            <td class="text-center">{{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">{{ $skripsi->waktu }}</td>
                            <td class="text-center">{{ $skripsi->lokasi }}</td>
                            <td class="text-center">
                                @if ($skripsi->pembimbingsatu == !null)
                                <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>
                                @endif
                                @if ($skripsi->pembimbingdua == !null)
                                    <p>2. {{ $skripsi->pembimbingdua->nama_singkat }}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <p>1. {{ $skripsi->pengujisatu->nama_singkat }}</p>
                                <p>2. {{ $skripsi->pengujidua->nama_singkat }}</p>
                                @if ($skripsi->pengujitiga == !null)
                                    <p>3. {{ $skripsi->pengujitiga->nama_singkat }}</p>
                                @endif
                            </td>

                            <!-- @if ($skripsi->status_seminar == 3)
                                <td class="text-center">Lulus</td>
                            @elseif ($skripsi->status_seminar == 2)
                                <td class="text-center">Menunggu persetujuan Koordinator Program Studi</td>
                            @elseif ($skripsi->status_seminar == 1)
                                <td class="text-center">Menunggu persetujuan Koordinator Skripsi</td>
                            @else
                                <td class="text-center">Belum Lulus</td>
                            @endif -->

                            <td class="text-center">
                                <a formtarget="_blank" target="_blank"
                                    href="/undangan-sidang/{{ Crypt::encryptString($skripsi->id) }}"
                                    class="badge bg-secondary p-2 mb-1"style="border-radius:20px;">Undangan</a>
                                    <br>
                               <a formtarget="_blank" target="_blank"
                                href="/nilai-skripsi/{{ Crypt::encryptString($skripsi->id) }}"
                                class="badge bg-success p-2" style="border-radius:20px;">Lihat Nilai</a> <br>
                            @if (
                                $skripsi->pengujisatu_nip == auth()->user()->nip ||
                                    $skripsi->pengujidua_nip == auth()->user()->nip ||
                                    $skripsi->pengujitiga_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-skripsi/{{ Crypt::encryptString($skripsi->id) }}"
                                    class="badge bg-primary p-2 my-1" style="border-radius:20px;">Perbaikan</a>
                            @endif

                            @if ($skripsi->pembimbingsatu_nip == auth()->user()->nip || $skripsi->pembimbingdua_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujiskripsi/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujisatu->nip }}"
                                    class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
                                <a formtarget="_blank" target="_blank"
                                    href="/perbaikan-pengujiskripsi/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujidua->nip }}"
                                    class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
                                @if ($skripsi->pengujitiga == !null)
                                    <a formtarget="_blank" target="_blank"
                                        href="/perbaikan-pengujiskripsi/{{ Crypt::encryptString($skripsi->id) }}/{{ $skripsi->pengujitiga->nip }}"
                                        class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji
                                        3</a>
                                @endif
                            @endif

                            @if ($skripsi->pengujisatu_nip == auth()->user()->nip)
                                <a formtarget="_blank" target="_blank"
                                    href="/penilaian-skripsi/beritaacara-skripsi/{{ Crypt::encryptString($skripsi->id) }}"
                                    class="badge bg-warning p-2" style="border-radius:20px;">Berita Acara</a>
                            @endif
                            
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>

         <div class="d-flex align-items-end flex-column fixed-bottom bd-highlight mb-5">
        <div class="mt-auto p-2 bd-highlight ">
            <span onclick="scrollToTop()" id="scrollToTopBtn" title="Kembali ke Atas" style="width: 40px; height: 40px; cursor: pointer;"><i class="fas fa-chevron-circle-up fa-lg fs-2"></i></span>
        </div>
        </div>
<br>
<br>
<br>
<br>
    @endsection
    


    @section('footer')
        <section class="bg-dark p-1">
            <div class="container">
                <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                            class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                            target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a>
                        <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                            href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                            class="text-success fw-bold">&</span>
                        <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                            href="/developer/m-seprinaldi"> M. Seprinaldi</a><span
                            class="text-success fw-bold">)</span></small></p>
            </div>
        </section>
    @endsection


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const waitingApprovalCount = {!! json_encode($jml_riwayat_kp + $jml_riwayat_skripsi) !!};
                if (waitingApprovalCount > 0) {
                    Swal.fire({
                        title: 'Ini adalah halaman Riwayat Bimbingan',
                        html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda telah selesai melaksanakan Kerja Praktek dan Skripsi.`,
                        icon: 'info',
                        showConfirmButton: true,
                        confirmButtonColor: '#28a745',
                    });
                } else {
                    Swal.fire({
                        title: 'Ini adalah halaman Riwayat Bimbingan',
                        html: `Belum ada mahasiswa bimbingan Anda selesai Kerja Praktek dan Skripsi.`,
                        icon: 'info',
                        showConfirmButton: true,
                        confirmButtonColor: '#28a745',
                    });
                }
            });
        </script>
    @endpush()

    @push('scripts')
        <script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            document.getElementById("scrollToTopBtn").style.display = "block";
        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }
    </script>
    @endpush()
