@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Detail Mahasiswa
@endsection

@section('sub-title')
    Detail Mahasiswa
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        @if (Str::length(Auth::guard('dosen')->user()) > 0)
            <a href="/pembimbing/skripsi" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i>
                Kembali <a>
        @endif
        @if (Str::length(Auth::guard('web')->user()) > 0)
            <a href="/sidang/admin/index" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i>
                Kembali <a>
        @endif
    </div>




    @foreach ($pendaftaran_skripsi as $skripsi)
        <div class="container">
            <div class="row rounded shadow-sm">
                <div class="col-lg-6 col-md-12 bg-white px-4 py-3 mb-2 rounded-start">
                    <h5 class="text-bold">Mahasiswa</h5>
                    <hr>
                    <p class="card-title text-secondary text-sm ">Nama</p>
                    <p class="card-text  text-start">{{ $skripsi->mahasiswa->nama }}</p>
                    <p class="card-title text-secondary text-sm ">NIM</p>
                    <p class="card-text  text-start">{{ $skripsi->mahasiswa->nim }}</p>
                    <p class="card-title text-secondary text-sm ">Program Studi</p>
                    <p class="card-text  text-start">{{ $skripsi->mahasiswa->prodi->nama_prodi }}</p>
                    <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                    <p class="card-text  text-start">{{ $skripsi->mahasiswa->konsentrasi->nama_konsentrasi }}</p>
                </div>
                <div class="col-lg-6 col-md-12 bg-white px-4 py-3 mb-2 rounded-end">
                    <h5 class="text-bold">Dosen Pembimbing</h5>
                    <hr>
                    @if ($skripsi->pembimbing_2_nip == null)
                        <p class="card-title text-secondary text-sm">Nama</p>
                        <p class="card-text  text-start">{{ $skripsi->dosen_pembimbing1->nama }}</p>
                        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text  text-start" >{{ $skripsi->dosen_pembimbing1->nip }}</p> -->
                    @elseif($skripsi->pembimbing_2_nip !== null)
                        <p class="card-title text-secondary text-sm">Nama Pembimbing 1</p>
                        <p class="card-text  text-start">{{ $skripsi->dosen_pembimbing1->nama }}</p>
                        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text  text-start" >{{ $skripsi->dosen_pembimbing1->nip }}</p> -->
                        <p class="card-title text-secondary text-sm">Nama Pembimbing 2</p>
                        <p class="card-text  text-start">{{ $skripsi->dosen_pembimbing2->nama }}</p>
                        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text  text-start" >{{ $skripsi->dosen_pembimbing2->nip }}</p> -->
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row rounded shadow-sm">
                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                    <h5 class="text-bold">Laporan Skripsi</h5>
                    <hr>
                <p class="card-title text-secondary text-sm">Judul Skripsi</p>
                    <p class="card-text text-start"><span>{{ $skripsi->judul_skripsi ?? '-' }}</span></p>
                </div>
                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                    <h5 class="text-bold">Persetujuan Pengajuan Skripsi</h5>
                    <hr>
                    <p class="card-title text-secondary text-sm ">STI/TE-1 - Surat Permohonan Pengajuan Topik Skripsi</p>
                        <p class="card-text  text-start"><button onclick="window.open('/surat-permohonan-pengajuan-topik-skripsi/{{ $skripsi->id }}', '_blank')" class="badge bg-dark px-2 py-1">Buka</button>
                        </p>
                        <p class="card-title text-secondary text-sm ">STI/TE-2 - Form Pengajuan Topik Skripsi</p>
                        <p class="card-text text-start">
                            <button onclick="window.open('/form-pengajuan-topik-skripsi/{{ $skripsi->id }}', '_blank')" class="badge bg-dark px-2 py-1">Buka</button>
                        </p>
                </div>
            </div>
        </div>



        <div class="container">
            <div class="row rounded shadow-sm ">
                <div class="col-lg-6 col-md-12 bg-white mb-2 px-4 py-3 rounded-start">
                    <h5 class="text-bold">Data Usulan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-title text-secondary text-sm ">KRS Semester Berjalan</p>
                            <p class="card-text  text-start"><span><a formtarget="_blank" target="_blank"
                                        href="{{ asset('storage/' . $skripsi->krs_berjalan) }}"
                                        class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                            <p class="card-title text-secondary text-sm ">Kartu Hasil Studi</p>
                            <p class="card-text  text-start"><span><a formtarget="_blank" target="_blank"
                                        href="{{ asset('storage/' . $skripsi->khs) }}"
                                        class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                            <p class="card-title text-secondary text-sm ">Log Book</p>
                            <p class="card-text  text-start"><span><a formtarget="_blank" target="_blank"
                                        href="{{ asset('storage/' . $skripsi->logbook) }}"
                                        class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                        </div>
                        <div class="col-6">
                            <p class="card-title text-secondary text-sm ">Proposal</p>
                            <p class="card-text  text-start"><span><a formtarget="_blank" target="_blank"
                                        href="{{ asset('storage/' . $skripsi->naskah_proposal) }}"
                                        class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                            <p class="card-title text-secondary text-sm ">STI/TE-30</p>
                            <p class="card-text  text-start"><span><a formtarget="_blank" target="_blank"
                                        href="{{ asset('storage/' . $skripsi->sti_30) }}"
                                        class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                            <p class="card-title text-secondary text-sm ">STI/TE-31</p>
                            @if($skripsi->sti_31 != null)
                            <p class="card-text  text-start"><span><a formtarget="_blank" target="_blank"
                                        href="{{ asset('storage/' . $skripsi->sti_31) }}"
                                        class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                            @else
                            <p class="card-text  text-start"><span>-</span></p>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-12 bg-white mb-2 px-4 py-3  rounded-end">
                    <h5 class="text-bold">Keterangan Pendaftaran</h5>
                    <hr>
                    <p class="card-title text-secondary text-sm">Jenis Usulan</p>
                    <p class="card-text  text-start"><span>{{ $skripsi->jenis_usulan }}</span></p>
                    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO')
                        <p class="card-title text-secondary text-sm">Status Skripsi</p>
                        <p class="card-text  text-start"><span class="badge p-2 bg-secondary text-bold pr-3 pl-3"
                                style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                    @endif
                    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG')
                        <p class="card-title text-secondary text-sm">Status Skripsi</p>
                        <p class="card-text  text-start"><span class="badge p-2 bg-danger text-bold pr-3 pl-3"
                                style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                    @endif
                    @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN')
                        <p class="card-title text-secondary text-sm ">Status Skripsi</p>
                        <p class="card-text  text-start"><span class="badge p-2 bg-success text-bold pr-3 pl-3"
                                style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                    @endif
                    @if ($skripsi->status_skripsi == 'SEMPRO SELESAI' || $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
                        <p class="card-title text-secondary text-sm ">Status Skripsi</p>
                        <p class="card-text  text-start"><span class="badge p-2 bg-info text-bold pr-3 pl-3"
                                style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                    @endif
                    <p class="card-title text-secondary text-sm">Keterangan</p>
                    <p class="card-text  text-start"><span>{{ $skripsi->keterangan }}</span></p>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- APPROVAL PEMBIMBING 1 -->
            @if ($skripsi->pembimbing_1_nip == Auth::user()->nip)
                @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1')
                    <div class="mb-5 mt-3 float-right">
                        <div class="row row-cols-2">
                            <div class="col">
                                <button onclick="tolakSemproPemb1()" class="btn btn-danger py-2 px-3 mb-3"
                                    data-bs-toggle="tooltip" title="Tolak">Tolak</button>
                            </div>
                            <div class="col">
                                <form action="/daftarsempro/pembimbing1/approve/{{ $skripsi->id }}"
                                    class="setujui-sempro-pemb1" method="POST">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <!-- @if ($skripsi->pembimbing_1_nip == Auth::user()->nip)
    @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN')
    <div class="mb-5 mt-3 float-right">
            <div class="row row-cols-2">
        <div class="col">
            <button onclick="tolakSelesaiSempro()"  class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Gagal Sempro" >Gagal</button>
    </div>
        <div class="col">
            <form action="/selesaisempro/pembimbing/approve/{{ $skripsi->id }}" class="setujui-selesai-sempro-pemb1" method="POST">
        @method('put')
        @csrf
        <button class="btn btn-success py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Selesai Sempro">Selesai</i></button>
    </form>
        </div>
      </div>
      </div>
    @endif
    @endif -->


            @if ($skripsi->pembimbing_2_nip == Auth::user()->nip)
                @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 2')
                    <div class="mb-5 mt-3 float-right">
                        <div class="row row-cols-2">
                            <div class="col">
                                <button onclick="tolakSemproPemb2()" class="btn btn-danger py-2 px-3 mb-3"
                                    data-bs-toggle="tooltip" title="Tolak">Tolak</button>
                            </div>
                            <div class="col">
                                <form action="/daftarsempro/pembimbing2/approve/{{ $skripsi->id }}"
                                    class="setujui-sempro-pemb2" method="POST">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if (Str::length(Auth::guard('web')->user()) > 0)
                @if (Auth::guard('web')->user()->role_id == 2 ||
                        Auth::guard('web')->user()->role_id == 3 ||
                        Auth::guard('web')->user()->role_id == 4)
                    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' && $skripsi->keterangan == 'Menunggu persetujuan Admin Prodi')
                        <div class="mb-5 mt-3 float-right">
                            <div class="row row-cols-2">
                                <div class="col">
                                    <button onclick="tolakSemproAdmin()" class="btn btn-danger py-2 px-3 mb-3"
                                        data-bs-toggle="tooltip" title="Tolak">Tolak</button>
                                </div>
                                <div class="col">
                                    <form action="/daftar-sempro/admin/approve/{{ $skripsi->id }}"
                                        class="setujui-sempro-admin" method="POST">
                                        @method('put')
                                        @csrf
                                        <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
                                    </form>
                                </div>
                            </div>
                    @endif
                @endif
            @endif
    @endforeach
    </div>

    <br>
    <br>
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
    @foreach ($pendaftaran_skripsi as $skripsi)
        <script>
            //SEMPRO
            $('.setujui-sempro-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sempro!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemproPemb1() {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/daftarsempro/pembimbing1/tolak/{{ $skripsi->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
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

            $('.setujui-sempro-pemb2').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sempro!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemproPemb2() {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/daftarsempro/pembimbing2/tolak/{{ $skripsi->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
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


            $('.setujui-selesai-sempro-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Selesai Seminar Proposal!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Selesai'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSelesaiSempro() {
                Swal.fire({
                    title: 'Gagal Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Gagal',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Gagal Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/selesaisempro/pembimbing/tolak/{{ $skripsi->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
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

            //ADMIN
            $('.setujui-sempro-admin').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Seminar Proposal!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemproAdmin() {
                Swal.fire({
                    title: 'Tolak Daftar Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Daftar Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/daftar-sempro/admin/tolak/{{ $skripsi->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
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
    @endforeach
@endpush()
