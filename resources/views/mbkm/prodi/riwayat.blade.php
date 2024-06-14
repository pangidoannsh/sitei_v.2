@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI MBKM | MBKM Prodi
@endsection

@section('sub-title')
    MBKM Mahasiswa Prodi
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container card p-4">

        <ul class="breadcrumb col-lg-12">
            <li>
                <a href="{{ route('mbkm.prodi') }}" class="breadcrumb-item">
                    Persetujuan ({{ $countUsulan }})
                </a>
            </li>
            <span class="px-2">|</span>
            <li>
                <a href="{{ route('mbkm.prodi.berjalan') }}" class="px-1">
                    Bimbingan ({{ $countBerjalan }})
                </a>
            </li>
            <span class="px-2">|</span>
            <li>
                <a href="#" class="px-1 active fw-bold text-success px-1">
                    Riwayat ({{ $mbkm->count() }})
                </a>
            </li>
        </ul>

        <div class="container-fluid">
            <h5>Riwayat Selesai</h5>
            <hr>
            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NO</th>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Periode Semester</th>
                        <th class="text-center" scope="col">Jenis MBKM</th>
                        <th class="text-center" scope="col">Lokasi MBKM</th>
                        <th class="text-center" scope="col">Judul MBKM</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Periode Kegiatan</th>
                        <th class="text-center px-5" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mbkm as $km)
                        @if (in_array($km->status, ['Konversi diterima', 'Nilai sudah keluar']))
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $km->mahasiswa->nim }}</td>
                                <td class="text-center">{{ $km->mahasiswa->nama }}</td>
                                <td class="text-center">{{ $km->mahasiswa->angkatan }}</td>
                                <td class="text-center">{{ $km->program->name }}</td>
                                <td class="text-center">{{ $km->perusahaan }}</td>
                                <td class="text-center ">{{ $km->judul }}</td>
                                <td class="text-center bg-success">Telah Terkonversi</td>
                                <td class="text-center" style="overflow: hidden">
                                    <div class="ellipsis-2">
                                        {{ Carbon::parse($km->mulai_kegiatan)->translatedFormat('d F Y') }} -
                                        {{ Carbon::parse($km->selesai_kegiatan)->translatedFormat('d F Y') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1 mb-1"
                                        data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container card p-4">
        <div class="container-fluid">
            <h5>Riwayat Ditolak</h5>
            <hr>

            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables2">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NO</th>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Periode Semester</th>
                        <th class="text-center" scope="col">Jenis MBKM</th>
                        <th class="text-center" scope="col">Lokasi MBKM</th>
                        <th class="text-center" scope="col">Judul MBKM</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Alasan</th>
                        <th class="text-center" scope="col">Periode Kegiatan</th>
                        <th class="text-center px-5" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mbkm as $km)
                        @if (in_array($km->status, ['Ditolak', 'Mengundurkan diri']))
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $km->mahasiswa->nim }}</td>
                                <td class="text-center">{{ $km->mahasiswa->nama }}</td>
                                <td class="text-center">{{ $km->mahasiswa->angkatan }}</td>
                                <td class="text-center">{{ $km->program->name }}</td>
                                <td class="text-center">{{ $km->perusahaan }}</td>
                                <td class="text-center ">{{ $km->judul }}</td>
                                @if ($km->status == 'Konversi diterima')
                                    <td class="text-center bg-success">Telah Terkonversi</td>
                                @elseif($km->status == 'Ditolak' || $km->status == 'Mengundurkan diri')
                                    <td class="text-center bg-danger">{{ $km->status }}</td>
                                @else
                                    <td class="text-center bg-warning">{{ $km->status }}</td>
                                @endif
                                <td class="text-center">
                                    {{ in_array($km->status, ['Konversi ditolak', 'Ditolak']) ? $km->catatan : $km->alasan_undur_diri }}
                                </td>

                                <td class="text-center" style="overflow: hidden">
                                    <div class="ellipsis-2">
                                        {{ Carbon::parse($km->mulai_kegiatan)->translatedFormat('d F Y') }} -
                                        {{ Carbon::parse($km->selesai_kegiatan)->translatedFormat('d F Y') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1 mb-1"
                                        data-bs-toggle="tooltip" title="Lihat Detail"><i
                                            class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
