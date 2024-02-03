@extends('layouts.main')

@section('title')
    Tambah Konsentrasi | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Konsentrasi
@endsection

@section('content')
<div class="container">
        <a href="/konsentrasi" class="btn btn-success py-1 px-2 mb-3 "><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
    </div>
    <div class="col-lg-6">
        <form action="{{ url('/konsentrasi/create') }}" method="POST">
            @csrf

            <div class="mb-3 field">
                <label class="form-label">Konsentrasi</label>
                <input type="text" name="nama_konsentrasi"
                    class="form-control @error('nama_konsentrasi') is-invalid @enderror"
                    value="{{ old('nama_konsentrasi') }}">
                @error('nama_konsentrasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn submitkonsentrasi btn-success mb-5">Tambah</button>

        </form>
    </div>

@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <span
                    class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="https://fahrilhadi.com"> Fahril Hadi</a> <span class="text-success fw-bold"> & </span>
                <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                    class="text-success fw-bold">)</span>
            </p>
        </div>
    </section>
@endsection
