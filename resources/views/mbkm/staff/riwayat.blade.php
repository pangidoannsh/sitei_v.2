@extends('mbkm.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI MBKM | MBKM Staff
@endsection

@section('sub-title')
    MBKM Mahasiswa Staff
@endsection

@section('content')
    <div class="container card p-4">
        <ul class="breadcrumb col-lg-12">
            <li>
                <a href="{{ route('mbkm.staff') }}" class="breadcrumb-item">
                    Usulan ({{ $countUsulan }})
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
            <table class="table table-responsive-lg table-bordered " id="datatables">
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
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $km->mahasiswa->nim }}</td>
                            <td class="text-center" style="overflow: hidden">
                                <div class="ellipsis-2">
                                    {{ $km->mahasiswa->nama }}
                                </div>
                            </td>
                            <td class="text-center">{{ $km->semester }}</td>
                            <td class="text-center">{{ $km->program->name }}</td>
                            <td class="text-center">{{ $km->perusahaan }}</td>
                            <td class="text-center" style="overflow: hidden">
                                <div class="ellipsis-2">
                                    {{ $km->judul }}
                                </div>
                            </td>
                            @if (in_array($km->status, ['Nilai sudah keluar', 'Konversi diterima']))
                                <td class="text-center bg-success">{{ $km->status }}</td>
                            @elseif($km->status == 'Ditolak')
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @elseif(in_array($km->status, ['Konversi Ditolak', 'Mengundurkan diri']))
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @else
                                <td class="text-center bg-warning">{{ $km->status }}</td>
                            @endif
                            <td class="text-center" style="overflow: hidden;">
                                <div class="ellipsis-2">
                                    {{ Carbon::parse($km->mulai_kegiatan)->translatedFormat('d F Y') }} -
                                    {{ Carbon::parse($km->selesai_kegiatan)->translatedFormat('d F Y') }}
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1 mb-1"
                                    data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                                @if ($km->status == 'Konversi diterima')
                                    <a href="{{ route('mbkm.pdf', $km->id) }}" target="_blank"
                                        class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip"
                                        title="Print Surat Konversi"><i class="fas fa-print"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
