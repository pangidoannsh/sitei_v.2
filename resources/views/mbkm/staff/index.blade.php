@extends('layouts.main')

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
                <a href="#" class="breadcrumb-item active fw-bold text-success px-1">
                    Usulan ({{ $mbkm->count() }})
                </a>
            </li>
            <span class="px-2">|</span>
            <li>
                <a href="{{ route('mbkm.staff.riwayat') }}" class="px-1">
                    Riwayat ({{ $countRiwayat }})
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
                        <th class="text-center" scope="col">Batas Waktu</th>
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
                            <td class="text-center text-danger text-bold">{{ $km->batas }}</td>
                            <td class="text-center" style="width: 56px">
                                <div class="d-flex gap-2 flex-wrap">
                                    <div>
                                        <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1"
                                            data-bs-toggle="tooltip" title="Lihat Detail"><i
                                                class="fas fa-info-circle"></i></a>
                                    </div>
                                    @if ($km->status == 'Konversi diterima')
                                        <div>
                                            <a href="{{ route('mbkm.pdf', $km->id) }}" target="_blank"
                                                class="badge btn btn-success p-1" data-bs-toggle="tooltip"
                                                title="Print Surat Konversi"><i class="fas fa-print"></i></a>
                                        </div>
                                    @endif
                                    <form action="{{ route('mbkm.staff.approve', $km->id) }}" method="POST"
                                        class="selesaikan-mbkm">
                                        @csrf
                                        <button type="submit" class="badge btn btn-success p-1" title="Selesaikan MBKM">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".selesaikan-mbkm").click(e => {
            const form = $(this).closest("form");

            e.preventDefault()
            Swal.fire({
                title: 'Selesaikan MBKM',
                text: 'Lanjutkan penyelesaian MBKM?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })
    </script>
@endpush
