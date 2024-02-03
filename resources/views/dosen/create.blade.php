@extends('layouts.main')

@section('title')
    Tambah Dosen | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Dosen
@endsection

@section('content')
    <div class="container">
        <a href="/dosen" class="btn btn-success py-1 px-2 mb-3 "><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
    </div>

    <form action="{{ url('/dosen/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 field">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                            value="{{ old('nip') }}">
                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Alias</label>
                        <input type="text" name="nama_singkat"
                            class="form-control @error('nama_singkat') is-invalid @enderror"
                            value="{{ old('nama_singkat') }}">
                        @error('nama_singkat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md">
                    <div class="mb-3 field">
                        <label for="prodi_id" class="form-label">Program Studi</label>
                        <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                            <option value="">-Belum Dipilih-</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ old('prodi_id') == $prodi->id ? 'selected' : null }}>{{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label for="role_id" class="form-label">Status</label>
                        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                            <option value="">-Belum Dipilih-</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : null }}>
                                    {{ $role->role_akses }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right mt-4">Tambah</button>
                </div>
            </div>
        </div>
    </form>
<br>
<br>
<br>
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

@push('scripts')
    <script>
        function previewImgdosen() {

            const imagedosen = document.querySelector('#imgdosen');
            const imgPreviewdsn = document.querySelector('.img-preview-dsn');

            imgPreviewdsn.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imagedosen.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreviewdsn.src = oFREvent.target.result;
            }

        }
    </script>
@endpush()
