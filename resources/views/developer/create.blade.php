@extends('layouts.main')

@section('title')
    SITEI | Tambah Developer
@endsection

@section('sub-title')
    Tambah Developer
@endsection

@section('content')
    <div class="container">
        <a href="/developer" class="btn btn-success py-1 px-2 mb-4 "><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
    </div>

    <form action="{{ url('/developer/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label pb-0">Nama<span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    required autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label pb-0">NIM<span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                                    value="{{ old('nim') }}" required>
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label pb-0">Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label pb-0">Peran<span class="text-danger">*</span></label>
                        <input type="text" name="peran" class="form-control @error('peran') is-invalid @enderror"
                            value="{{ old('peran') }}" required>
                        @error('peran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label pb-0">Link Linkedin</label>
                        <input type="text" name="linkedin" class="form-control">
                    </div>


                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label pb-0">Nama Aplikasi<span class="text-danger">*</span></label>
                        <input type="text" name="nama_aplikasi"
                            class="form-control @error('nama_aplikasi') is-invalid @enderror"
                            value="{{ old('nama_aplikasi') }}" required>
                        @error('nama_aplikasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label pb-0">Deskripsi Peran<span class="text-danger">*</span></label>
                        <input type="text" name="deskripsi_peran"
                            class="form-control @error('deskripsi_peran') is-invalid @enderror"
                            value="{{ old('deskripsi_peran') }}" required>
                        @error('deskripsi_peran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label pb-0">Foto<span class="text-danger">*</span><small
                                class="text-secondary">( Format .png .jpg .jpeg | Maks. 200 KB ) </small> </label>
                        <input name="foto" class="form-control @error('foto') is-invalid @enderror"
                            value="{{ old('foto') }}" type="file" id="formFile" required>

                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label pb-0">Link Github</label>
                        <input type="text" name="github" class="form-control">
                    </div>

                </div>

            </div>
            <button type="submit" class="btn btn-success  mt-4 float-end">Simpan</button>
        </div>
    </form>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
    </section>
@endsection
