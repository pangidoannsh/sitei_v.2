@extends('mbkm.main')

@php
    use Carbon\Carbon;

@endphp

@section('title')
    SITEI MBKM | Data Mata Kuliah
@endsection

@section('sub-title')
    Ubah Mata Kuliah
@endsection

@section('content')
    <a href="{{ route('matkul') }}" class="badge bg-success p-2 mb-3 "> Kembali </a>
    <form action="{{ route('matkul.update', $model->id) }}" method="POST">
        @method('put')
        @csrf
        <div class="d-flex flex-column gap-3 mt-4">
            <div class="field">
                <label class="form-label" for="kode_mk">Kode Mata Kuliah<span class="text-danger">*</span></label>
                <input id="kode_mk" name="kode_mk" class="form-control " value="{{ old('kode_mk') ?? $model->kode_mk }}"
                    required>
            </div>
            <div class="field">
                <label class="form-label" for="mk">Nama Mata Kuliah<span class="text-danger">*</span></label>
                <input id="mk" name="mk" class="form-control " value="{{ old('mk') ?? $model->mk }}" required>
            </div>
            <div class="field">
                <label class="form-label" for="sks">Jumlah SKS<span class="text-danger">*</span></label>
                <input id="sks" type="number" name="sks" class="form-control "
                    value="{{ old('sks') ?? $model->sks }}" required>
            </div>
            <div class="field">
                <label for="jenis">Jenis Mata Kuliah</label>
                <select class="form-select" name="jenis" id="jenis">
                    <option value="W" {{ $model->jenis === 'W' ? 'selected' : '' }}>Wajib</option>
                    <option value="P" {{ $model->jenis === 'P' ? 'selected' : '' }}>Peminatan</option>
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
