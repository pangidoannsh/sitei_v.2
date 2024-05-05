@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Statistik Bimbingan Kerja Praktek
@endsection

@section('sub-title')
    Statistik Bimbingan Kerja Praktek
@endsection



@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container card p-4">


        <ol class="breadcrumb col-lg-12">

            <li>
                <a href="/statistik" class="px-1">Statistik</a>
            </li>

            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-kp" class="breadcrumb-item active fw-bold text-success px-1">Bimbingan KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-skripsi" class="px-1">Bimbingan Skripsi</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/riwayat-kp" class="px-1">Riwayat KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/judul-skripsi-terdaftar" class="px-1">Riwayat Skripsi</a></li>

        </ol>

        <div class="container-fluid">

        <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Daftar Beban Bimbingan Kerja Praktek</h5>
                    <hr>
                </div>
        </div>
        
        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuDaftarBebanBimbinganKP">Tampilkan</label>
                    <select id="lengthMenuDaftarBebanBimbinganKP" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterDaftarBebanBimbinganKP">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterDaftarBebanBimbinganKP" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileDaftarBebanBimbinganKP">Tampilkan</label>
                <select id="lengthMenuMobileDaftarBebanBimbinganKP" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileDaftarBebanBimbinganKP">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileDaftarBebanBimbinganKP" placeholder="">
            </div>
        </div>
        
        <table class="table table-responsive-lg rounded table-bordered table-striped" width="100%" id="datatablesdaftarbebanbimbingankp">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">No.</th>
                        <th class="text-center" scope="col">Kode Dosen</th>
                        <th class="text-center" scope="col">Nama Dosen</th>
                        <th class="text-center" scope="col">Total Bimbingan</th>
                        <th class="text-center" scope="col">Rerata Membimbing</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($dosen as $dosen)
                        <div></div>
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $dosen->nama_singkat }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td class="text-center @if ($dosen->pendaftaran_k_p_count >= $kapasitas->kapasitas_kp) bg-danger @endif bg-info">
                                <b>{{ $dosen->pendaftaran_k_p_count }} </b></td>
                            
                            <td class="text-center bg-info">
                                @php
                                $pendaftaranKP = $dosen->pendaftaranKP()->whereNotIn('status_kp', ['KP SELESAI', 'USULAN KP DITOLAK', 'USULKAN KP ULANG'])->get();
                                $totalBulan = 0;
                                $totalHari = 0;
                                $totalMhs = $pendaftaranKP->count();
                                if ($totalMhs > 0) {
                                foreach ($pendaftaranKP as $pendaftaran) {
                                $tanggalMulaiKP = $pendaftaran->tgl_disetujui_usulankp_kaprodi ? \Carbon\Carbon::parse($pendaftaran->tgl_disetujui_usulankp_kaprodi) : null;
                                $tanggalSelesai = $pendaftaran->tgl_selesai_semkp ? \Carbon\Carbon::parse($pendaftaran->tgl_selesai_semkp) : null;
                                $durasiKP = $tanggalMulaiKP ? $tanggalMulaiKP->diffInMonths($tanggalSelesai) : null;
                                $bulan = $durasiKP ? floor($durasiKP) : null;
                                $hari = $tanggalMulaiKP ? $tanggalMulaiKP->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                                if ($durasiKP !== null) {
                                $totalBulan += $bulan;
                                $totalHari += $hari;
                                }
                                }
                                $totalBulan = $totalBulan / $totalMhs;
                                $totalHari = $totalHari / $totalMhs;
                                }
                                @endphp
                                <b>{{ round($totalBulan) }}</b> <small>Bulan</small> <br> <b>{{ round($totalHari) }}</b> <small>Hari</small>
                            </td>

                            <td class="text-center">
                                <a href="/detail/kuota-bimbingan/kp/{{ $dosen->nip }}" class="badge btn btn-info p-1 mb-1"
                                    data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                            </td>
                    @endforeach
                </tbody>
        </table>
           
        </div>
    </div>

    
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title fw-bold ">Keterangan :</h5> <br>
                <span class="card-text">Kuota maksimal bimbingan KP adalah <b> {{ $kapasitas->kapasitas_kp }} Orang. </b>
                </span>
            </div>
        </div>



        <div class="card p-4">

        <div class="mb-4 rounded bg-light">
                <div class="p-2 pt-3">
                    <h5 class="">Daftar Selesai Bimbingan Kerja Praktek</h5>
                    <hr>
                </div>
        </div>
        
        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuDaftarSelesaiBimbinganKP">Tampilkan</label>
                    <select id="lengthMenuDaftarSelesaiBimbinganKP" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterDaftarSelesaiBimbinganKP">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterDaftarSelesaiBimbinganKP" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileDaftarSelesaiBimbinganKP">Tampilkan</label>
                <select id="lengthMenuMobileDaftarSelesaiBimbinganKP" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileDaftarSelesaiBimbinganKP">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileDaftarSelesaiBimbinganKP" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg rounded table-bordered table-striped" width="100%" id="datatablesdaftarselesaibimbingankp">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">No.</th>
                        <th class="text-center" scope="col">Kode Dosen</th>
                        <th class="text-center" scope="col">Nama Dosen</th>
                        <th class="text-center" scope="col">Total Lulus</th>
                        <th class="text-center" scope="col">Rerata Membimbing</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

    @foreach ($dosen_lulus as $dosen)
    @php
        $pendaftaranKP = $dosen->pendaftarankp()->where('status_kp', 'KP SELESAI')->get();
        $totalBulan = 0;
        $totalHari = 0;
    @endphp

    @if($pendaftaranKP->count() > 0)
        <div></div>
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $dosen->nama_singkat }}</td>
            <td>{{ $dosen->nama }}</td>
            <td class="text-center bg-info">
                <b>{{ $pendaftaranKP->count() }}</b>
            </td>

            @foreach ($pendaftaranKP as $pendaftaran)
                @php
                    $tanggalMulaiKP = $pendaftaran->tanggal_mulai ? \Carbon\Carbon::parse($pendaftaran->tanggal_mulai) : null;
                    $tanggalSelesai = $pendaftaran->tgl_disetujui_kpti_10_koordinator ? \Carbon\Carbon::parse($pendaftaran->tgl_disetujui_kpti_10_koordinator) : null;
                    $totalMhs = $pendaftaranKP->count();

                    $durasiKP = $tanggalMulaiKP ? $tanggalMulaiKP->diffInMonths($tanggalSelesai) : null;
                    $bulan = $durasiKP ? floor($durasiKP) : null;
                    $hari = $tanggalMulaiKP ? $tanggalMulaiKP->addMonths($bulan)->diffInDays($tanggalSelesai) : null;
                    
                    if ($durasiKP !== null) {
                        $totalBulan += $bulan / $totalMhs;
                        $totalHari += $hari / $totalMhs;
                    }
                @endphp
            @endforeach
            <td class="text-center bg-info">
                   <b> {{ round($totalBulan) }}</b> <small>Bulan</small> <br> <b>{{ round($totalHari) }}</b> <small>Hari</small>
                   
            </td>

            <td class="text-center">
                <a href="/detail/lulus-bimbingan/kp/{{ $dosen->nip }}" class="badge btn btn-info p-1 mb-1"
                    data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
        </tr>
    @endif
@endforeach
                </tbody>
            </table>
           
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



