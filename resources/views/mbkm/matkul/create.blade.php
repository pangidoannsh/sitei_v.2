@extends('mbkm.main')

@php
    use Carbon\Carbon;

@endphp

@section('title')
    SITEI MBKM | Data Mata Kuliah
@endsection

@section('sub-title')
    Tambah MAta Kuliah
@endsection

@section('content')
    <a href="{{ route('matkul') }}" class="badge bg-success p-2 mb-3 "> Kembali </a>
    <form action="{{ route('matkul.store') }}" method="POST">
        @csrf
        <div class="d-flex flex-column gap-3 mt-4">
            <div class="field">
                <label class="form-label" for="kode_mk">Kode Mata Kuliah<span class="text-danger">*</span></label>
                <input id="kode_mk" name="kode_mk" class="form-control " value="{{ old('kode_mk') }}" required>
            </div>
            <div class="field">
                <label class="form-label" for="mk">Nama Mata Kuliah<span class="text-danger">*</span></label>
                <input id="mk" name="mk" class="form-control " value="{{ old('mk') }}" required>
            </div>
            <div class="field">
                <label class="form-label" for="sks">Jumlah SKS<span class="text-danger">*</span></label>
                <input id="sks" type="number" name="sks" class="form-control " value="{{ old('sks') }}"
                    required>
            </div>
            <div class="field">
                <label for="jenis">Jenis Mata Kuliah</label>
                <select class="form-select" name="jenis" id="jenis">
                    <option value="W">Wajib</option>
                    <option value="P">Peminatan</option>
                </select>
            </div>
            <button type="submit" class="rounded-3 btn mt-3 btn-success py-3">
                Simpan
            </button>
        </div>
    </form>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
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

@push('scripts')
@endpush
