@extends('mbkm.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI MBKM | Usulan MBKM
@endsection

@section('sub-title')
    Riwayat MBKM
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif


    <div class="container-fluid">
        <div class="container card p-4">
            <ul class="breadcrumb col-lg-12">
                <li>
                    <a href="{{ route('mbkm') }}" class="px-1">
                        Usulan ({{ $countUsulan }})
                    </a>
                </li>
                <span class="px-2">|</span>
                <li>
                    <a href="#" class="breadcrumb-item active fw-bold text-success px-1">
                        Riwayat ({{ $mbkm->count() }})
                    </a>
                </li>
            </ul>
            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">NIM</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Periode Semester</th>
                        <th class="text-center" scope="col">Jenis MBKM</th>
                        <th class="text-center" scope="col">Lokasi MBKM</th>
                        <th class="text-center" scope="col">Judul MBKM</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Alasan</th>
                        <th class="text-center" scope="col">Periode Kegiatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mbkm as $km)
                        <tr>
                            <td class="text-center">{{ $km->mahasiswa->nim }}</td>
                            <td class="text-center" style="overflow: hidden">
                                <div class="ellipsis-2">{{ $km->mahasiswa->nama }}</div>
                            </td>
                            <td class="text-center">{{ $km->semester }}</td>
                            <td class="text-center">{{ $km->program->name }}</td>
                            <td class="text-center">{{ $km->perusahaan }}</td>
                            <td class="text-center " style="overflow: hidden">
                                <div class="ellipsis-2">{{ $km->judul }}</div>
                            </td>

                            @if (in_array($km->status, ['Nilai sudah keluar', 'Konversi diterima']))
                                <td class="text-center bg-success">{{ $km->status }}</td>
                            @elseif($km->status == 'Ditolak')
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @elseif($km->status == 'Konversi ditolak')
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @elseif($km->status == 'Mengundurkan diri')
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @else
                                <td class="text-center bg-warning">{{ $km->status }}</td>
                            @endif

                            <td class="text-center" style="overflow: hidden">
                                <div class="ellipsis-2">
                                    {{ in_array($km->status, ['Konversi ditolak', 'Ditolak']) ? $km->catatan : $km->alasan_undur_diri }}
                                </div>
                            </td>
                            <td class="text-center" style="overflow: hidden">
                                <div class="ellipsis-2">
                                    {{ Carbon::parse($km->mulai_kegiatan)->translatedFormat('d/m/Y') .
                                        ' - ' .
                                        Carbon::parse($km->selesai_kegiatan)->translatedFormat('d/m/Y') }}
                                </div>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1"
                                    data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    <section class="bg-dark p-1">
        <div class="container d-flex justify-content-center">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI
                (
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Muhammad Abdullah Qosim
                </a>,
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Ilmi Fajar Ramadhan
                </a>,dan
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Fitra Ramadhan
                </a>
                )
            </p>
        </div>
    </section>
@endsection
