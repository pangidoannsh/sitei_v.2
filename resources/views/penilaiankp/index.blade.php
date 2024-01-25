@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Penilaian Seminar KP
@endsection

@section('sub-title')
    Penilaian Seminar KP
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
        </div>
    @endif

    <ol class="breadcrumb col-lg-12">
        <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/penilaian-kp">Hari Ini</a></li>
        <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>
        <li class="breadcrumb-item"><a href="/riwayat-penilaian-kp">Riwayat Penilaian</a></li>
    </ol>

    <table class="table text-center table-bordered table-striped" id="datatables">
        <thead class="table-dark">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">NIM</th>
                <th class="text-center" scope="col">Nama</th>
                <th class="text-center" scope="col">Seminar</th>
                <th class="text-center" scope="col">Tanggal</th>
                <th class="text-center" scope="col">Waktu</th>
                <th class="text-center" scope="col">Lokasi</th>
                <th class="text-center" scope="col">Pembimbing</th>
                <th class="text-center" scope="col">Penguji</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjadwalan_kps as $kp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kp->mahasiswa->nim }}</td>
                    <td>{{ $kp->mahasiswa->nama }}</td>
                    <td>{{ $kp->jenis_seminar }}</td>
                    <td>{{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $kp->waktu }}</td>
                    <td>{{ $kp->lokasi }}</td>
                    <td>
                        <p>{{ $kp->pembimbing->nama }}</p>
                    </td>
                    <td>
                        <p>{{ $kp->penguji->nama }}</p>
                    </td>
                    <td>
                        @if (Carbon::now() >= $kp->tanggal && Carbon::now()->format('H:i:m') >= $kp->waktu)
                            <a href="/penilaian-kp/create/{{ $kp->id }}"
                                class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>
                                @else
                                    <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum
                                        Dimulai</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
