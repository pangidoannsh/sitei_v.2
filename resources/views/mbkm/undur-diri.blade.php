@extends('doc.main-layout')

@php
    use Carbon\Carbon;
    $link = 'https://' . $mbkm->rincian_link;
@endphp

@section('title')
    SITEI MBKM | Detail Mahasiswa
@endsection

@section('sub-title')
    Usulan Pengunduran Diri
@endsection

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5" style="width: 120px;">Kembali </a>
    <section class="row pb-5">
        <div class="col-lg-6">
            <div class="dokumen-card">
                <div>
                    <h2>Data MBKM</h2>
                    <div class="divider-green"></div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Judul</div>
                    <div class="value text-capitalize">{{ $mbkm->judul }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Lokasi</div>
                    <div class="value text-capitalize">
                        {{ $mbkm->perusahaan }}
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Bidang Usaha/Kegiatan</div>
                    <div class="value text-capitalize">
                        {{ $mbkm->bidang_usaha }}
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Periode Kegiatan</div>
                    <div class="value">
                        {{ Carbon::parse($mbkm->mulai_kegiatan)->translatedFormat('d F Y') .
                            ' - ' .
                            Carbon::parse($mbkm->selesai_kegiatan)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
        {{-- Section Kanan --}}
        <div class="col-lg-6">
            <div class="dokumen-card">
                <form action="{{ route('mbkm.undurdiri.store', $mbkm->id) }}" id="form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="file" class="form-label">Surat Pengunduran Diri</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file"
                            accept=".jpg, .png, .pdf" id="file" name="file" required>
                    </div>
                    <div>
                        <label for="alasan">Alasan Pengunduran Diri</label>
                        <textarea name="alasan" id="alasan" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-danger mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5" style="width: 220px;">Ajukan Pengunduran Diri</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
    <script>
        $('#form').submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Usulan Pengunduran Diri',
                text: 'Apakah anda yakin mengajukan pengunduran diri?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ajukan',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })
    </script>
@endpush
