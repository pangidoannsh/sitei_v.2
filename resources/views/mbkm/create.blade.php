@extends('layouts.main')

@php
    use Carbon\Carbon;

@endphp

@section('title')
    SITEI MBKM | Detail Mahasiswa
@endsection

@section('sub-title')
    Tambah Usulan MBKM
@endsection

@section('content')
    <a href="@if (Auth::guard('dosen')->check()) {{ route('mbkm.prodi') }}
    @elseif(Auth::guard('web')->check())
    {{ route('mbkm.staff') }}
    @else
        {{ route('mbkm') }} @endif"
        class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5" style="width: 120px;"> Kembali </a>
    <form action="{{ route('mbkm.store') }}" method="POST" enctype="multipart/form-data" class="pb-5">
        @csrf
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
                <label for="program" class="form-label">Program MBKM<span class="text-danger">*</span></label>
                <select id="program_id" name="program_id" class="form-select" required>
                    @foreach ($program as $pro)
                        <option value="{{ $pro->id }}">{{ $pro->name }}
                            {{ old('program_id') == $pro->id ? 'selected' : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label class="form-label">Lokasi (Perusahaan/Instansi)<span class="text-danger">*</span></label>
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
                    <input type="date" id="mulai_kegiatan" name="mulai_kegiatan" class="form-control " required
                        value="{{ old('mulai_kegiatan') }}">
                    <span>-</span>
                    <input type="date" id="selesai_kegiatan" name="selesai_kegiatan" class="form-control " required
                        value="{{ old('selesai_kegiatan') }}">
                </div>
            </div>
            <div class="field">
                <label class="form-label">Batas Waktu Penawaran<span class="text-danger">*</span></label>
                <input type="date" id="batas" name="batas" class="form-control " value="{{ old('batas') }}"
                    required>
            </div>
            <div class="field">
                <label class="form-label" for="surat_rekomendasi">Surat Rekomendasi
                    <span class="text-secondary" style="font-size: 12px">(max:200KB)</span><span
                        class="text-danger">*</span></label>
                <input type="file" id="surat_rekomendasi" name="surat_rekomendasi"
                    class="form-control @error('surat_rekomendasi') is-invalid @enderror"
                    value="{{ old('surat_rekomendasi') }}" required>
                @error('surat_rekomendasi')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
            <div class="field">
                <label class="form-label" for="krs_berjalan">KRS Berjalan<span class="text-secondary"
                        style="font-size: 12px">(max:200KB)</span>
                    <span class="text-danger">*</span></label>
                <input type="file" id="krs_berjalan" name="krs_berjalan"
                    class="form-control @error('krs_berjalan') is-invalid @enderror" value="{{ old('krs_berjalan') }}"
                    required>
                @error('krs_berjalan')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
            <div class="field">
                <label class="form-label" for="persetujuan_pa">Surat Persetujuan Dosen PA
                    <span class="text-secondary" style="font-size: 12px">(max:200KB)</span>
                    <span class="text-danger">*</span></label>
                <input type="file" id="persetujuan_pa" name="persetujuan_pa"
                    class="form-control @error('persetujuan_pa') is-invalid @enderror"
                    value="{{ old('persetujuan_pa') }}" required>
                @error('persetujuan_pa')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
            <div class="field">
                <label for="dosen_pa" class="form-label">Dosen PA Mahasiswa<span class="text-danger">*</span></label>
                <select id="dosen_pa" name="dosen_pa" class="form-select" required>
                    <option value="">--pilih dosen PA--</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->nip }}">{{ $dosen->nama }}
                            {{ old('dosen_pa') == $dosen->id ? 'selected' : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-column">
                <button type="submit" class="rounded-3 btn mt-3 btn-success py-3 w-100">
                    Usulkan
                </button>
                <a href="{{ route('mbkm') }}" class="rounded-3 btn mt-3 btn-outline-success py-3 w-100">
                    Batalkan
                </a>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
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
@endpush
