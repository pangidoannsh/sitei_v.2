@extends('mbkm.main')

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now();
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
                <a href="#" class="breadcrumb-item active fw-bold text-success px-1">
                    Persetujuan ({{ $mbkm->count() }})
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
                <a href="{{ route('mbkm.prodi.riwayat') }}" class="px-1">
                    Riwayat ({{ $riwayatMbkm->count() }})
                </a>
            </li>
        </ul>
        <div class="container-fluid">

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
                        <th class="text-center" scope="col">Batas Waktu</th>
                        <th class="text-center px-5" style="width: 56px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mbkm as $km)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $km->mahasiswa->nim }}</td>
                            <td class="text-center">{{ $km->mahasiswa->nama }}</td>
                            <td class="text-center">{{ $km->semester }}</td>
                            <td class="text-center">{{ $km->program->name }}</td>
                            <td class="text-center">{{ $km->perusahaan }}</td>
                            <td class="text-center ">{{ $km->judul }}</td>
                            @if ($km->status == 'Nilai sudah keluar')
                                <td class="text-center bg-success">{{ $km->status }}</td>
                            @elseif($km->status == 'Ditolak')
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @elseif($km->status == 'Konversi Ditolak')
                                <td class="text-center bg-danger">{{ $km->status }}</td>
                            @else
                                <td class="text-center bg-warning">{{ $km->status }}</td>
                            @endif
                            <td class="text-center">
                                {{ Carbon::parse($km->mulai_kegiatan)->translatedFormat('d/m/Y') .
                                    ' - ' .
                                    Carbon::parse($km->selesai_kegiatan)->translatedFormat('d/m/Y') }}
                            </td>
                            <td class="text-center text-danger text-bold">
                                @if ($km->status === 'Usulan')
                                    @if ($currentDate <= $km->batas)
                                        {{ $currentDate->diffInDays($km->batas, false) + 1 }} hari lagi
                                    @else
                                        Melewati Batas Waktu
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="row row-cols-3" style="width: 120px;margin: 0 auto">
                                    <div>
                                        <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1"
                                            data-bs-toggle="tooltip" title="Lihat Detail"><i
                                                class="fas fa-info-circle"></i></a>
                                    </div>
                                    @if ($km->status == 'Usulan')
                                        <form action="{{ route('mbkm.prodi.approveusulan', $km->id) }}" method="POST"
                                            style="display: inline;" class="setujui-usulan"
                                            data-nim="{{ $km->mahasiswa_nim }}">
                                            @csrf
                                            <button type="submit" class="badge btn btn-success p-1"><i class="fas fa-check"
                                                    title="Setujui Usulan"></i></button>
                                        </form>
                                        <div>
                                            <button title="Tolak Usulan" data-id="{{ $km->id }}"
                                                class="badge btn btn-danger p-1.5 mb-2 show-tolak-usulan"><i
                                                    class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @elseif($km->status == 'Usulan konversi nilai')
                                        <div>
                                            <a href="{{ route('mbkm.prodi.approvekonversi', $km->id) }}" type="submit"
                                                class="badge btn btn-success p-1"><i class="fas fa-check"
                                                    title="Setujui usulan konversi nilai"></i>
                                            </a>
                                        </div>
                                        {{-- Button Tolak Konversi --}}
                                        <div>
                                            <button title="Tolak Konversi" data-id="{{ $km->id }}"
                                                class="badge btn btn-danger p-1.5 mb-2 show-tolak-konversi">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @elseif($km->status == 'Usulan pengunduran diri')
                                        <form action="{{ route('mbkm.prodi.approvepengunduran', $km->id) }}" method="POST"
                                            style="display: inline;" class="setujui-pengunduran-diri">
                                            @csrf
                                            <button type="submit" class="badge btn btn-success p-1"
                                                title="Setujui Usulan Pengunduran Diri"><i
                                                    class="fas fa-check"></i></button>
                                        </form>
                                    @endif
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
        const riwayats = @json($riwayatMbkm).map(data => data)
        $('.show-tolak-usulan').click((e) => {
            const id = $(e.currentTarget).data("id");
            e.preventDefault();
            Swal.fire({
                title: 'Tolak Usulan MBKM',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tolak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tolak Usulan MBKM',
                        html: `
                        <form id="reasonForm" action="/mbkm/prodi/tolakusulan/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="catatan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        })
        $('.show-tolak-konversi').click((e) => {
            const id = $(e.currentTarget).data("id");
            e.preventDefault();
            Swal.fire({
                title: 'Tolak Konversi MBKM',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tolak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tolak Usulan MBKM',
                        html: `
                        <form id="reasonForm" action="/mbkm/prodi/tolakkonversi/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="catatan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        })

        $(".setujui-pengunduran-diri").submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Usulan Pengunduran Diri',
                text: 'Setujui Usulan Pengunduran Diri?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setujui',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })
        $(".setujui-usulan").submit(function(e) {
            e.preventDefault();
            const form = $(this).closest("form");
            const nim = $(this).data("nim")
            const prevMbkm = riwayats.filter(riwayat => riwayat.mahasiswa_nim == nim);
            let tbodyContent = "";
            prevMbkm.forEach((riwayat, index) => {
                tbodyContent += `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td class="text-center fw-bold">${riwayat.program.name}</td>
                    <td class="text-center">${riwayat.perusahaan}</td>
                    <td class="text-center">${riwayat.semester}</td>
                </tr>
            `;
            });
            const htmlContent = `<table class="table table-responsive-lg table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center" scope="col">NO</th>
                                            <th class="text-center" scope="col">Jenis MBKM</th>
                                            <th class="text-center" scope="col">Lokasi MBKM</th>
                                            <th class="text-center" scope="col">Periode Semester</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${tbodyContent}
                                    </tbody>
                                </table>`
            Swal.fire({
                title: 'Usulan MBKM',
                html: `<p>Setujui Usulan Mengikuti MBKM?</p><h5 class="text-start fw-bold">Mbkm Sebelumnya</h5>${htmlContent}`,
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setujui',
                confirmButtonColor: '#28a745',
                width: '50vw'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })
    </script>
@endpush
