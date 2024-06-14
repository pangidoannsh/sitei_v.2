@extends('layouts.main')

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now();
    $currentMbkm = $mbkm->where('status', '!=', 'Usulan')->first();
@endphp

@section('title')
    SITEI MBKM | Usulan MBKM
@endsection

@section('sub-title')
    Usulan MBKM
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif


    <div class="container-fluid">
        @if ($mbkm->count() > 0)
            @if ($currentMbkm)
                <div class="card card-timeline px-2 border-none">
                    <h5 class="text-center">
                        <ul class="bs4-order-tracking w-100 my-5">
                            @if ($currentMbkm->status == 'Usulan')
                                <li class="step">
                                    <div>
                                        <i class="fas"></i>
                                    </div>
                                    <p class="mt-3">USULAN MBKM</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step">
                                    <div><i class="fas"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                                {{-- satu terima --}}
                            @elseif ($currentMbkm->status == 'Disetujui')
                                <li class="step active">
                                    <div>
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step">
                                    <div><i class="fas fa-truc"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                            @elseif ($currentMbkm->status == 'Ditolak')
                                <li class="step active">
                                    <div>
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step">
                                    <div><i class="fas fa-truc"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                                {{-- 2 diterima --}}
                            @elseif ($currentMbkm->status == 'Usulan konversi nilai')
                                <li class="step active">
                                    <div>
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas fa-check"></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step">
                                    <div><i class="fas fa-truc"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                            @elseif ($currentMbkm->status == 'Konversi ditolak')
                                <li class="step active">
                                    <div>
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas fa-check"></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step aktip">
                                    <div><i class="fas fa-times"></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step">
                                    <div><i class="fas fa-truc"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                            @elseif ($currentMbkm->status == 'Konversi diterima')
                                <li class="step active">
                                    <div>
                                        <i class="fas"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step ">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                            @elseif ($currentMbkm->status == 'Nilai sudah keluar')
                                <li class="step active">
                                    <div>
                                        <i class="fas"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step active">
                                    <div><i class="fas fa-truc"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                            @else
                                <li class="step">
                                    <div>
                                        <i class="fas"></i>
                                    </div>
                                    <p class="mt-3"> USULAN MBKM</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3">UPLOAD SERTIFIKAT DAN NILAI</p>
                                </li>
                                <li class="step">
                                    <div><i class="fas "></i>
                                    </div>
                                    <p class="mt-3"> KONVERSI NILAI </p>
                                </li>
                                <li class="step">
                                    <div><i class="fas fa-truc"></i>
                                    </div>
                                    <p class="mt-3"> SELESAI PROGRAM </p>
                                </li>
                            @endif
                        </ul>
                        <div class="row row-cols-4 biru mb-4">
                            <div class="col">
                                <span class="mt-3 "> Tanggal Diterima <br></span>
                                <span
                                    class="mt-3  text-warning">{{ Carbon::parse($currentMbkm->tanggal_disetujui)->translatedFormat('l, d F Y') }}</span>
                            </div>
                            <div class="col"><span class="mt-1 text"> Batas Unggah <br></span>
                                <strong
                                    class="mt-3 text-danger">{{ Carbon::parse($currentMbkm->selesai_kegiatan)->translatedFormat('l, d F Y') }}<strong
                                        class="text-bold" id="#"></strong><br></strong>
                            </div>
                            {{-- <div class="col"><span class="mt-1 text">Nilai Terkonversi<br></span>
                                <strong
                                    class="mt-3 text-danger">{{ Carbon::parse($currentMbkm->tanggal_dikonversi)->translatedFormat('l, d F Y') }}<strong
                                        class="text-bold" id="#"></strong><br></strong>
                            </div> --}}
                            <div class="col"></div>
                        </div>
                    </h5>
                </div>
            @endif
        @endif
        @if ($mbkm->pluck('status')->contains('Usulan') || $mbkm->count() == 0)
            {{-- <button type="button"
                class="btn btn-success w-content mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-2"
                data-toggle="modal" data-target="#staticBackdrop">
                <i class="fa-solid fa-plus"></i>
                Usulan
            </button> --}}
            <a href="{{ route('mbkm.create') }}"
                class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5"
                style="width: 120px;">
                <i class="fa-solid fa-plus"></i>
                Usulan
            </a>
        @endif

        <div class="card p-4">
            <ul class="breadcrumb col-lg-12">
                <li>
                    <a href="#" class="breadcrumb-item active fw-bold text-success px-1">
                        Usulan ({{ $mbkm->count() }})
                    </a>
                </li>
                <span class="px-2">|</span>
                <li>
                    <a href="{{ route('mbkm.riwayat') }}" class="px-1">
                        Riwayat ({{ $countRiwayat }})
                    </a>
                </li>
            </ul>
            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Jenis MBKM</th>
                        <th class="text-center">Lokasi MBKM</th>
                        <th class="text-center">Judul MBKM</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Alasan</th>
                        <th class="text-center">Periode Kegiatan</th>
                        <th class="text-center">Batas Waktu</th>
                        <th class="text-center px-5">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mbkm as $km)
                        <tr>
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

                            <td class="text-center">{{ $km->catatan }}</td>
                            <td class="text-center">
                                {{ Carbon::parse($km->mulai_kegiatan)->translatedFormat('d/m/Y') .
                                    ' - ' .
                                    Carbon::parse($km->selesai_kegiatan)->translatedFormat('d/m/Y') }}
                            </td>
                            <td class="text-center text-danger text-bold">
                                @if ($km->status == 'Usulan')
                                    {{ $currentDate->diffInDays($km->batas, false) + 1 }} hari lagi
                                @else
                                    0 hari
                                @endif
                            </td>

                            <td class="text-center"style="width: 56px">
                                <div class="row row-cols-2 justify-content-center">
                                    <div>
                                        <a href="{{ route('mbkm.detail', $km->id) }}" class="badge btn btn-info p-1 mb-1"
                                            data-bs-toggle="tooltip" title="Lihat Detail"><i
                                                class="fas fa-info-circle"></i></a>
                                    </div>
                                    @switch($km->status)
                                        @case('Usulan')
                                            <form action="{{ route('mbkm.destroy', $km->id) }}" method="POST"
                                                style="display: inline;" class="hapus-usulan">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="badge btn btn-danger p-1.5 mb-2">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @break

                                        @case('Disetujui')
                                        @case('Konversi ditolak')
                                            <div>
                                                <a href="{{ route('mbkm.undurdiri', $km->id) }}" class="badge btn-danger"
                                                    data-bs-toggle="tooltip" title="Usulan pengunduran diri">
                                                    <i class="fa-solid fa-file-circle-xmark"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ route('mbkm.sertif.create', $km->id) }}" class="badge  "
                                                    data-bs-toggle="tooltip" title="Unggah Sertifikat"><img height="25"
                                                        width="25" src="/assets/img/add.png" alt="..."
                                                        class="zoom-image"></a>
                                            </div>
                                            <div>
                                                <a href="{{ route('mbkm.logbook', $km->id) }}" class="btn btn-success badge"
                                                    title="Logbook">
                                                    <i class="fa-solid fa-scroll"></i>
                                                </a>
                                            </div>
                                        @break

                                        @default
                                    @endswitch
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Modal Tambah Usulan --}}
    {{-- <div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-large">
            <div class="modal-content p-4 rounded-4 d-flex flex-column gap-4">
                <form action="{{ route('mbkm.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h5 class="modal-title">Tambah Usulan MBKM</h5>
                    <div class="divider-green mt-1"></div>
                    <div class="d-flex flex-column gap-3 mt-4">
                        <div class="field">
                            <div class="field">
                                <label for="semester" class="form-label">Semester
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="semester" id="semester"
                                    class="text-secondary form-select rounded-3 text-capitalize @error('semester') border border-danger @enderror">
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->nama }}" class="text-capitalize"
                                            {{ old('semester') == $semester->nama || $semesters->last()->nama == $semester->nama ? 'selected' : '' }}>
                                            {{ $semester->nama }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="field">
                            <label for="program" class="form-label">Program MBKM<span
                                    class="text-danger">*</span></label>
                            <select id="program_id" name="program_id" class="form-select" required>
                                @foreach ($program as $pro)
                                    <option value="{{ $pro->id }}">{{ $pro->name }}
                                        {{ old('program_id') == $pro->id ? 'selected' : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label class="form-label">Lokasi (Perusahaan/Instansi)<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="perusahaan" name="perusahaan" class="form-control " required
                                value="{{ old('perusahaan') }}">

                        </div>
                        <div class="field">
                            <label class="form-label">Alamat Perusahaan/Instansi<span class="text-danger">*</span></label>
                            <input type="text" id="alamat" name="alamat" class="form-control " required
                                value="{{ old('alamat') }}">

                        </div>
                        <div class="field">
                            <label class="form-label">Bidang Usaha<span class="text-danger">*</span></label>
                            <input type="text" id="bidang_usaha" name="bidang_usaha" class="form-control " required
                                value="{{ old('bidang_usaha') }}">

                        </div>
                        <div class="field">
                            <label class="form-label">Judul Kegiatan<span class="text-danger">*</span></label>
                            <input type="text" id="judul" name="judul" class="form-control" required
                                value="{{ old('judul') }}">
                        </div>
                        <div class="d-flex align-items-end gap-2">
                            <div style="width :100%">
                                <label for="formFile" class="form-label">Rincian Kegiatan (PDF)<span
                                        class="">(max:200KB)</span></label>
                                <input class="form-control @error('rincian') is-invalid @enderror" type="file"
                                    accept=".jpg, .png, .pdf" id="rincian" name="rincian">
                                @error('rincian')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>
                            <span class="text-secondary" style="font-size: 14px">atau</span>
                            <div style="width:100%">
                                <label for="rincian_link" class="form-label">Link Rincian Kegiatan</label>
                                <input placeholder="https://kampusmerdeka..."
                                    class="form-control @error('rincian_link') is-invalid @enderror"id="rincian_link"
                                    name="rincian_link" value="{{ old('rincian_link') }}">
                                @error('rincian_link')
                                    <div class="invalid-feedback">{{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="form-label">Periode Kegiatan<span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center" style="gap: 8px">
                                <input type="date" id="mulai_kegiatan" name="mulai_kegiatan" class="form-control "
                                    required value="{{ old('mulai_kegiatan') }}">
                                <span>-</span>
                                <input type="date" id="selesai_kegiatan" name="selesai_kegiatan"
                                    class="form-control " required value="{{ old('selesai_kegiatan') }}">
                            </div>
                        </div>
                        <div class="field">
                            <label class="form-label">Batas Waktu Penawaran<span class="text-danger">*</span></label>
                            <input type="date" id="batas" name="batas" class="form-control "
                                value="{{ old('batas') }}" required>
                        </div>
                        <div class="flex flex-column">
                            <button type="submit" class="rounded-3 btn mt-3 btn-success py-3 w-100">
                                Usulkan
                            </button>
                            <button type="button" class="rounded-3 btn mt-3 btn-outline-success py-3 w-100"
                                data-dismiss="modal">
                                Batalkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('footer')
    <section class="bg-dark p-1">
        <div class="container d-flex justify-content-center">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI
                (
                <a class="text-success fw-bold" href="#" target="_blank">
                    Muhammad Abdullah Qosim
                </a>,
                <a class="text-success fw-bold" href="#" target="_blank">
                    Fitra Ramadhan
                </a>,dan
                <a class="text-success fw-bold" href="#" target="_blank">
                    Ilmi Fajar Ramadhan
                </a>
                )
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(".hapus-usulan").submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Usulan MBKM',
                text: 'Lanjutkan penghapusan?',
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
    </script>
@endpush
