@extends('layouts.main')

@section('title')
    SITEI | PLP
@endsection

@section('sub-title')
    Edit PLP
@endsection

@section('content')
    <div class="container">
        <a href="/plp" class="btn btn-success py-1 px-2 mb-3 "><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
    </div>

    <form action="{{ url('/user/edit/' . $user->id) }}" method="POST">
        @method('put')
        @csrf
        <div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 field">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $user->username) }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $user->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md">
                    <div class="mb-3 field">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 field">
                        <label for="role_id" class="form-label">Status</label>
                        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                            <option value="">-Pilih-</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $user->role_id) == $role->id ? 'selected' : null }}>
                                    {{ $role->role_akses }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right mt-4">Ubah</button>
    </form>

    <form method="POST" action="/reset-password/user/{{ $user->id }}" class="reset-password">
        @csrf
        @method('PUT')
        <button class="btn btn-secondary mx-4 float-end mt-4" type="submit">Reset Password</button>
    </form>

    </div>
    </div>
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

@push('scripts')
    <script>
        $('.reset-password').submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan me-Reset password Staff bersangkutan",
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
