@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Jadwal Seminar
@endsection

@section('sub-title')
    Jadwal Seminar
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <!-- <a href="/usulankp/index" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali <a> -->

    <!-- <ol class="breadcrumb col-lg-12">
        <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/jadwal">Jadwal</a></li>
        <li class="breadcrumb-item"><a href="/seminar">Riwayat</a></li>
    </ol> -->

    <div class="container card p-4">
        
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

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuJadwalSeminarUntukMahasiswa">Tampilkan</label>
                    <select id="lengthMenuJadwalSeminarUntukMahasiswa" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="seminarFilterJadwalSeminarUntukMahasiswa">Seminar</label>
                    <select id="seminarFilterJadwalSeminarUntukMahasiswa" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($jenis_seminar as $jenis)
                            <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                        @endforeach
                    </select>                   
                </div>
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterJadwalSeminarUntukMahasiswa">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterJadwalSeminarUntukMahasiswa" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileJadwalSeminarUntukMahasiswa">Tampilkan</label>
                <select id="lengthMenuMobileJadwalSeminarUntukMahasiswa" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="seminarFilterMobileJadwalSeminarUntukMahasiswa">Seminar</label>
                <select id="seminarFilterMobileJadwalSeminarUntukMahasiswa" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($jenis_seminar as $jenis)
                        <option value="{{ $jenis }}" class="text-capitalize">{{ $jenis }}</option>
                    @endforeach
                </select>                    
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileJadwalSeminarUntukMahasiswa">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileJadwalSeminarUntukMahasiswa" placeholder="">
            </div>
        </div>
        
        <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatablesjadwalseminaruntukmhs">
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
                </tr>
            </thead>
            <tbody>

                @foreach ($penjadwalan_kps as $kp)
                @if($kp->tanggal != null)
                    <tr>
                        <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                        <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $kp->mahasiswa->nama }}</td>
                        <td class="bg-primary text-center">{{ $kp->jenis_seminar }}</td>
                        <td class="text-center">{{ $kp->prodi->nama_prodi }}</td>
                        <td class="text-center">{{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td class="text-center">{{ $kp->waktu }}</td>
                        <td class="text-center">{{ $kp->lokasi }}</td>
                        <td class="text-center">{{ $kp->pembimbing->nama_singkat }}</td>
                        <td class="text-center">{{ $kp->penguji->nama_singkat }}</td>
                    </tr>
                    @endif
                @endforeach

                @foreach ($penjadwalan_sempros as $sempro)
                @if($sempro->tanggal != null)
                    <tr>
                        <td class="text-center">{{ $sempro->mahasiswa->nim }}</td>
                        <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $sempro->mahasiswa->nama }}</td>
                        <td class="bg-success text-center">{{ $sempro->jenis_seminar }}</td>
                        <td class="text-center">{{ $sempro->prodi->nama_prodi }}</td>
                        <td class="text-center">{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td class="text-center">{{ $sempro->waktu }}</td>
                        <td class="text-center">{{ $sempro->lokasi }}</td>
                        <td class="text-center">
                            <p>1. {{ $sempro->pembimbingsatu->nama_singkat }}</p>
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
                    </tr>
                    @endif
                @endforeach

                @foreach ($penjadwalan_skripsis as $skripsi)
                @if($skripsi->tanggal != null)
                    <tr>
                        <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                        <td class="text-left pl-3 pr-1 py-2 fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                        <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                        <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>
                        <td class="text-center">{{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td class="text-center">{{ $skripsi->waktu }}</td>
                        <td class="text-center">{{ $skripsi->lokasi }}</td>
                        <td class="text-center">
                            <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>
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
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                        href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                        class="text-success fw-bold">&</span>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M.
                        Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endpush()
