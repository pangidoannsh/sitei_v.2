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

    <section>
        <div class="container">
            <a href="/pembimbing/skripsi" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i>
                Kembali <a>
        </div>

        @foreach ($pendaftaran_skripsi as $skripsi)
            <div class="container">
                <div class="row rounded shadow-sm">
                    <div class="col-lg-6 col-md-12 bg-white px-4 py-3 mb-2 rounded-start">
                        <h5 class="text-bold">Mahasiswa</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm ">Nama</p>
                        <p class="card-text text-start">{{ $skripsi->mahasiswa->nama }}</p>
                        <p class="card-title text-secondary text-sm ">NIM</p>
                        <p class="card-text text-start">{{ $skripsi->mahasiswa->nim }}</p>
                        <p class="card-title text-secondary text-sm ">Program Studi</p>
                        <p class="card-text text-start">{{ $skripsi->mahasiswa->prodi->nama_prodi }}</p>
                        <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                        <p class="card-text text-start">{{ $skripsi->mahasiswa->konsentrasi->nama_konsentrasi }}</p>
                    </div>
                    <div class="col-lg-6 col-md-12 bg-white px-4 py-3 mb-2 rounded-end">
                        <h5 class="text-bold">Dosen Pembimbing</h5>
                        <hr>
                        @if ($skripsi->pembimbing_2_nip == null)
                            <p class="card-title text-secondary text-sm">Nama</p>
                            <p class="card-text text-start">{{ $skripsi->dosen_pembimbing1->nama }}</p>
                            <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text text-start" >{{ $skripsi->dosen_pembimbing1->nip }}</p> -->
                        @elseif($skripsi->pembimbing_2_nip !== null)
                            <p class="card-title text-secondary text-sm">Nama Pembimbing 1</p>
                            <p class="card-text text-start">{{ $skripsi->dosen_pembimbing1->nama }}</p>
                            <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text text-start" >{{ $skripsi->dosen_pembimbing1->nip }}</p> -->
                            <p class="card-title text-secondary text-sm">Nama Pembimbing 2</p>
                            <p class="card-text text-start">{{ $skripsi->dosen_pembimbing2->nama }}</p>
                            <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text text-start" >{{ $skripsi->dosen_pembimbing2->nip }}</p> -->
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
                <div class="row rounded shadow-sm">
                    <div class="col-lg-6 col-md-12 bg-white px-4 py-3 mb-2 rounded-start">
                        <h5 class="text-bold">Data Usulan</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm ">STI/TE-23/SURAT PERNYATAAN PERPANJANGAN REVISI SKRIPSI
                        </p>
                        <p class="card-text text-start"><span><a formtarget="_blank" target="_blank"
                                    href="{{ asset('storage/' . $skripsi->sti_23) }}"
                                    class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
                    </div>
                    <div class="col-lg-6 col-md-12 bg-white px-4 py-3 mb-2 rounded-end">
                        <h5 class="text-bold">Keterangan Pendaftaran</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Jenis Usulan</p>
                        <p class="card-text text-start"><span>{{ $skripsi->jenis_usulan }}</span></p>
                        @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK')
                            <p class="card-title text-secondary text-sm">Status Skripsi</p>
                            <p class="card-text text-start"><span class="badge p-2 bg-danger text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                        @endif
                        @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI')
                            <p class="card-title text-secondary text-sm">Status Skripsi</p>
                            <p class="card-text text-start"><span class="badge p-2 bg-secondary text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                        @endif
                        @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                            <p class="card-title text-secondary text-sm ">Status Skripsi</p>
                            <p class="card-text text-start"><span class="badge p-2 bg-info text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $skripsi->status_skripsi }}</span></p>
                        @endif
                        <p class="card-title text-secondary text-sm">Keterangan</p>
                        <p class="card-text text-start"><span>{{ $skripsi->keterangan }}</span></p>
                    </div>
                </div>
            </div>

            <div class="container">
                @if ($skripsi->pembimbing_1_nip == Auth::user()->nip)
                    @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1')
                        <div class="mb-5 mt-3 float-right">
                            <div class="row row-cols-2">
                                <div class="col">
                                    <button onclick="tolakPerpanjanganRevisiPembimbing({{ $skripsi->id }})"
                                        class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip"
                                        title="Tolak">Tolak</button>
                                </div>
                                <div class="col">
                                    <form action="/perpanjangan-revisi/pembimbing/approve/{{ $skripsi->id }}"
                                        class="setujui-perpanjangan-revisi-pembimbing" method="POST">
                                        @method('put')
                                        @csrf
                                        <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        @endforeach
    </section>


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
            //PERPANJANGAN REVISI

            $('.setujui-perpanjangan-revisi-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan Revisi Skripsi!',
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

            function tolakPerpanjanganRevisiPembimbing(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan Revisi Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan Revisi Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan-revisi/pembimbing/tolak/${id}" method="POST">
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
