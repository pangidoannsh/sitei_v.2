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
            <a href="/pembimbing-penguji/riwayat-bimbingan" class="btn btn-success py-1 px-2 mb-3 "><i
                    class="fas fa-arrow-left fa-xs"></i> Kembali <a>
        @endif
    </div>

    @foreach ($pendaftaran_kp as $kp)
        <div class="container">
            <div class="row shadow-sm">
                <div class="col-lg-6 col-md-12 bg-white rounded-start px-4 py-3 mb-2">

                    <h5 class="text-bold">Mahasiswa</h5>
                    <hr>
                    <p class="card-title  text-muted text-sm ">Nama</p>
                    <p class="card-text lh-1 text-start">{{ $kp->mahasiswa->nama }}</p>
                    <p class="card-title  text-muted text-sm ">NIM</p>
                    <p class="card-text lh-1 text-start">{{ $kp->mahasiswa->nim }}</p>
                    <p class="card-title  text-muted text-sm ">Program Studi</p>
                    <p class="card-text lh-1 text-start">{{ $kp->mahasiswa->prodi->nama_prodi }}</p>
                    <p class="card-title  text-muted text-sm ">Konsentrasi</p>
                    <p class="card-text lh-1 text-start">{{ $kp->mahasiswa->konsentrasi->nama_konsentrasi }}</p>

                </div>
                <div class="col-lg-6 col-md-12 bg-white rounded-end px-4 py-3 mb-2">

                    <h5 class="text-bold">Dosen Pembimbing</h5>
                    <hr>
                    <p class="card-title  text-secondary text-sm">Nama Pembimbing</p>
                    <p class="card-text lh-1 text-start">{{ $kp->dosen_pembimbingkp->nama }}</p>
                    <!-- <p class="card-title text-secondary text-sm" >NIP</p>
            <p class="card-text text-start" >{{ $kp->dosen_pembimbingkp->nip }}</p> -->

                </div>
            </div>
        </div>

         <div class="container">
            <div class="row rounded shadow-sm">
                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                    <h5 class="text-bold">Laporan KP</h5>
                    <hr>
                <p class="card-title text-secondary text-sm">Judul Laporan</p>
                    <p class="card-text text-start"><span>{{ $kp->judul_laporan ?? '-' }}</span></p>
                
                    <p class="card-title text-secondary text-sm">Nama Perusahaan/Instansi</p>
                    <p class="card-text text-start"><span>
                        @if($kp->nama_perusahaan != null)
                        {{ $kp->nama_perusahaan}}
                        @else
                        -
                        @endif
                    </span></p>

                </div>
                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                    <h5 class="text-bold">Surat Persetujuan Permohonan KP</h5>
                    <hr>
                
                    <p class="card-title text-secondary text-sm">KPTI/TE-1 - Surat Permohonan KP</p>
                        <p class="card-text  text-start"><button onclick="window.open('/surat-permohonan-kp/{{ $kp->id }}', '_blank')" class="badge bg-dark px-2 py-1">Buka</button>
                        </p>
                        <p class="card-title text-secondary text-sm">KPTI/TE-2 - Form Permohonan KP</p>
                        <p class="card-text text-start">
                            <button onclick="window.open('/form-permohonan-kp/{{ $kp->id }}', '_blank')" class="badge bg-dark px-2 py-1">Buka</button>
                            </p>
                </div>
            </div>
        </div>

        @if ($kp->status_kp == 'KP SELESAI')
            <div class="container">
                <div class="row shadow-sm">
                    <div class="col-lg-6 col-md-12 bg-white rounded-start mb-2 px-4 py-3">
                        <h5 class="text-bold">Data Usulan</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">KPTI/TE-10 - Bukti Penyerahan Laporan</p>
                        <p class="card-text lh-1 text-start"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $kp->kpti_10) }}"
                                class="badge bg-dark rounded py-2 px-3">Buka</a></p>

                        <p class="card-title text-secondary text-sm">Laporan KP</p>
                        <p class="card-text lh-1 text-start"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $kp->laporan_akhir) }}"
                                class="badge bg-dark rounded py-2 px-3">Buka</a></p>


                    </div>
                    <div class="col-lg-6 col-md-12 bg-white rounded-end mb-2 px-4 py-3">
                        <h5 class="text-bold">Nilai Kerja Praktek</h5>
                        <hr>
                        <p class="card-title  text-secondary text-sm">Nilai Angka</p>
                        <p class="card-text   text-start"> <span class="fw-bold fs-5">
                                @if ($nilai_pembimbing == '' || $nilai_penguji == '')
                                    -
                                @else
                                    {{ round(($nilai_pembimbing->total_nilai_angka + $nilai_penguji->total_nilai_angka + $nilai_pembimbing->nilai_pembimbing_lapangan) / 3) }}
                                @endif
                            </span>
                        </p>

                        <p class="card-title  text-secondary text-sm">Nilai Huruf</p>
                        <p class="card-text   text-start"><span class="fw-bold fs-5">
                                @if ($nilai_pembimbing == '' || $nilai_penguji == '')
                                    -
                                @else
                                    @if (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            85)
                                        A
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            80)
                                        A-
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            75)
                                        B+
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            70)
                                        B
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            65)
                                        B-
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            60)
                                        C+
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            55)
                                        C
                                    @elseif (
                                        ($nilai_pembimbing->total_nilai_angka +
                                            $nilai_penguji->total_nilai_angka +
                                            $nilai_pembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            40)
                                        D
                                    @else
                                        E
                                    @endif
                                @endif
                            </span>
                        </p>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row rounded shadow-sm">
                    <div class="col bg-white rounded px-4 py-3 mb-2">
                        <h5 class="text-bold">Keterangan Pendaftaran</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Jenis Usulan</p>
                        <p class="card-text lh-1 text-start"><span>{{ $kp->jenis_usulan }}</span></p>
                        @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')
                            <p class="card-title text-secondary text-sm">Status KP</p>
                            <p class="card-text lh-1 text-start"><span class="badge p-2 bg-secondary text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $kp->status_kp }}</span></p>
                        @endif
                        @if ($kp->status_kp == 'KP SELESAI')
                            <p class="card-title text-secondary text-sm ">Status KP</p>
                            <p class="card-text lh-1 text-start"><span class="badge p-2 bg-info text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $kp->status_kp }}</span></p>
                        @endif
                        <p class="card-title text-secondary text-sm">Keterangan</p>
                        <p class="card-text lh-1 text-start"><span>{{ $kp->keterangan }}</span></p>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row shadow-sm">
                    <div class="col-lg-6 col-md-12 bg-white rounded-start mb-2 px-4 py-3">
                        <h5 class="text-bold">Data Usulan</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">KPTI/TE-10 - Bukti Penyerahan Laporan</p>
                        <p class="card-text lh-1 text-start"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $kp->kpti_10) }}"
                                class="badge bg-dark rounded py-2 px-3">Buka</a></p>

                        <p class="card-title text-secondary text-sm">Laporan KP</p>
                        <p class="card-text lh-1 text-start"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $kp->kpti_10) }}"
                                class="badge bg-dark rounded py-2 px-3">Buka</a></p>


                    </div>
                    <div class="col-lg-6 col-md-12 bg-white rounded-end mb-2 px-4 py-3">
                        <h5 class="text-bold">Keterangan Pendaftaran</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Jenis Usulan</p>
                        <p class="card-text lh-1 text-start"><span>{{ $kp->jenis_usulan }}</span></p>
                        @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')
                            <p class="card-title text-secondary text-sm">Status KP</p>
                            <p class="card-text lh-1 text-start"><span class="badge p-2 bg-secondary text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $kp->status_kp }}</span></p>
                        @endif
                        @if ($kp->status_kp == 'KP SELESAI')
                            <p class="card-title text-secondary text-sm ">Status KP</p>
                            <p class="card-text lh-1 text-start"><span class="badge p-2 bg-info text-bold pr-3 pl-3"
                                    style="border-radius:20px;">{{ $kp->status_kp }}</span></p>
                        @endif
                        <p class="card-title text-secondary text-sm">Keterangan</p>
                        <p class="card-text lh-1 text-start"><span>{{ $kp->keterangan }}</span></p>

                    </div>
                </div>
            </div>
        @endif
    @endforeach
    </div>
    </div>
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
