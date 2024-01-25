@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Berita Acara Seminar KP
@endsection

@section('sub-title')
    Berita Acara Seminar KP
@endsection

@section('content')

    <div>
        <div class="row">
            <div class="col mb-3">
                <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">NIM</div>
                            <span>{{ $penjadwalan->mahasiswa->nim }}</span>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Nama</div>
                            <span>{{ $penjadwalan->mahasiswa->nama }}</span>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="col-md">
                <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Pembimbing</div>
                            <span>{{ $penjadwalan->pembimbing->nama }}</span>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Penguji</div>
                            <span>{{ $penjadwalan->penguji->nama }}</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="kol-judul mt-3">
        <div class="row">
            <div class="col">
                <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Judul</div>
                            <span>{{ $penjadwalan->judul_kp }}</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="kol-jadwal mt-3 mb-3">
        <div class="row">
            <div class="col mb-3 kol-jadwal">
                <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Jadwal</div>
                            <span>{{ Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y') }}, :
                                {{ $penjadwalan->waktu }}</span>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="col-md">
                <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Lokasi</div>
                            <span>{{ $penjadwalan->lokasi }}</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card-body bg-white mb-3" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 200px">Penilaian Penguji</th>
                                    <th class="bg-success text-center">B</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Presentasi</td>
                                    <td class="bg-secondary text-center">10</td>
                                    <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->presentasi : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Materi</td>
                                    <td class="bg-secondary text-center">10</td>
                                    <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->materi : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Tanya Jawab</td>
                                    <td class="bg-secondary text-center">10</td>
                                    <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->tanya_jawab : '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">Total Nilai Penguji</td>
                                    <td class="bg-success text-center">30</td>
                                    <td class="text-center">
                                        {{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_angka : '-' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Nilai Huruf Penguji</td>
                                    <td class="text-center">
                                        {{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_huruf : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 200px">Penilaian Pembimbing</th>
                                    <th class="bg-success text-center">B</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Presentasi</td>
                                    <td class="bg-secondary text-center">10</td>
                                    <td class="text-center">
                                        {{ $nilaipembimbing != '' ? $nilaipembimbing->presentasi : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Materi</td>
                                    <td class="bg-secondary text-center">10</td>
                                    <td class="text-center">{{ $nilaipembimbing != '' ? $nilaipembimbing->materi : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Tanya Jawab</td>
                                    <td class="bg-secondary text-center">10</td>
                                    <td class="text-center">
                                        {{ $nilaipembimbing != '' ? $nilaipembimbing->tanya_jawab : '-' }}</td>
                                </tr>

                                <tr>
                                    <td colspan="2">Total Nilai Pembimbing</td>
                                    <td class="bg-success text-center">30</td>
                                    <td class="text-center">
                                        {{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_angka : '-' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Nilai Huruf Pembimbing</td>
                                    <td class="text-center">
                                        {{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_huruf : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <table class="table table-bordered" style="background-color:white;">
                    <thead class="bg-success">
                        <tr>
                            <th style="width: 50px">#</th>
                            <th style="width: 600px">Nilai</th>
                            <th>Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="gridratakiri">
                        <tr>
                            <td>1</td>
                            <td>Nilai Seminar</td>
                            <td>{{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_angka : '-' }}</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Nilai Pembimbing Lapangan</td>
                            <td>{{ $nilaipembimbing != '' ? $nilaipembimbing->nilai_pembimbing_lapangan : '-' }}</ </tr>

                        <tr>
                            <td>3</td>
                            <td>Nilai Pembimbing KP</td>
                            <td>{{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_angka : '-' }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Total Angka</td>
                            <td class="text-bold">
                                @if ($nilaipembimbing == '' || $nilaipenguji == '')
                                    -
                                @else
                                    {{ round(($nilaipembimbing->total_nilai_angka + $nilaipenguji->total_nilai_angka + $nilaipembimbing->nilai_pembimbing_lapangan) / 3) }}
                            </td>
                            @endif
                        </tr>

                        <tr>
                            <td colspan="2">Total Huruf</td>
                            <td class="text-bold">
                                @if ($nilaipembimbing == '' || $nilaipenguji == '')
                                    -
                                @else
                                    @if (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            85)
                                        A
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            80)
                                        A-
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            75)
                                        B+
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            70)
                                        B
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            65)
                                        B-
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            60)
                                        C+
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            55)
                                        C
                                    @elseif (
                                        ($nilaipembimbing->total_nilai_angka +
                                            $nilaipenguji->total_nilai_angka +
                                            $nilaipembimbing->nilai_pembimbing_lapangan) /
                                            3 >=
                                            40)
                                        D
                                    @else
                                        E
                                    @endif
                                @endif
                            </td>
                        </tr>

                    </tbody>
                </table>

                @if ($penjadwalan->status_seminar == 1)
                    <form action="/persetujuankp-koordinator/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-success float-right border-0 ml-3">Setujui</button>
                    </form>
                    <form action="/persetujuankp-koordinator/tolak/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-danger float-right border-0">Tolak</button>
                    </form>
                @endif

                @if ($penjadwalan->status_seminar == 2)
                    <form action="/persetujuankp-kaprodi/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-success float-right border-0 ml-3">Setujui</button>
                    </form>
                    <form action="/persetujuankp-kaprodi/tolak/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-danger float-right border-0">Tolak</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
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
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">
                        M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection
