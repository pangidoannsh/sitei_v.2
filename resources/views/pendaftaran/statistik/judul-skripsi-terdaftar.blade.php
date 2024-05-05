@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Statistik Riwayat Skripsi
@endsection

@section('sub-title')
    Riwayat Skripsi
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
            <li><a href="/statistik/bimbingan-kp" class="px-1">Bimbingan KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-skripsi" class="px-1">Bimbingan Skripsi</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/riwayat-kp" class="px-1">Riwayat KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/judul-skripsi-terdaftar" class="breadcrumb-item active fw-bold text-success px-1">Riwayat Skripsi</a></li>

        </ol>

        <div class="container-fluid">

        @php
            // Tetapkan semua Prodi yang diinginkan
            $all_prodi = ['Teknik Elektro D3', 'Teknik Elektro S1', 'Teknik Informatika S1']; // Ganti dengan daftar Prodi yang sesuai dengan aplikasi Anda

            // Inisialisasi array untuk daftar Prodi
            $prodi_list = [];

            // Ambil data Prodi dari pendaftaran Skripsi dan tambahkan ke dalam array
            foreach ($pendaftaran_skripsis as $judul_skripsi_terdaftar) {
                $prodi_list[] = $judul_skripsi_terdaftar->prodi->nama_prodi;
            }

            // Hilangkan duplikasi data Prodi
            $prodi_list = array_unique($prodi_list);

            // Gabungkan semua Prodi yang ada dengan semua Prodi yang diinginkan
            $prodi_list = array_merge($all_prodi, $prodi_list);

            // Hilangkan duplikasi lagi (jika diperlukan)
            $prodi_list = array_unique($prodi_list);

            // Urutkan data Prodi
            sort($prodi_list);
        @endphp
        
        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuJudulSkripsiTerdaftar">Tampilkan</label>
                    <select id="lengthMenuJudulSkripsiTerdaftar" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="prodiFilterJudulSkripsiTerdaftar">Prodi</label>
                    <select id="prodiFilterJudulSkripsiTerdaftar" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($prodi_list as $prodi)
                            <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterJudulSkripsiTerdaftar">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterJudulSkripsiTerdaftar" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileJudulSkripsiTerdaftar">Tampilkan</label>
                <select id="lengthMenuMobileJudulSkripsiTerdaftar" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="prodiFilterMobileJudulSkripsiTerdaftar">Prodi</label>
                <select id="prodiFilterMobileJudulSkripsiTerdaftar" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($prodi_list as $prodi)
                        <option value="{{ $prodi }}" class="text-capitalize">{{ $prodi }}</option>
                    @endforeach
                </select>                    
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileJudulSkripsiTerdaftar">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileJudulSkripsiTerdaftar" placeholder="">
            </div>
        </div>
        
        <table class="table table-responsive-lg rounded table-bordered table-striped" width="100%" id="datatablesjudulskripsiterdaftar">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Program Studi</th>
                        <th class="text-center" scope="col">Judul</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pendaftaran_skripsis as $judul_skripsi_terdaftar)
                        <div></div>
                        <tr>
                            <td class="text-center">{{ $judul_skripsi_terdaftar->mahasiswa->nim }}</td>
                            <td class="text-left">{{ $judul_skripsi_terdaftar->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $judul_skripsi_terdaftar->prodi->nama_prodi }}</td>
                            <td class="text-left">{{ $judul_skripsi_terdaftar->judul_skripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
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