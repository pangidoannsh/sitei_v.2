@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Berita Acara Sempro | SIA ELEKTRO
@endsection

@section('sub-title')
    Berita Acara Seminar Proposal
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
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Konsentrasi</div>
                            <span>{{ $penjadwalan->mahasiswa->konsentrasi->nama_konsentrasi }}</span>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="col-md">
                <ol class="list-group" style="box-shadow: 1px 1px 1px 1px #dbdbdb; border-radius:5px;">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Pembimbing</div>
                            <span>1. {{ $penjadwalan->pembimbingsatu->nama }}</span>
                            <br>
                            @if ($penjadwalan->pembimbingdua_nip != null)
                                <span>2. {{ $penjadwalan->pembimbingdua->nama }}</span>
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto gridratakiri">
                            <div class="fw-bold ">Penguji</div>
                            <span>1. {{ $penjadwalan->pengujisatu->nama }}</span>
                            <br>
                            <span>2. {{ $penjadwalan->pengujidua->nama }}</span>
                            <br>
                            @if ($sempro->pengujitiga == !null)
                                <span>3. {{ $penjadwalan->pengujitiga->nama }}</span>
                            @endif
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
                            <span>{{ $penjadwalan->revisi_proposal != null ? $penjadwalan->revisi_proposal : $penjadwalan->judul_proposal }}</span>
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
            <div class="col-md ">
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
            <div class="col-lg-6">
                <table class="table table-bordered table-responsive-lg">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 200px">Penilaian Penguji</th>
                            <th class="bg-success text-center" style="width: 30px">B</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th>Penguji 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Presentasi</td>
                            <td class="bg-secondary text-center">2</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->presentasi }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->presentasi }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->presentasi }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Tingkat Penguasaan Materi</td>
                            <td class="bg-secondary text-center">3</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->tingkat_penguasaan_materi }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->tingkat_penguasaan_materi }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->tingkat_penguasaan_materi }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Keaslian</td>
                            <td class="bg-secondary text-center">2</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->keaslian }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->keaslian }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->keaslian }}</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Ketepatan Metodologi</td>
                            <td class="bg-secondary text-center">4</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->ketepatan_metodologi }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->ketepatan_metodologi }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->ketepatan_metodologi }}</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Penguasaan Dasar Teori</td>
                            <td class="bg-secondary text-center">4</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->penguasaan_dasar_teori }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->penguasaan_dasar_teori }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->penguasaan_dasar_teori }}</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Kecermatan Perumusan Masalah</td>
                            <td class="bg-secondary text-center">3</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->kecermatan_perumusan_masalah }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->kecermatan_perumusan_masalah }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->kecermatan_perumusan_masalah }}</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Tinjauan Pustaka</td>
                            <td class="bg-secondary text-center">3</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->tinjauan_pustaka }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->tinjauan_pustaka }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->tinjauan_pustaka }}</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Tata Tulis</td>
                            <td class="bg-secondary text-center">2</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->tata_tulis }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->tata_tulis }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->tata_tulis }}</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya</td>
                            <td class="bg-secondary text-center">3</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->sumbangan_pemikiran }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->sumbangan_pemikiran }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->sumbangan_pemikiran }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Total Nilai Penguji</td>
                            <td class="bg-success text-center">45</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->total_nilai_angka }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->total_nilai_angka }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->total_nilai_angka }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Nilai Huruf Penguji</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji1->total_nilai_huruf }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji2->total_nilai_huruf }}</td>
                            <td class="nilai1 text-center">{{ $nilaipenguji3->total_nilai_huruf }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Rata Rata Nilai Penguji</td>
                            <td class="text-center" colspan="3">
                                <h3 class="text-bold">
                                    {{ round(($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) }}
                                </h3>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-6">
                <table class="table table-bordered table-responsive-lg">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 200px">Penilaian Pembimbing</th>
                            <th class="bg-success text-center">B</th>
                            <th class="pb text-center">Pembimbing 1</th>
                            <th class="pb text-center">Pembimbing 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Penguasaan Dasar Teori</td>
                            <td class="bg-secondary text-center">10</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->penguasaan_dasar_teori }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->penguasaan_dasar_teori }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->penguasaan_dasar_teori }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Tingkat Penguasaan Materi</td>
                            <td class="bg-secondary text-center">10</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->tingkat_penguasaan_materi }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->tingkat_penguasaan_materi }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->tingkat_penguasaan_materi }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Tinjauan Pustaka</td>
                            <td class="bg-secondary text-center">9</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->tinjauan_pustaka }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->tinjauan_pustaka }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->tinjauan_pustaka }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Tata Tulis</td>
                            <td class="bg-secondary text-center">8</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->tata_tulis }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->tata_tulis }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->tata_tulis }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                            <td class="bg-secondary text-center">8</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->sikap_dan_kepribadian }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->sikap_dan_kepribadian }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->sikap_dan_kepribadian }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>

                        <tr>
                            <td colspan="2">Total Nilai Pembimbing</td>
                            <td class="bg-success text-center">55</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->total_nilai_angka }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->total_nilai_angka }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->total_nilai_angka }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>
                        <tr>
                            <td colspan="3">Nilai Huruf Pembimbing</td>
                            @if ($pembimbing->count() > 1)
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->total_nilai_huruf }}</td>
                                <td class="nilai1 text-center">{{ $nilaipembimbing2->total_nilai_huruf }}</td>
                            @else
                                <td class="nilai1 text-center">{{ $nilaipembimbing1->total_nilai_huruf }}</td>
                                <td class="nilai1 text-center">-</td>
                            @endif
                        </tr>
                        <tr>
                            <td colspan="3">Rata Rata Nilai Pembimbing</td>
                            <td class="text-center" colspan="2">
                                <h3 class="text-bold">
                                    @if ($pembimbing->count() > 1)
                                        {{ ($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 }}
                                    @else
                                        {{ $nilaipembimbing1->total_nilai_angka }}
                                    @endif
                                </h3>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 250px">NILAI AKHIR</td>
                            <td class="bg-success text-center">
                                <h3 class="text-bold">
                                    @if ($pembimbing->count() > 1)
                                        {{ round((($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 + ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) / 2) }}
                                    @else
                                        {{ round(($nilaipembimbing1->total_nilai_angka + ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) / 3) / 2, 0, PHP_ROUND_HALF_ODD) }}
                                    @endif
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px">NILAI HURUF</td>
                            <td class="bg-success text-center">
                                <h3 class="text-bold">
                                    @if ($pembimbing->count() > 1)
                                        @if (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                85)
                                            A
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                80)
                                            A-
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                75)
                                            B+
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                70)
                                            B
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                65)
                                            B-
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                60)
                                            C+
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                55)
                                            C
                                        @elseif (
                                            (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                40)
                                            D
                                        @else
                                            E
                                        @endif
                                    @else
                                        @if (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                85)
                                            A
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                80)
                                            A-
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                75)
                                            B+
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                70)
                                            B
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                65)
                                            B-
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                60)
                                            C+
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                55)
                                            C
                                        @elseif (
                                            ($nilaipembimbing1->total_nilai_angka +
                                                ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                    3) /
                                                2 >=
                                                40)
                                            D
                                        @else
                                            E
                                        @endif
                                    @endif
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 250px">KETERANGAN</td>

                            <td class="bg-success text-center">
                                <h3 class="text-bold">
                                    @if ($penjadwalan->pembimbingdua_nip == null)
                                        @if ($nilaipembimbing1 == '')
                                            -
                                        @else
                                            @if ($nilaipenguji1 == '' || $nilaipenguji2 == '' || $nilaipenguji3 == '')
                                                -
                                            @else
                                                @if (
                                                    ($nilaipembimbing1->total_nilai_angka +
                                                        ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                            3) /
                                                        2 >=
                                                        60)
                                                    LULUS
                                                @else
                                                    TIDAK LULUS
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        @if ($nilaipembimbing1 != '' && $nilaipembimbing2 != '')
                                            @if ($nilaipenguji1 == '' || $nilaipenguji2 == '' || $nilaipenguji3 == '')
                                                -
                                            @else
                                                @if (
                                                    (($nilaipembimbing1->total_nilai_angka + $nilaipembimbing2->total_nilai_angka) / 2 +
                                                        ($nilaipenguji1->total_nilai_angka + $nilaipenguji2->total_nilai_angka + $nilaipenguji3->total_nilai_angka) /
                                                            3) /
                                                        2 >=
                                                        60)
                                                    LULUS
                                                @else
                                                    TIDAK LULUS
                                                @endif
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @endif
                                </h3>
                            </td>
                        </tr>
                    </tbody>
                </table>

                @if ($penjadwalan->status_seminar == 0)
                    <form action="/penilaian-sempro/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-lg btn-danger float-right"> Selesai Seminar</button>
                    </form>
                @endif

                @if ($penjadwalan->status_seminar == 1)
                    <form action="/persetujuansempro-koordinator/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-success float-right border-0 ml-3">Setujui</button>
                    </form>
                    <form action="/persetujuansempro-koordinator/tolak/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-danger float-right border-0">Tolak</button>
                    </form>
                @endif

                @if ($penjadwalan->status_seminar == 2)
                    <form action="/persetujuansempro-kaprodi/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-lg btn-success float-right border-0 ml-3">Setujui</button>
                    </form>
                    <form action="/persetujuansempro-kaprodi/tolak/{{ $penjadwalan->id }}" method="POST">
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
