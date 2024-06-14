@extends('layouts.main')

@php
    use Carbon\Carbon;
    if (!preg_match('~^(?:f|ht)tps?://~i', $mbkm->rincian_link)) {
        $link = 'https://' . $mbkm->rincian_link;
    }
@endphp

@section('title')
    SITEI MBKM | Detail Mahasiswa
@endsection

@section('sub-title')
    Detail MBKM
@endsection
<style>

</style>
@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fluid">
        <a href="{{ Auth::guard('dosen')->check() ? route('mbkm.prodi') : (Auth::guard('mahasiswa')->check() ? route('mbkm') : route('mbkm.staff')) }}"
            class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5" style="width: 120px;" >Kembali<a>
    </div>
    @if ($mbkm->status == 'Usulan pengunduran diri' || $mbkm->status == 'Mengundurkan diri')
        <div class="card">
            <div class="card-body">
                @if ($mbkm->status == 'Usulan pengunduran diri')
                    <h5>Pengajuan Pengunduran Diri</h5>
                    <hr>
                @elseif($mbkm->status == 'Mengundurkan diri')
                    <div class="status-danger mb-3" style="width: max-content">
                        Mahasiswa Telah Mengundurkan Diri
                    </div>
                @endif
                <div class="d-flex flex-column">
                    <p class="card-title text-secondary text-sm ">Surat Pengunduran Diri</p>
                    <div>
                        <a href="{{ asset('storage/' . $mbkm->surat_pengunduran) }}"
                            target="_blank"class="badge bg-dark px-3 p-1">Buka</a>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="card-title text-secondary text-sm ">Alasan Pengunduran Diri</p>
                    <p class="card-text text-start">{{ $mbkm->alasan_undur_diri }}</p>
                </div>
                @if ($mbkm->status == 'Usulan pengunduran diri')
                    @if (Auth::guard('dosen')->check() && in_array(Auth::guard('dosen')->user()->role_id, [6, 7, 8]))
                        <form action="{{ route('mbkm.prodi.approvepengunduran', $mbkm->id) }}" method="POST"
                            style="display: inline;" id="pengunduran-diri" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-success p-1 mb-1">
                                Setujui Pengajuan
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-bold">Mahasiswa</h5>
                    <hr>
                    <div
                        class="text-center @switch($mbkm->status)
                        @case('Usulan')
                        @case('Usulan konversi nilai')
                        @case('Usulan pengunduran diri')
                        status-warning
                        @break
                        @case('Disetujui')
                        @case('Konversi diterima')
                        @case('Nilai sudah keluar')
                            status-success
                            @break
                        @default
                            status-danger
                    @endswitch">
                        {{ $mbkm->status }}
                    </div>
                    <p class="card-title text-secondary text-sm ">Nama</p>
                    <p class="card-text text-start">{{ $mbkm->mahasiswa->nama }}</p>
                    <p class="card-title text-secondary text-sm ">NIM</p>
                    <p class="card-text text-start">{{ $mbkm->mahasiswa->nim }}</p>
                    <p class="card-title text-secondary text-sm ">Program Studi</p>
                    <p class="card-text text-start">{{ $mbkm->mahasiswa->prodi->nama_prodi }}</p>
                    <p class="card-title text-secondary text-sm ">Email</p>
                    <p class="card-text text-start">{{ $mbkm->mahasiswa->email }}</p>
                    <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                    <p class="card-text text-start">{{ $mbkm->mahasiswa->konsentrasi->nama_konsentrasi }}</p>
                    <p class="card-title text-secondary text-sm ">Periode</p>
                    <p class="card-text text-start">{{ $mbkm->periode_mbkm }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-bold">Data Lokasi MBKM</h5>
                    <hr>
                    <p class="card-title text-secondary text-sm">Nama Perusahaan</p>
                    <p class="card-text text-start">{{ $mbkm->perusahaan }}</p>
                    <p class="card-title text-secondary text-sm">Alamat Perusahaan</p>
                    <p class="card-text text-start"> {{ $mbkm->alamat }}</p>
                    <p class="card-title text-secondary text-sm">Bidang Usaha/Kegiatan</p>
                    <p class="card-text text-start">{{ $mbkm->bidang_usaha }}</p>
                    <p class="card-title text-secondary text-sm">Rincian Kegiatan</p><br>
                    <a href="{{ asset('storage/' . $mbkm->rincian) }}" target="_blank" target="_blank"
                        class="badge bg-dark px-3 p-1">PDF</a>
                    @if ($mbkm->rincian_link)
                        <a href="{{ $link }}" target="_blank"class="badge bg-dark px-3 p-1">Link</a>
                    @endif
                    <br><br>
                    <p class="card-title text-secondary text-sm">Periode Kegiatan</p>
                    <p class="card-text text-start "> {{ $mbkm->priode_kegiatan }}</p>
                    <p class="card-title text-secondary text-sm">Judul</p>
                    <p class="card-text text-start ">{{ $mbkm->judul }}</p>

                </div>
            </div>
        </div>
    </div>

    @if (!in_array($mbkm->status, ['Usulan', 'Ditolak']))
        <div class="card">
            <div class="card-body">
                <h5 class="text-bold">Sertifikat dan Konversi Nilai</h5>
                <hr>
                <p class="card-title text-secondary text-sm">Sertifikat</p><br>
                @if ($sertifikat)
                    <a href="{{ asset('storage/' . $sertifikat->file) }}"
                        target="_blank"class="badge bg-dark px-3 p-1">Buka</a>
                    <br>
                @else
                    <div class="d-flex align-items-center" style="gap:8px">
                        <span class="text-secondary">Belum upload sertifikat</span>
                        @if (optional(Auth::guard('mahasiswa')->user())->nim == $mbkm->mahasiswa_nim)
                            <a href="{{ route('mbkm.sertif.create', $mbkm->id) }}" class="badge bg-dark px-3 py-2">
                                Upload Sertifikat
                            </a>
                        @endif
                    </div>
                @endif
                <br>
                {{-- <p class="card-text text-start " >Belum Upload</p> --}}
                <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" scope="col">NO</th>
                            <th class="text-center" scope="col">Nama Mata Kuliah</th>
                            <th class="text-center" scope="col">Nama Nilai MBKM</th>
                            <th class="text-center" scope="col">Nilai Konversi</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konversi as $kr)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $kr->nama_nilai_matkul }}</td>
                                <td class="text-center">{{ $kr->nama_nilai_mbkm }}</td>
                                <td class="text-center">{{ $kr->nilai_mbkm }}</td>
                                <td class="text-center">
                                    @if (in_array($mbkm->status, ['Usulan disetujui']))
                                        <form onsubmit="return confirm(' Hapus package? ');"
                                            action="{{ route('mbkm.sertif.destroykonversi', [$kr->id]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge btn btn-danger p-1.5 mb-2"><i
                                                    class="fas fa-times"></i></button>
                                        </form>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (optional(Auth::guard('mahasiswa')->user())->nim == $mbkm->mahasiswa_nim)
                    <a href="{{ route('mbkm.sertif.create', $mbkm->id) }}" class="btn btn-outline-success mt-3">
                        Tambah Konversi Mata Kuliah
                    </a>
                @endif
            </div>
        </div>
    @endif
    <div class="d-flex justify-content-end" style="gap:8px">
        @if (Auth::guard('dosen')->user() && in_array(Auth::guard('dosen')->user()->role_id, [6, 7, 8]))
            @if ($mbkm->status == 'Usulan')
                <div>
                    <button onclick="tolakUsulanmbkmKaprodi()" class="btn btn-danger badge p-2 px-3"
                        data-bs-toggle="tooltip" title="Tolak">Tolak</button>
                </div>
                <form action="{{ route('mbkm.prodi.approveusulan', $mbkm->id) }}" class="setujui-usulankp-kaprodi"
                    method="POST">
                    @csrf
                    <button class="btn btn-success badge p-2 px-3 mb-3">Setujui</i></button>
                </form>
            @elseif($mbkm->status == 'Usulan konversi nilai')
                <div>
                    <button onclick="tolakUsulankonversiKaprodi()" class="btn btn-danger badge p-2 px-3"
                        data-bs-toggle="tooltip" title="Tolak">Tolak</button>
                </div>
                <form action="{{ route('mbkm.prodi.approvekonversi', $mbkm->id) }}" class="setujui-usulankp-kaprodi"
                    method="POST">
                    @csrf
                    <button class="btn btn-success badge p-2 px-3 mb-3">Setujui</i></button>
                </form>
            @endif
        @endif
    </div>
    <form action="{{ route('mbkm.uploaded', $mbkm->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="badge btn btn-info p-1 mb-1"><i class="fas fa-check"
                title="Ajukan Konversi"></i></button>
    </form>
@endsection
@section('footer')
    <section class="bg-dark p-1">
        <div class="container d-flex justify-content-center">
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
        $("#pengunduran-diri").submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Usulan Pengunduran Diri',
                text: 'Setujui Usulan Pengunduran Diri?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setujui',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })

        function tolakUsulanmbkmKaprodi() {
            Swal.fire({
                title: 'Tolak Usulan MBKM',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tolak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tolak Usulan MBKM',
                        html: `
                        <form id="reasonForm" action="/prodi/tolakusulan/{{ $mbkm->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="catatan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        }

        function tolakUsulankonversiKaprodi() {
            Swal.fire({
                title: 'Tolak Konversi MBKM',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tolak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tolak Usulan MBKM',
                        html: `
                        <form id="reasonForm" action="/prodi/tolakkonversi/{{ $mbkm->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="catatan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        }
    </script>
@endpush()
