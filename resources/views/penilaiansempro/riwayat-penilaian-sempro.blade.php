@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Penilaian Sempro
@endsection

@section('sub-title')
    Riwayat Penilaian Seminar Proposal
@endsection

@section('content')
    <ol class="breadcrumb col-lg-12">
        <li class="breadcrumb-item"><a href="/penilaian-sempro">Hari Ini</a></li>
        <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>
        <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penilaian-sempro">Riwayat Penilaian</a>
        </li>
    </ol>

    <table class="table text-center table-bordered table-striped" id="datatables">
        <thead class="table-dark">
            <tr>
                <!--<th class="text-center" scope="col">#</th>-->
                <th class="text-center" scope="col">NIM</th>
                <th class="text-center" scope="col">Nama</th>
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
                    <!--<td>{{ $loop->iteration }}</td>-->
                    <td>{{ $sempro->nim }}</td>
                    <td>{{ $sempro->nama }}</td>
                    <td>{{ Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $sempro->tanggal }}</td>
                    <td>{{ $sempro->waktu }}</td>
                    <td>{{ $sempro->lokasi }}</td>
                    <td>
                        <p>{{ $sempro->pembimbingsatu->nama }}</p>
                        @if ($sempro->pembimbingdua == !null)
                            <p>{{ $sempro->pembimbingdua->nama }}</p>
                        @endif
                    </td>
                    <td>
                        <p>{{ $sempro->pengujisatu->nama }}</p>
                        <p>{{ $sempro->pengujidua->nama }}</p>
                        @if ($sempro->pengujitiga == !null)
                            <p>{{ $sempro->pengujitiga->nama }}</p>
                        @endif
                    </td>
                    <td>
                        <a href="/nilai-sempro/{{ $sempro->id }}" class="badge bg-success">Lihat Nilai</a>
                        @if (
                            $sempro->pengujisatu_nip == auth()->user()->nip ||
                                $sempro->pengujidua_nip == auth()->user()->nip ||
                                $sempro->pengujitiga_nip == auth()->user()->nip)
                            <a href="/perbaikan-sempro/{{ $sempro->id }}" class="badge bg-primary">Perbaikan</a>
                        @endif
                        @if ($sempro->pengujisatu_nip == auth()->user()->nip)
                            <a href="/penilaian-sempro/cek-nilai/{{ $sempro->id }}" class="badge bg-primary">Berita
                                Acara</a>
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
