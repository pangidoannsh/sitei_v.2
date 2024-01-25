@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Pendaftaran Kerja Praktek
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif


    <ol class="breadcrumb col-lg-12">

        <div class="btn-group scrollable-btn-group col-md-12">
            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                @if (Auth::guard('dosen')->user()->role_id == 5 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11)
                    <a href="/pendaftaran/kp-skripsi/persetujuan" class="btn bg-light border  border-bottom-0"
                        style="border-top-left-radius: 40%;">Persetujuan</a>
                @endif
            @endif
            <!-- <a href="/pendaftaran/kp-skripsi/persetujuan-pembimbing"  class="btn btn-outline-success border  border-bottom-0 active"  >Persetujuan Pembimbing</a> -->

            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                @if (Auth::guard('dosen')->user()->role_id == 5 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 6 ||
                        Auth::guard('dosen')->user()->role_id == 7 ||
                        Auth::guard('dosen')->user()->role_id == 8 ||
                        Auth::guard('dosen')->user()->role_id == 9 ||
                        Auth::guard('dosen')->user()->role_id == 10 ||
                        Auth::guard('dosen')->user()->role_id == 11)
                    <a href="/pendaftaran/kerja-praktek" class="btn bg-light border  border-bottom-0 ">Kerja Praktek TI</a>
                    <a href="/pendaftaran/skripsi" class="btn bg-light border  border-bottom-0 ">Skripsi TI</a>
                @endif
            @endif

            <a href="/pendaftaran/pembimbing/kerja-praktek" class="btn bg-light border  border-bottom-0 ">Kerja Praktek</a>
            <a href="/pendaftaran/pembimbing/skripsi" class="btn bg-light border  border-bottom-0 "
                style="border-top-right-radius: 40%;">Skripsi</a>
        </div>

    </ol>

    <div class="container-fluid">

        <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">No.</th>
                    <th class="text-center" scope="col">NIM</th>
                    <th class="text-center" scope="col">Nama</th>
                    <!-- <th class="text-center" scope="col">Konsentrasi</th>   -->
                    <th class="text-center" scope="col">Jenis Usulan</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Keterangan</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pendaftaran_kp as $kp)
                    <div></div>
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $kp->mahasiswa->nim }}</td>
                        <td class="text-center">{{ $kp->mahasiswa->nama }}</td>
                        <!-- <td class="text-center">{{ $kp->mahasiswa->konsentrasi->nama_konsentrasi }}</td>-->
                        <td class="text-center">{{ $kp->jenis_usulan }}</td>
                        @if (
                            $kp->status_kp == 'USULAN KP' ||
                                $kp->status_kp == 'SURAT PERUSAHAAN' ||
                                $kp->status_kp == 'DAFTAR SEMINAR KP' ||
                                $kp->status_kp == 'BUKTI PENYERAHAN LAPORAN')
                            <td class="text-center bg-secondary">{{ $kp->status_kp }}</td>
                        @endif
                        @if (
                            $kp->status_kp == 'USULAN KP DITERIMA' ||
                                $kp->status_kp == 'KP DISETUJUI' ||
                                $kp->status_kp == 'SEMINAR KP SELESAI' ||
                                $kp->status_kp == 'KP SELESAI')
                            <td class="text-center bg-info">{{ $kp->status_kp }}</td>
                        @endif
                        @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN')
                            <td class="text-center bg-success">{{ $kp->status_kp }}</td>
                        @endif


                        <td class="text-center">{{ $kp->keterangan }}</td>


                        <!-- PEMBIMBING -->
                        @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'USULAN KP DITERIMA')
                            <td class="text-center">
                                <a
                                    href="/usulan/detail/pembimbingprodi/{{ $kp->id }}"class="badge bg-success rounded-pill p-2 fas fa-eye">
                                    Lihat Detail</a>
                            </td>
                        @endif
                        @if ($kp->status_kp == 'SURAT PERUSAHAAN' || $kp->status_kp == 'KP DISETUJUI')
                            <td class="text-center">
                                <a
                                    href="/suratperusahaan/detail/pembimbingprodi/{{ $kp->id }}"class="badge bg-success rounded-pill p-2 fas fa-eye">
                                    Lihat Detail</a>
                            </td>
                        @endif

                        @if (
                            $kp->status_kp == 'DAFTAR SEMINAR KP' ||
                                $kp->status_kp == 'SEMINAR KP DIJADWALKAN' ||
                                $kp->status_kp == 'SEMINAR KP SELESAI')
                            <td class="text-center">
                                <a href="/daftar-semkp/detail/pembimbing/ {{ $kp->id }}"
                                    class="badge bg-success rounded-pill p-2 fas fa-eye"> Lihat Detail</a>
                            </td>
                        @endif

                        @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' || $kp->status_kp == 'KP SELESAI')
                            <td class="text-center">
                                <a
                                    href="/kpti10/detail/pembimbingprodi/{{ $kp->id }}"class="badge bg-success rounded-pill p-2 fas fa-eye">
                                    Lihat Detail</a>
                            </td>
                        @endif




                    </tr>
                @endforeach
                @foreach ($pendaftaran_skripsi as $skripsi)
                    <div></div>
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                        <td class="text-center">{{ $skripsi->mahasiswa->nama }}</td>
                        <td class="text-center">{{ $skripsi->jenis_usulan }}</td>
                        <!-- USUL JUDUL  -->
                        @if (
                            $skripsi->status_skripsi == 'USULAN JUDUL' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI KOORDINATOR SKRIPSI' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING 1' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING 2')
                            <td class="text-center bg-secondary">{{ $skripsi->status_skripsi }}</td>
                        @endif
                        @if ($skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI')
                            <td class="text-center bg-info">{{ $skripsi->status_skripsi }}</td>
                        @endif
                        <!-- DAFTAR SEMPRO -->
                        @if (
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 1' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 2' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI KOORDINATOR SKRIPSI')
                            <td class="text-center bg-secondary">{{ $skripsi->status_skripsi }}</td>
                        @endif
                        @if (
                            $skripsi->status_skripsi == 'SEMPRO DISETUJUI' ||
                                $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' ||
                                $skripsi->status_skripsi == 'SEMPRO SELESAI')
                            <td class="text-center bg-info">{{ $skripsi->status_skripsi }}</td>
                        @endif

                        <!-- DAFTAR SIDANG -->
                        @if (
                            $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING 1' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING 2' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI KOORDINATOR SKRIPSI')
                            <td class="text-center bg-secondary">{{ $skripsi->status_skripsi }}</td>
                        @endif
                        @if ($skripsi->status_skripsi == 'SIDANG DISETUJUI')
                            <td class="text-center bg-info">{{ $skripsi->status_skripsi }}</td>
                        @endif

                        <!-- ___________batas____________ -->


                        <td class="text-center">{{ $skripsi->keterangan }}</td>

                        <!-- PEMBIMBING -->
                        <!-- USUL JUDUL-->
                        @if (
                            $skripsi->status_skripsi == 'USULAN JUDUL' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI KOORDINATOR SKRIPSI' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING 1' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING 2' ||
                                $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI')
                            <td class="text-center">
                                <a href="/usuljudul/detail/pembimbing/{{ $skripsi->id }}"
                                    class="badge bg-success rounded-pill p-2 fas fa-eye"> Lihat Detail</a>
                            </td>
                        @endif

                        <!-- DAFTAR SEMPRO -->
                        @if (
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI KOORDINATOR SKRIPSI' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 1' ||
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI PEMBIMBING 2' ||
                                $skripsi->status_skripsi == 'SEMPRO DISETUJUI' ||
                                $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' ||
                                $skripsi->status_skripsi == 'SEMPRO SELESAI')
                            <td class="text-center">
                                <a href="/daftar-sempro/detail/pembimbing/{{ $skripsi->id }}"
                                    class="badge bg-success rounded-pill p-2 fas fa-eye"> Lihat Detail</a>
                            </td>
                        @endif
                        <!-- DAFTAR SIDANG -->
                        @if (
                            $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI KOORDINATOR SKRIPSI' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING 1' ||
                                $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING 2' ||
                                $skripsi->status_skripsi == 'SIDANG DISETUJUI')
                            <td class="text-center">
                                <a href="/daftar-sidang/detail/pembimbing/{{ $skripsi->id }}"
                                    class="badge bg-success rounded-pill p-2 fas fa-eye"> Lihat Detail</a>
                            </td>
                        @endif

                    </tr>
                @endforeach

            </tbody>


        </table>
    </div>


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
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endpush()
