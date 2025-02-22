@extends('layouts.main')

@section('title')
    Edit Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Mahasiswa
@endsection

@section('content')
    <div class="container">
        <a href="/mahasiswa" class="btn btn-success py-1 px-2 mb-3 "><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
    </div>

    <form action="/mahasiswa/edit/{{ $mahasiswa->id }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 field">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                            value="{{ old('nim', $mahasiswa->nim) }}"@if ($mahasiswa->id) readonly @endif>
                        @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $mahasiswa->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $mahasiswa->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md">
                    <div class="mb-3 field">
                        <label class="form-label">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                            value="{{ old('angkatan', $mahasiswa->angkatan) }}">
                        @error('angkatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label for="prodi_id" class="form-label">Program Studi</label>
                        <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                            <option value="">-Belum Dipilih-</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'selected' : null }}>
                                    {{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label for="konsentrasi_id" class="form-label">Konsentrasi</label>
                        <select name="konsentrasi_id" class="form-select @error('konsentrasi_id') is-invalid @enderror">
                            <option value="">-Belum Dipilih-</option>
                            @foreach ($konsentrasis as $konsentrasi)
                                <option value="{{ $konsentrasi->id }}"
                                    {{ old('konsentrasi_id', $mahasiswa->konsentrasi_id) == $konsentrasi->id ? 'selected' : null }}>
                                    {{ $konsentrasi->nama_konsentrasi }}</option>
                            @endforeach
                        </select>
                        @error('konsentrasi_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right mt-4">Ubah</button>
    </form>

    <form method="POST" action="/reset-password/mahasiswa/{{ $mahasiswa->id }}" class="reset-password">
        @csrf
        @method('PUT')
        <button class="btn btn-secondary mx-4 float-end mt-4" type="submit">Reset Password</button>
    </form>


    </div>
    </div>
    </div>

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
        $('.reset-password').submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan me-Reset password mahasiswa bersangkutan",
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonColor: '#28a745',
                cancelButtonColor: 'grey',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.currentTarget.submit();
                }
            })
        });
    </script>
@endpush()
