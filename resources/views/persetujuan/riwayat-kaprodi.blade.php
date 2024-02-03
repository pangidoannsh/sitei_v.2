@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Persetujuan
@endsection

@section('sub-title')
    Riwayat Persetujuan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">
            <li class="breadcrumb-item"><a class="breadcrumb-item" href="/persetujuan-kp-skripsi">Persetujuan
                    (<span>{{ $jml_persetujuan_kp + $jml_persetujuan_skripsi + $jml_persetujuan_seminar }}</span>)</a></li>
            <span class="px-2">|</span>
            <!-- <li class="breadcrumb-item"><a class="breadcrumb-item" href="/persetujuan-kaprodi">Persetujuan Seminar (<span id=""></span>)</a></li>
      <span class="px-2">|</span> -->
            <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-success"
                    href="/riwayat-kaprodi">Riwayat Persetujuan (<span>{{ $jml_riwayat_persetujuan_seminar }}</span>)</a>
            </li>
        </ol>

        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">NIM</th>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">Seminar</th>
                    <th class="text-center" scope="col">Prodi</th>
                    <th class="text-center" scope="col">Tanggal</th>
                    <th class="text-center" scope="col">Waktu</th>
                    <th class="text-center" scope="col">Lokasi</th>
                    <th class="text-center" scope="col">Pembimbing</th>
                    <th class="text-center" scope="col">Penguji</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($penjadwalan_skripsis as $skripsi)
                    <tr>
                        <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                        <td class="text-center">{{ $skripsi->mahasiswa->nama }}</td>
                        <td class="bg-warning text-center">{{ $skripsi->jenis_seminar }}</td>
                        <td class="text-center">{{ $skripsi->prodi->nama_prodi }}</td>
                        <td class="text-center">{{ Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td class="text-center">{{ $skripsi->waktu }}</td>
                        <td class="text-center">{{ $skripsi->lokasi }}</td>
                        <td class="text-center">
                            <p>1. {{ $skripsi->pembimbingsatu->nama_singkat }}</p>
                            @if ($skripsi->pembimbingdua == !null)
                                <p>2. {{ $skripsi->pembimbingdua->nama_singkat }}</p>
                            @endif
                        </td>
                        <td class="text-center">
                            <p>1. {{ $skripsi->pengujisatu->nama_singkat }}</p>
                            <p>2. {{ $skripsi->pengujidua->nama_singkat }}</p>
                            @if ($skripsi->pengujitiga == !null)
                                <p>3. {{ $skripsi->pengujitiga->nama_singkat }}</p>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
<br>
<br>
<br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                        href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                        class="text-success fw-bold">&</span>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M.
                        Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waitingApprovalCount = {!! json_encode($jml_riwayat_persetujuan_seminar) !!};
            if (waitingApprovalCount > 0) {
                Swal.fire({
                    title: 'Ini adalah halaman Riwayat Persetujuan Seminar',
                    html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> yang telah Anda setujui.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            } else {
                Swal.fire({
                    title: 'Ini adalah halaman Riwayat Persetujuan Seminar',
                    html: `Belum ada mahasiswa yang Anda setujui.`,
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                });
            }
        });
    </script>
@endpush()
