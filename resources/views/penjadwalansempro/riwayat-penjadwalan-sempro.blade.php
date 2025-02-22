@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Jadwal Sempro
@endsection

@section('sub-title')
    Riwayat Jadwal Sempro
@endsection

@section('content')
    <ol class="breadcrumb col-lg-12">
        <li class="breadcrumb-item"><a href="/form-sempro">Penjadwalan</a></li>
        <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penjadwalan-sempro">Riwayat
                Penjadwalan</a></li>
    </ol>

    <table class="table table-bordered table-striped" id="datatables">
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
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjadwalan_sempros as $sempro)
                <tr>
                    <td>{{ $sempro->nim }}</td>
                    <td>{{ $sempro->nama }}</td>
                    <td class="bg-success">{{ $sempro->jenis_seminar }}</td>
                    <td>{{ $sempro->prodi->nama_prodi }}</td>
                    <td>{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $sempro->waktu }}</td>
                    <td>{{ $sempro->lokasi }}</td>
                    <td>
                        @if ($sempro->pembimbingsatu == !null)
                        <p>1. {{ $sempro->pembimbingsatu->nama }}</p>
                        @endif
                        @if ($sempro->pembimbingdua == !null)
                            <p>2. {{ $sempro->pembimbingdua->nama }}</p>
                        @endif
                    </td>
                    <td>
                        <p>1. {{ $sempro->pengujisatu->nama }}</p>
                        <p>2. {{ $sempro->pengujidua->nama }}</p>
                        @if ($sempro->pengujitiga == !null)
                            <p>3. {{ $sempro->pengujitiga->nama }}</p>
                        @endif
                    </td>
                    <td>
                        <a href="/penilaian-sempro/cek-nilai/{{ $sempro->id }}" class="badge bg-success">Berita Acara</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
