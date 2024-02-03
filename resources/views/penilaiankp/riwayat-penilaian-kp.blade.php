@extends('layouts.main')

@section('title')
    SITEI | Riwayat Penilaian Seminar KP
@endsection

@section('sub-title')
    Riwayat Penilaian Seminar KP
@endsection

@section('content')
    <ol class="breadcrumb col-lg-12">
        <li class="breadcrumb-item"><a href="/penilaian-kp">Hari Ini</a></li>
        <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>
        <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penilaian-kp">Riwayat Penilaian</a></li>
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
                    <td>{{ $kp->tanggal }}</td>
                    <td>{{ $kp->waktu }}</td>
                    <td>{{ $kp->lokasi }}</td>
                    <td>
                        <p>{{ $kp->pembimbing->nama }}</p>
                    </td>
                    <td>
                        <p>{{ $kp->penguji->nama }}</p>
                    </td>
                    <td>
                        <a href="/perbaikan-kp/{{ $kp->id }}"
                            class="badge bg-info p-2"style="border-radius:20px;">Perbaikan</a>
                        <a href="/nilai-kp/{{ $kp->id }}"
                            class="badge bg-success mt-2 p-2"style="border-radius:20px;">Berita Acara</a>
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
