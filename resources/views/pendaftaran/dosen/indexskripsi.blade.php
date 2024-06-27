@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Data Skripsi Mahasiswa
@endsection

@section('sub-title')
    Data Skripsi Mahasiswa
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
                @if (Auth::guard('dosen')->user()->role_id == 5 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11)
                    <li><a href="/prodi/kp-skripsi/seminar" class="px-1">Seminar
                            (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a></li>

                    <span class="px-2">|</span>
                    <li><a href="/kerja-praktek" class="px-1">Data KP (<span>{{ $jml_prodi_kp }}</span>)</a></li>

                    <span class="px-2">|</span>
                    <li><a href="/skripsi" class="breadcrumb-item active fw-bold text-success px-1">Data Skripsi
                            (<span>{{ $jml_prodi_skripsi }}</span>)</a></li>


                    <span class="px-2">|</span>
                    <li><a href="/prodi/riwayat" class="px-1">Riwayat
                            (<span>{{ $jml_riwayat_prodi_kp + $jml_riwayat_prodi_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_skripsi }}</span>)</a>
                    </li>
                    <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>
                @endif
            @endif

        </ol>

        <div class="container-fluid">

            @php
                // Kumpulkan semua status Skripsi
                $all_statuses = [];
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
                        <label class="pt-2 pr-2" for="lengthMenuDataSkripsiProdi">Tampilkan</label>
                        <select id="lengthMenuDataSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1"
                            style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="statusFilterDataSkripsiProdi">Status</label>
                        <select id="statusFilterDataSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1"
                            style="width: 83px;">
                            <option value="">Semua</option>
                            @foreach ($unique_statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterDataSkripsiProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1"
                        id="searchFilterDataSkripsiProdi" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileDataSkripsiProdi">Tampilkan</label>
                    <select id="lengthMenuMobileDataSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1"
                        style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="statusFilterMobileDataSkripsiProdi">Status</label>
                    <select id="statusFilterMobileDataSkripsiProdi" class="custom-select custom-select-md rounded-3 py-1"
                        style="width: 83px;">
                        <option value="">Semua</option>
                        @foreach ($unique_statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobileDataSkripsiProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1"
                        id="searchFilterMobileDataSkripsiProdi" placeholder="">
                </div>
            </div>

            <table class="table table-responsive-lg table-bordered table-striped" width="100%"
                id="datatablesdataskripsiprodi">
                <thead class="table-dark">
                    <tr>
                        <!--<th class="text-center px-0" scope="col">No.</th>-->
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <!-- <th class="text-center" scope="col">Konsentrasi</th> -->
                        <!-- <th class="text-center" scope="col">Jenis Usulan</th> -->
                        <th class="text-center" scope="col">Status Skripsi</th>
                        <th class="text-center" scope="col">Tanggal Penting</th>
                        <th class="text-center" scope="col">Durasi</th>
                        <th class="text-center" scope="col">Keterangan</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pendaftaran_skripsi as $skripsi)
                        <div></div>
                        <tr>
                            <!--<td class="text-center px-1 py-2 ">{{ $loop->iteration }}</td>-->
                            <td class="text-center px-1 py-2">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <!-- <td class="text-center px-1 py-2">{{ $skripsi->jenis_usulan }}</td> -->
                            @if (
                                $skripsi->status_skripsi == 'USULAN JUDUL' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')
                                <td class="text-center px-1 py-2 bg-secondary">{{ $skripsi->status_skripsi }}</td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'JUDUL DISETUJUI' ||
                                    $skripsi->status_skripsi == 'SEMPRO SELESAI' ||
                                    $skripsi->status_skripsi == 'SIDANG SELESAI' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' ||
                                    $skripsi->status_skripsi == 'SKRIPSI SELESAI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')
                                <td class="text-center px-1 py-2 bg-info">{{ $skripsi->status_skripsi }}</td>
                            @endif
                            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN')
                                <td class="text-center px-1 py-2 bg-success">{{ $skripsi->status_skripsi }}</td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                                    $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                                <td class="text-center px-1 py-2 bg-danger">{{ $skripsi->status_skripsi }}</td>
                            @endif

                            <!-- Tanggal Penting -->
                            @if ($skripsi->status_skripsi == 'USULAN JUDUL')
                                <td class="text-center px-1 py-2"><small> Tanggal Usulan:
                                        <br></small>
                                    {{ Carbon::parse($skripsi->tgl_created_usuljudul)->translatedFormat('d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Disetujui:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->translatedFormat(' d F Y') }}
                                    <br>
                                    @if (Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6) < now())
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Daftar Sempro : <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y') }}</span>
                                    @else
                                        <small class="text-dark"> Batas Daftar Sempro: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y') }}
                                    @endif
                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK')
                                <td class="text-center px-1 py-2"><small> Tanggal Usulan:
                                        <br></small>
                                    {{ Carbon::parse($skripsi->tgl_created_sempro)->translatedFormat(' d F Y') }}
                                    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK')
                                        <br>
                                        @if (Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6) < now())
                                            <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat
                                                Batas Daftar Sempro : <br></small>
                                            <span
                                                class="text-danger">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y') }}</span>
                                        @else
                                            <small class="text-dark"> Batas Daftar Sempro: <br></small>
                                            {{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y') }}
                                        @endif
                                    @endif
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Disetujui:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_sempro_admin)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN')
                                <td class="text-center px-1 py-2"> <small> Tanggal Dijadwalkan:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_jadwalsempro)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'SEMPRO SELESAI')
                                <td class="text-center px-1 py-2">
                                    <small> Selesai Sempro:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_semproselesai)->translatedFormat('d F Y') }}
                                    <br>
                                    @if (Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6) < now())
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Daftar Sidang: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y') }}</span>
                                    @else
                                        <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y') }}
                                    @endif
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
                                <td class="text-center px-1 py-2"><small> Tanggal Usulan:
                                        <br></small>
                                    {{ Carbon::parse($skripsi->tgl_created_perpanjangan1)->translatedFormat('d F Y') }}
                                    <br><small> Selesai Sempro:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_semproselesai)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Disetujui:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_perpanjangan1_kaprodi)->translatedFormat(' d F Y') }}
                                    <br>
                                    <small> Selesai Sempro:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_semproselesai)->translatedFormat('d F Y') }}
                                    <br>
                                    @if (Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9) < now())
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Daftar Sidang: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y') }}</span>
                                    @else
                                        <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y') }}
                                    @endif

                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK')
                                <td class="text-center px-1 py-2"> <small> Tanggal Usulan:
                                        <br></small>
                                    {{ Carbon::parse($skripsi->tgl_created_perpanjangan2)->translatedFormat('d F Y') }}
                                    <small> Selesai Sempro:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_semproselesai)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Disetujui:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_perpanjangan2_kaprodi)->translatedFormat(' d F Y') }}
                                    <br>
                                    <small> Selesai Sempro: <br> </small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->translatedFormat('d F Y') }}
                                    <br>
                                    @if (Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12) < now())
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Daftar Didang: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y') }}</span>
                                    @else
                                        <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y') }}
                                    @endif

                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG')
                                <td class="text-center px-1 py-2"> <small> Tanggal Usulan:
                                        <br></small>
                                    {{ Carbon::parse($skripsi->tgl_created_sidang)->translatedFormat('d F Y') }}

                                    @if ($skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK')
                                        @if (Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6) < now() &&
                                                $skripsi->tgl_disetujui_perpanjangan1_kaprodi == null &&
                                                $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                            <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat
                                                Batas Daftar Sidang: <br></small>
                                            <span
                                                class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y') }}</span>
                                        @elseif($skripsi->tgl_disetujui_perpanjangan1_kaprodi == null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                            <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                            {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y') }}
                                        @elseif(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9) < now() &&
                                                $skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null &&
                                                $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                            <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat
                                                Batas Daftar Sidang: <br></small>
                                            <span
                                                class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y') }}</span>
                                        @elseif($skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                            <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                            {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y') }}
                                        @elseif(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12) < now() &&
                                                $skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null &&
                                                $skripsi->tgl_disetujui_perpanjangan2_kaprodi !== null)
                                            <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat
                                                Batas Daftar Sidang: <br></small>
                                            <span
                                                class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y') }}</span>
                                        @elseif($skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi !== null)
                                            <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                            {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y') }}
                                        @endif
                                    @endif
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Disetujui:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_sidang_kaprodi)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'SIDANG SELESAI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Selesai:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_selesai_sidang)->translatedFormat(' d F Y') }}
                                    <br>
                                    @if (Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1) < now())
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Penyerahan Skripsi: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y') }}</span>
                                    @else
                                        <small class="text-dark">Batas Penyerahan Skripsi: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y') }}
                                    @endif
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'SIDANG DIJADWALKAN')
                                <td class="text-center px-1 py-2"> <small> Tanggal Dijadwalkan:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_jadwal_sidang)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK')
                                <td class="text-center px-1 py-2"> <small> Tanggal Usulan:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_created_revisi)->translatedFormat(' d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                                <td class="text-center px-1 py-2"> <small> Tanggal Disetujui:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_disetujui_revisi_kaprodi)->translatedFormat(' d F Y') }}
                                    <br>
                                    @if (
                                        (Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2) < now() && $skripsi->tgl_revisi_spesial == null) ||
                                            (Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null))
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Penyerahan Skripsi: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y') }}</span>
                                    @elseif($skripsi->tgl_revisi_spesial !== null)
                                        <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_revisi_spesial)->translatedFormat('d F Y') }}
                                    @else
                                        <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y') }}
                                    @endif
                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                                <td class="text-center px-1 py-2"> <small> Tanggal Usulan:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_created_sti_17)->translatedFormat(' d F Y') }}
                                    <br>
                                    @if (
                                        (Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1) < now() &&
                                            $skripsi->tgl_revisi_spesial == null &&
                                            $skripsi->tgl_created_revisi == null) ||
                                            (Carbon::parse($skripsi->tgl_revisi_spesial) < now() &&
                                                $skripsi->tgl_revisi_spesial !== null &&
                                                $skripsi->tgl_created_revisi == null))
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Penyerahan Skripsi: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y') }}</span>
                                    @elseif(
                                        (Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2) < now() &&
                                            $skripsi->tgl_revisi_spesial == null &&
                                            $skripsi->tgl_created_revisi !== null) ||
                                            (Carbon::parse($skripsi->tgl_revisi_spesial) < now() &&
                                                $skripsi->tgl_revisi_spesial !== null &&
                                                $skripsi->tgl_created_revisi !== null))
                                        <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas
                                            Penyerahan Skripsi: <br></small>
                                        <span
                                            class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y') }}</span>
                                    @elseif($skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi == null)
                                        <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y') }}
                                    @elseif($skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi !== null)
                                        <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y') }}
                                    @elseif($skripsi->tgl_revisi_spesial !== null)
                                        <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                        {{ Carbon::parse($skripsi->tgl_revisi_spesial)->translatedFormat('d F Y') }}
                                    @endif
                                </td>
                            @endif

                            <!-- DURASI -->
                            @php
                                $tanggalMulaiSkripsi = Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi);
                                $tanggalSelesai = Carbon::now();

                                $durasiSkripsi = $tanggalMulaiSkripsi
                                    ? $tanggalMulaiSkripsi->diffInMonths($tanggalSelesai)
                                    : null;
                                $bulan = $durasiSkripsi ? floor($durasiSkripsi) : null;
                                $hari = $tanggalMulaiSkripsi
                                    ? $tanggalMulaiSkripsi->addMonths($bulan)->diffInDays($tanggalSelesai)
                                    : null;
                            @endphp

                            <td class="text-center px-1 py-2">
                                <b> {{ $bulan ?? 0 }} </b> <small>Bulan</small> <br> <b> {{ $hari }} </b>
                                <small>Hari</small>
                            </td>


                            @if (
                                $skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                                    $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                                <td class="text-center px-1 py-2 text-danger">{{ $skripsi->keterangan }}</td>
                            @elseif(
                                ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Skripsi' &&
                                    Auth::guard('dosen')->user()->role_id == 9) ||
                                    ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Skripsi' &&
                                        Auth::guard('dosen')->user()->role_id == 10) ||
                                    ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Skripsi' &&
                                        Auth::guard('dosen')->user()->role_id == 11))
                                <td class="text-center px-1 py-2 text-success">
                                    <i class="fas fa-circle small-icon"></i> {{ $skripsi->keterangan }}
                                </td>
                            @elseif(
                                ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' &&
                                    Auth::guard('dosen')->user()->role_id == 6) ||
                                    ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' &&
                                        Auth::guard('dosen')->user()->role_id == 7) ||
                                    ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' &&
                                        Auth::guard('dosen')->user()->role_id == 8))
                                <td class="text-center px-1 py-2 text-success">
                                    <i class="fas fa-circle small-icon"></i> {{ $skripsi->keterangan }}
                                </td>
                            @else
                                <td class="text-center px-1 py-2">{{ $skripsi->keterangan }}</td>
                            @endif

                            <!-- USUL JUDUL  -->
                            @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                <td class="text-center px-1 py-2">

                                    <a href="/usuljudul/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                                        data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>
                                    @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                        <a href='/dosen/statistik/{{ $skripsi->mahasiswa_nim }}' type="button"
                                            class="badge btn btn-info p-1" data-bs-toggle="tooltip">
                                            <i class="fa fa-bar-chart"></i>
                                        </a>
                                    @endif
                                </td>
                            @endif

                            <!-- DAFTAR SEMPRO -->
                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                    $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' ||
                                    $skripsi->status_skripsi == 'SEMPRO SELESAI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK')
                                <td class="text-center px-1 py-2">
                                    <a href="/daftar-sempro/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                    <a href='/dosen/statistik/{{ $skripsi->mahasiswa_nim }}' type="button"
                                        class="badge btn btn-info p-1" data-bs-toggle="tooltip">
                                        <i class="fa fa-bar-chart"></i>
                                    </a>
                                </td>
                            @endif

                            <!-- DAFTAR SIDANG -->
                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                                    $skripsi->status_skripsi == 'SIDANG DIJADWALKAN' ||
                                    $skripsi->status_skripsi == 'SIDANG SELESAI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/daftar-sidang/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/perpanjangan-1/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/perpanjangan-2/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'PERPANJANGAN REVISI' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/perpanjangan-revisi/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' ||
                                    $skripsi->status_skripsi == 'SKRIPSI SELESAI')
                                <td class="text-center px-1 py-2">
                                    <a href="/bukti-buku-skripsi/detail/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

                                </td>
                            @endif
                    @endforeach
                </tbody>


            </table>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waitingApprovalCount = {!! json_encode($jml_prodi_skripsi) !!};
            const batasCount = {!! json_encode($status_daftar1 + $status_daftar2 + $status_daftar3) !!};
            if (waitingApprovalCount > 0 && batasCount == 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Skripsi',
                    html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> yang melaksanakan Skripsi.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                    allowOutsideClick: false,
                });
            } else if (batasCount > 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Skripsi',
                    html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> yang melaksanakan Skripsi.
                Dan <strong class="text-danger"> ${batasCount} Mahasiswa</strong> Lewat Batas Waktu. <br>
                
            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                Berikut adalah mahasiswa yang lewat batas waktu : 
                <br>
                <br>
                <div>
                    <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="">
                    <tbody class="bg-danger">
                        @foreach ($batas_skripsi as $skripsi)
                            <tr class="bg-danger ">
                                <td class="text-center text-light px-1 py-2">{{ $skripsi->mahasiswa->nim }}</td>
                                <td class="text-left text-light pl-3 pr-1 py-2">{{ $skripsi->mahasiswa->nama }}</td>
                                @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                    <td class="text-center px-1 py-2 text-light">Lewat Batas Daftar Seminar Proposal</td>
                                @endif
                                @if (
                                    $skripsi->status_skripsi == 'SIDANG SELESAI' ||
                                        $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' ||
                                        $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                                    <td class="text-center px-1 py-2 text-light">Lewat Batas Penyerahan Buku Skripsi</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <br>
                @foreach ($batas_skripsi as $skripsi)
                <form action="/lewat-batas-skripsi/hapus/{{ $skripsi->id }}" method="POST">
                @endforeach
                    @method('put')
                    @csrf
                    <button type="submit" class="btn px-4 py-2 fw-bold btn-success">OK</button>
                </form>
                @endif
                `,
                    icon: 'info',
                    showConfirmButton: false,
                    confirmButtonColor: '#28a745',
                    width: '800px',
                    allowOutsideClick: false,
                });
            } else {
                Swal.fire({
                    title: 'Ini adalah halaman Skripsi',
                    html: `Belum ada mahasiswa yang melaksanakan Skripsi.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                    allowOutsideClick: false,
                });
            }
        });
    </script>
@endpush()

@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush()
