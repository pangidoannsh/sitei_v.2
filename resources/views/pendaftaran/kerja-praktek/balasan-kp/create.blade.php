@extends('layouts.main')

@section('title')
    SITEI | Surat Balasan Perusahaan
@endsection

@section('sub-title')
    Surat Balasan Perusahaan
@endsection

@section('content')
    @foreach ($pendaftaran_kp as $kp)
        <div class="container">
            <a href="/usulankp/index" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali
                <a>
        </div>

        <form action="/balasankp/create/{{ $kp->id }}" class="mahasiswa-usulan" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div>
                <div class="row ">

                    <div class="col-12">

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Surat Balasan Perusahaan<span
                                    class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB
                                    ) </small></label>
                            <input name="surat_balasan" class="form-control @error('surat_balasan') is-invalid @enderror"
                                value="{{ old('surat_balasan') }}" type="file" id="formFile" required autofocus>

                            @error('surat_balasan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Tanggal Mulai KP<span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    <button  type="submit" class="btn mt-4 btn-lg btn-success float-right" title="Unggah Surat Perusahaan">Kirim</button>

                    </div>

                </div>
            </div>
        </form>
    @endforeach
<br>
<br>
<br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
        $('.mahasiswa-usulan').submit(function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Jika belum, silahkan cek kembali data yang akan Anda kirim.",
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#28a745',
                cancelButtonColor: 'grey',
                confirmButtonText: 'Kirim'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.currentTarget.submit();
                }
            });
        });
    });
    </script>
@endpush
