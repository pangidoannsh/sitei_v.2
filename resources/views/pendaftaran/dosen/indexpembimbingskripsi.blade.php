@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Daftar Bimbingan Skripsi
@endsection

@section('sub-title')
    Daftar Bimbingan Skripsi
@endsection


@section('content')

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">
            <li>
                <a href="/persetujuan-kp-skripsi" class="px-1">Persetujuan @if (Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11 )
                       (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi + $jml_persetujuan_seminar }}</span>)
                      @endif
                    @if(Auth::guard('dosen')->user()->role_id == 5 || Auth::guard('dosen')->user()->role_id == null)
                        (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi }}</span>)
                    @endif</a>
            </li>

            <span class="px-2">|</span>
            <li><a href="/kp-skripsi/seminar-pembimbing-penguji" class="px-1">Seminar (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>) </a></li>
            <span class="px-2">|</span>
            <li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP (<span>{{ $jml_bimbingankp }}</span>)</a></li>
            <span class="px-2">|</span>
            <li><a href="/pembimbing/skripsi" class="breadcrumb-item active fw-bold text-success px-1">Bimbingan Skripsi
                    (<span>{{ $jml_bimbingan_skripsi }}</span>)</a></li>
            <span class="px-2">|</span>
            <li><a href="/pembimbing-penguji/riwayat-bimbingan" class="px-1">Riwayat
                    (<span>{{ $jml_riwayat_kp + $jml_riwayat_skripsi + $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_sidang }}</span>)</a></li>
            <span class="px-2">|</span>
                    <li><a href="/statistik" class="px-1">Statistik (All)</a></li>

        </ol>



        <div class="container-fluid">
            
            <p class="alert-warning p-2"><i class="fas fa-exclamation-triangle px-2 fw-bold"></i> Mahasiswa yang
                        LEWAT BATAS, Anda berhak menghapus mahasiswa tersebut dari daftar bimbingan (Sudah tidak masuk
                        remunerasi/SKSR)</p>
                        @if (session()->has('message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        
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
                        <label class="pt-2 pr-2" for="lengthMenuBimbinganSkripsi">Tampilkan</label>
                        <select id="lengthMenuBimbinganSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="input-group ml-3" style="width: max-content;">
                        <label class="pt-2 pr-2" for="statusFilterBimbinganSkripsi">Status</label>
                        <select id="statusFilterBimbinganSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 83px;">
                            <option value="">Semua</option>
                            @foreach ($unique_statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterBimbinganSkripsi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterBimbinganSkripsi" placeholder="">
                </div>
            </div>

            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileBimbinganSkripsi">Tampilkan</label>
                    <select id="lengthMenuMobileBimbinganSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="statusFilterMobileBimbinganSkripsi">Status</label>
                    <select id="statusFilterMobileBimbinganSkripsi" class="custom-select custom-select-md rounded-3 py-1" style="width: 83px;">
                        <option value="">Semua</option>
                        @foreach ($unique_statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterMobileBimbinganSkripsi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileBimbinganSkripsi" placeholder="">
                </div>
            </div>



            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatablesbimbinganskripsi">
                <thead class="table-dark">
                    
                    <tr>
                        <!--<th class="text-center px-0" scope="col">No.</th>-->
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center fw-bold" scope="col">Nama</th>
                        <!-- <th class="text-center" scope="col">Konsentrasi</th> -->
                        <th class="text-center" scope="col">Status</th>
                        {{-- <th class="text-center" scope="col">Tanggal Usulan</th> --}}
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
                            <!--<td class="text-center px-1 py-2">{{ $loop->iteration }}</td>-->
                            <td class="text-center px-1 py-2">{{ $skripsi->mahasiswa->nim }}</td>
                            <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                            <!-- <td class="text-center px-1 py-2">{{ $skripsi->konsentrasi->nama_konsentrasi }}</td>            -->

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


                            <!-- TANGGAL USULAN -->
                            
                            {{-- @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_usuljudul)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI' || $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SEMPRO SELESAI' )
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_sempro)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_perpanjangan1)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif


                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_perpanjangan2)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI' || $skripsi->status_skripsi == 'SIDANG SELESAI' ||$skripsi->status_skripsi == 'SIDANG DIJADWALKAN')
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_sidang)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_revisi)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                                <td class="text-center px-1 py-2">{{ Carbon::parse($skripsi->tgl_created_sti_17)->translatedFormat('l, d F Y') }}
                                </td>
                            @endif --}}


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
                                         @if(Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6) < now())
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sempro : <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y')}}</span>
                                    @else
                                    <small class="text-dark"> Batas Daftar Sempro: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y')}}
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
                                    @if($skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK')
                                    <br>
                                      @if(Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6) < now())
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sempro : <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y')}}</span>
                                    @else
                                    <small class="text-dark"> Batas Daftar Sempro: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi)->addMonths(6)->translatedFormat('d F Y')}}
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
                                    @if(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6) < now())
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sidang: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y')}}</span>
                                    @else
                                    <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y')}}
                                    @endif
                                </td>
                            @endif

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
                                <td class="text-center px-1 py-2"><small> Tanggal Usulan:
                                        <br></small>
                                {{ Carbon::parse($skripsi->tgl_created_perpanjangan1)->translatedFormat('d F Y') }}    
                                <small> Selesai Sempro:
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
                                @if(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9) < now())
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sidang: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y')}}</span>
                                    @else
                                    <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y')}}
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
                                @if(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12) < now())
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Didang: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y')}}</span>
                                    @else
                                    <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y')}}
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
                                    <br>
                                    @if ($skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK')

                                    @if(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6) < now() && $skripsi->tgl_disetujui_perpanjangan1_kaprodi == null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sidang: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y')}}</span>
                                    @elseif($skripsi->tgl_disetujui_perpanjangan1_kaprodi == null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                    <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6)->translatedFormat('d F Y')}}
                                    
                                    @elseif(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9) < now() && $skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sidang: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y')}}</span>
                                    @elseif($skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi == null)
                                    <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9)->translatedFormat('d F Y')}}
                                    
                                    @elseif(Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12) < now() && $skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi !== null)
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Daftar Sidang: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y')}}</span>
                                    @elseif($skripsi->tgl_disetujui_perpanjangan1_kaprodi !== null && $skripsi->tgl_disetujui_perpanjangan2_kaprodi !== null)
                                    <small class="text-dark"> Batas Daftar Sidang: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12)->translatedFormat('d F Y')}}
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
                                    @if(Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1) < now())
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Penyerahan Skripsi: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y')}}</span>
                                    @else
                                    <small class="text-dark">Batas Penyerahan Skripsi: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y')}}
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
                                    @if(Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2) < now() && $skripsi->tgl_revisi_spesial == null || Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null)
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Penyerahan Skripsi: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y')}}</span>
                                    @elseif($skripsi->tgl_revisi_spesial !== null)
                                    <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_revisi_spesial)->translatedFormat('d F Y')}}
                                    @else
                                    <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y')}}
                                    @endif
                                </td>
                            @endif

                            @if (
                                $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                                <td class="text-center px-1 py-2"> <small> Tanggal Usulan:
                                        <br></small>{{ Carbon::parse($skripsi->tgl_created_sti_17)->translatedFormat(' d F Y') }}
                                        <br>
                                    @if(Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1) < now() && $skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi == null || Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null && $skripsi->tgl_created_revisi == null)
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Penyerahan Skripsi: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y')}}</span>
                                    
                                    @elseif(Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2) < now() && $skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi !== null || Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null && $skripsi->tgl_created_revisi !== null)
                                    <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Lewat Batas Penyerahan Skripsi: <br></small>
                                    <span class="text-danger">{{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y')}}</span>
                                    @elseif($skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi == null)
                                    <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1)->translatedFormat('d F Y')}}
                                    @elseif($skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi !== null)
                                    <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2)->translatedFormat('d F Y')}}
                                    @elseif($skripsi->tgl_revisi_spesial !== null )
                                    <small class="text-dark"> Batas Penyerahan Skripsi: <br></small>
                                    {{ Carbon::parse($skripsi->tgl_revisi_spesial)->translatedFormat('d F Y')}}
                                    
                                    @endif
                                </td>
                            @endif

                             <!-- DURASI -->
                            @php
                                $tanggalMulaiSkripsi = Carbon::parse($skripsi->tgl_disetujui_usuljudul_kaprodi);
                                $tanggalSelesai= Carbon::now();

                                $durasiSkripsi = $tanggalMulaiSkripsi ? $tanggalMulaiSkripsi->diffInMonths($tanggalSelesai) : null;
                                $bulan = $durasiSkripsi ? floor($durasiSkripsi) : null;
                                $hari = $tanggalMulaiSkripsi ? $tanggalMulaiSkripsi->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                                        @endphp

                            <td class="text-center px-1 py-2">
                                      <b>{{ $bulan ?? 0}} </b> <small>Bulan</small> <br> <b>{{ $hari }} </b> <small>Hari</small>
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
                                ($skripsi->pembimbing_1_nip == Auth::user()->nip && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1') ||
                                    ($skripsi->pembimbing_2_nip == Auth::user()->nip &&
                                        $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 2'))
                                <td class="text-center px-1 py-2 text-success">
                                    <i class="fas fa-circle small-icon"></i> {{ $skripsi->keterangan }}
                                </td>
                            @else
                                <td class="text-center px-1 py-2">{{ $skripsi->keterangan }}</td>
                            @endif

                            <!-- USUL JUDUL  -->
                            @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                <td class="text-center px-1 py-2">

                                    <a href="/usuljudul/detail/pembimbing/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>

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
                                    <a href="/daftar-sempro/detail/pembimbing/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>

                                    @if($skripsi->status_skripsi == 'SEMPRO SELESAI' && Carbon::parse($skripsi->tgl_semproselesai)->addMonths(6) < now())
                                    <br>
                                    <a href="#ModalGagal" data-toggle="modal"
                                        class="badge btn btn-danger p-2 mt-2"><i class="fas fa-trash fa-lg"></i></a>

                                    <div class="modal fade"id="ModalGagal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2">
                                                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                                                        <p class="text-center">Mahasiswa akan dihapus dari Daftar Bimbingan Anda. Data tidak bisa dikembalikan!</p>
                                                        <div class="row mb-3 justify-content-center text-center">
                                                           
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <form
                                                                    action="/lewat-batas-sidang/hapus/{{ $skripsi->id }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                           
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                </td>
                            @endif

                            <!-- DAFTAR SIDANG -->
                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                    $skripsi->status_skripsi == 'SIDANG DIJADWALKAN' ||
                                    $skripsi->status_skripsi == 'SIDANG SELESAI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                                    $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG')
                                <td class="text-center px-1 py-2">
                                    <a href="/daftar-sidang/detail/pembimbing/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>
                                @if ($skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' && $skripsi->keterangan == 'Batas Waktu Penyerahan Buku Skripsi Habis')
                                    <br>
                                    <a href="#ModalSidangUlang" data-toggle="modal"
                                        class="badge btn btn-danger p-2 mt-2"><i class="fas fa-trash fa-lg"></i></a>

                                    <div class="modal fade"id="ModalSidangUlang">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2">
                                                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                                                        <p class="text-center">Mahasiswa akan dihapus dari Daftar Bimbingan Anda. Data tidak bisa dikembalikan!</p>
                                                         <div class="row mb-3 justify-content-center text-center">
                                                           
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <form
                                                                    action="/lewat-batas-penyerahan-skripsi/hapus/{{ $skripsi->id }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                           
                                                        </div>


                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/kp-skripsi/pembimbing/perpanjangan-1/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>
                                    @if($skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' && Carbon::parse($skripsi->tgl_semproselesai)->addMonths(9) < now())
                                    <br>
                                    <a href="#ModalGagal" data-toggle="modal"
                                        class="badge btn btn-danger p-2 mt-2"><i class="fas fa-trash fa-lg"></i></a>

                                    <div class="modal fade"id="ModalGagal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2">
                                                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                                                        <p class="text-center">Mahasiswa akan dihapus dari Daftar Bimbingan Anda. Data tidak bisa dikembalikan!</p>
                                                         <div class="row mb-3 justify-content-center text-center">
                                                           
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <form
                                                                    action="/lewat-batas-sidang/hapus/{{ $skripsi->id }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                           
                                                        </div>


                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/kp-skripsi/pembimbing/perpanjangan-2/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                 @if($skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' && Carbon::parse($skripsi->tgl_semproselesai)->addMonths(12) < now())
                                    <br>
                                    <a href="#ModalGagal" data-toggle="modal"
                                        class="badge btn btn-danger p-2 mt-2"><i class="fas fa-trash fa-lg"></i></a>

                                    <div class="modal fade"id="ModalGagal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2">
                                                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                                                        <p class="text-center">Mahasiswa akan dihapus dari Daftar Bimbingan Anda. Data tidak bisa dikembalikan!</p>
                                                         <div class="row mb-3 justify-content-center text-center">
                                                           
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <form
                                                                    action="/lewat-batas-sidang/hapus/{{ $skripsi->id }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                           
                                                        </div>


                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'PERPANJANGAN REVISI' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                                <td class="text-center px-1 py-2">
                                    <a href="/kp-skripsi/pembimbing/perpanjangan-revisi/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>

                                    @if($skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' && Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null)
                                    <br>
                                    <a href="#ModalRevisiSpesial" data-toggle="modal"
                                        class="badge btn btn-danger p-2 mt-2"><i class="fas fa-trash fa-lg"></i></a>

                                    <div class="modal fade"id="ModalRevisiSpesial">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2">
                                                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                                                        <p class="text-center">Mahasiswa akan dihapus dari Daftar Bimbingan Anda. Data tidak bisa dikembalikan!</p>
                                                        <div class="row mb-3 justify-content-center text-center">
                                                           
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <form
                                                                    action="/lewat-batas-revisi-spesial/hapus/{{ $skripsi->id }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                           
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                </td>
                            @endif
                            @if (
                                $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' ||
                                    $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' ||
                                    $skripsi->status_skripsi == 'SKRIPSI SELESAI')
                                <td class="text-center px-1 py-2">
                                    <a href="/kp-skripsi/pembimbing/bukti-buku-skripsi/{{ $skripsi->id }}"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

                                        @if(Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(1) < now() && $skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi == null || Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null && $skripsi->tgl_created_revisi == null || Carbon::parse($skripsi->tgl_selesai_sidang)->addMonths(2) < now() && $skripsi->tgl_revisi_spesial == null && $skripsi->tgl_created_revisi !== null || Carbon::parse($skripsi->tgl_revisi_spesial) < now() && $skripsi->tgl_revisi_spesial !== null && $skripsi->tgl_created_revisi !== null)
                                    <br>
                                    <a href="#ModalRevisiSpesial" data-toggle="modal"
                                        class="badge btn btn-danger p-2 mt-2"><i class="fas fa-trash fa-lg"></i></a>

                                    <div class="modal fade"id="ModalRevisiSpesial">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2">
                                                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                                                        <p class="text-center">Mahasiswa akan dihapus dari Daftar Bimbingan Anda. Data tidak bisa dikembalikan!</p>
                                                        <div class="row mb-3 justify-content-center text-center">
                                                           
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <form
                                                                    action="/lewat-batas-revisi-spesial/hapus/{{ $skripsi->id }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                           
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </td>
                            @endif



                        </tr>
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
            const waitingApprovalCount = {!! json_encode($jml_bimbingan_skripsi) !!};
            const batasCount = {!! json_encode($status_daftar1 + $status_daftar2 + $status_daftar3 ) !!};

            const totalKuota = {!! json_encode($kapasitas_bimbingan_skripsi) !!};
            const sisaKuota = totalKuota - waitingApprovalCount;

            if (waitingApprovalCount > 0 && waitingApprovalCount < totalKuota && batasCount == 0) {

                Swal.fire({
                    title: 'Ini adalah halaman Bimbingan Skripsi',
                    html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda sedang melaksanakan Skripsi. <br>
            Anda memiliki sisa <strong class="text-info">${sisaKuota} kuota </strong>Mahasiswa Bimbingan Skripsi.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            } else if (waitingApprovalCount >= totalKuota && batasCount == 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Bimbingan Skripsi',
                    html: `Ada <strong class="text-danger"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda sedang melaksanakan Skripsi. <br>
            Kuota Mahasiswa Bimbingan Anda <strong class="text-danger">Sudah Penuh</strong>!`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            }
            else if (waitingApprovalCount > 0 && waitingApprovalCount < totalKuota && batasCount > 0) {
               Swal.fire({
                title: 'Ini adalah halaman Skripsi',
                html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda sedang melaksanakan Skripsi. <br>
            Anda memiliki sisa <strong class="text-info">${sisaKuota} kuota </strong>Mahasiswa Bimbingan Skripsi.
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
                                    @if ($skripsi->status_skripsi == 'SIDANG SELESAI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
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
            } 
            else if (waitingApprovalCount >= totalKuota && batasCount > 0) {
               Swal.fire({
                title: 'Ini adalah halaman Skripsi',
                html: `Ada <strong class="text-danger"> ${waitingApprovalCount} Mahasiswa</strong> bimbingan Anda sedang melaksanakan Skripsi. <br>
            Kuota Mahasiswa Bimbingan Anda <strong class="text-danger">Sudah Penuh</strong>!
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
                                    @if ($skripsi->status_skripsi == 'SIDANG SELESAI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
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
            } 
             else {

                Swal.fire({
                    title: 'Ini adalah halaman Bimbingan Skripsi',
                    html: `Belum ada mahasiswa dibawah bimbingan Anda. <br> Anda masih memiliki <strong class="text-info">${totalKuota} kuota</strong> mahasiswa bimbingan`,
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
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush()