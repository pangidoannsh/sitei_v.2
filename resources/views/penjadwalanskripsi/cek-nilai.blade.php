@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Berita Acara Sidang | SIA ELEKTRO
@endsection

@section('sub-title')
    Berita Acara Sidang Skripsi
@endsection

@section('content')
    <div class="container pb-3">
        <a href="/persetujuan-kp-skripsi" class="bg-success p-2 rounded-2"><i class="fas fa-arrow-left fa-xs"></i> Kembali</a>
    </div>

    <div class="container ">
        <div class="row shadow-sm rounded">
            <div class="bg-white col-lg-4 col-md-12 px-4 py-3 mb-2 rounded-start">
                <h5 class="text-bold">Mahasiswa</h5>
                <hr>
                <p class="card-title text-secondary text-sm ">Nama</p>
                <p class="card-text text-start">{{ $penjadwalan->mahasiswa->nama }}</p>
                <p class="card-title text-secondary text-sm ">NIM</p>
                <p class="card-text text-start">{{ $penjadwalan->mahasiswa->nim }}</p>
                <p class="card-title text-secondary text-sm ">Program Studi</p>
                <p class="card-text text-start">{{ $penjadwalan->mahasiswa->prodi->nama_prodi }}</p>
                <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                <p class="card-text text-start">{{ $penjadwalan->mahasiswa->konsentrasi->nama_konsentrasi }}</p>
            </div>
            <div class="bg-white col-lg-4 col-md-12 px-4 py-3 mb-2">
                <h5 class="text-bold">Dosen Pembimbing</h5>
                <hr>
                @if ($penjadwalan->pembimbingdua == null)
                    <p class="card-title text-secondary text-sm">Nama</p>
                    <p class="card-text text-start">{{ $penjadwalan->pembimbingsatu->nama }}</p>
                @elseif($penjadwalan->pembimbingdua !== null)
                    <p class="card-title text-secondary text-sm">Nama Pembimbing 1</p>
                    <p class="card-text text-start">{{ $penjadwalan->pembimbingsatu->nama }}</p>

                    <p class="card-title text-secondary text-sm">Nama Pembimbing 2</p>
                    <p class="card-text text-start">{{ $penjadwalan->pembimbingdua->nama }}</p>
                @endif
            </div>
            <div class="bg-white col-lg-4 col-md-12 px-4 py-3 mb-2 rounded-end">
                <h5 class="text-bold">Dosen Penguji</h5>
                <hr>
                @if ($penjadwalan->pengujitiga == null)
                    <p class="card-title text-secondary text-sm">Nama Penguji 1</p>
                    <p class="card-text text-start">{{ $penjadwalan->pengujisatu->nama }}</p>
                    <p class="card-title text-secondary text-sm">Nama Penguji 2</p>
                    <p class="card-text text-start">{{ $penjadwalan->pengujidua->nama }}</p>
                @elseif($penjadwalan->pengujitiga !== null)
                    <p class="card-title text-secondary text-sm">Nama Penguji 1</p>
                    <p class="card-text text-start">{{ $penjadwalan->pengujisatu->nama }}</p>
                    <p class="card-title text-secondary text-sm">Nama Penguji 2</p>
                    <p class="card-text text-start">{{ $penjadwalan->pengujidua->nama }}</p>
                    <p class="card-title text-secondary text-sm">Nama Penguji 3</p>
                    <p class="card-text text-start">{{ $penjadwalan->pengujitiga->nama }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row rounded shadow-sm">
            <div class="bg-white col-lg-6 col-md-12 px-4 py-3 mb-2 rounded-start">
                <h5 class="text-bold">Judul Skripsi</h5>
                <hr>
                <p class="card-title text-secondary text-sm ">Judul</p>
                <p class="card-text text-start">
                    {{ $penjadwalan->revisi_skripsi != null ? $penjadwalan->revisi_skripsi : $penjadwalan->judul_skripsi }}
                </p>
            </div>
            <div class="bg-white col-lg-6 col-md-12 px-4 py-3 mb-2 rounded-end">
                <h5 class="text-bold">Jadwal Seminar</h5>
                <hr>
                <p class="card-title text-secondary text-sm ">Hari/Tanggal</p>
                <p class="card-text text-start">{{ Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y') }}, :
                    {{ $penjadwalan->waktu }}</p>
                <p class="card-title text-secondary text-sm ">Pukul</p>
                <p class="card-text text-start">{{ $penjadwalan->waktu }}</p>
                <p class="card-title text-secondary text-sm ">Lokasi</p>
                <p class="card-text text-start">{{ $penjadwalan->lokasi }}</p>
            </div>
        </div>
    </div>


    <div class="card-body mb-3 bg-white rounded-3 shadow-sm">
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-bordered table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 200px">Penilaian Penguji</th>
                                        <!-- <th class="bg-success text-center">B</th> -->
                                        <th class="text-center">Penguji 1</th>
                                        <th class="text-center">Penguji 2</th>
                                        <th class="text-center">Penguji 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Presentasi</td>
                                        <!-- <td class="bg-secondary text-center">2</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->presentasi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->presentasi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->presentasi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Tingkat Penguasaan Materi</td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->tingkat_penguasaan_materi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->tingkat_penguasaan_materi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->tingkat_penguasaan_materi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Keaslian</td>
                                        <!-- <td class="bg-secondary text-center">2</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->keaslian !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->keaslian !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->keaslian !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Ketepatan Metodologi</td>
                                        <!-- <td class="bg-secondary text-center">4</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->ketepatan_metodologi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->ketepatan_metodologi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->ketepatan_metodologi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Penguasaan Dasar Teori</td>
                                        <!-- <td class="bg-secondary text-center">4</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->penguasaan_dasar_teori !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->penguasaan_dasar_teori !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->penguasaan_dasar_teori !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Kecermatan Perumusan Masalah</td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                           @if ($nilaipenguji1 != '' && $nilaipenguji1->kecermatan_perumusan_masalah !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->kecermatan_perumusan_masalah !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->kecermatan_perumusan_masalah !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Tinjauan Pustaka</td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->tinjauan_pustaka !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                             @if ($nilaipenguji2 != '' && $nilaipenguji2->tinjauan_pustaka !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                             @if ($nilaipenguji3 != '' && $nilaipenguji3->tinjauan_pustaka !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Tata Tulis</td>
                                        <!-- <td class="bg-secondary text-center">2</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->tata_tulis !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->tata_tulis !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->tata_tulis !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Tools Yang Digunakan</td>
                                        <!-- <td class="bg-secondary text-center">2</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->tools !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->tools !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->tools !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Penyajian Data</td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->penyajian_data !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->penyajian_data !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->penyajian_data !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Hasil</td>
                                        <!-- <td class="bg-secondary text-center">4</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->hasil !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->hasil !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->hasil !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Pembahasan</td>
                                        <!-- <td class="bg-secondary text-center">4</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->pembahasan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji2 != '' && $nilaipenguji2->pembahasan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->pembahasan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Kesimpulan</td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                            @if ($nilaipenguji1 != '' && $nilaipenguji1->kesimpulan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                           @if ($nilaipenguji2 != '' && $nilaipenguji2->kesimpulan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($nilaipenguji3 != '' && $nilaipenguji3->kesimpulan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Luaran</td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                             @if ($nilaipenguji1 != '' && $nilaipenguji1->luaran !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                             @if ($nilaipenguji2 != '' && $nilaipenguji2->luaran !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                             @if ($nilaipenguji3 != '' && $nilaipenguji3->luaran !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Sumbangan Pemikiran Terhadap Ilmu Pengetahuan dan Penerapannya
                                        </td>
                                        <!-- <td class="bg-secondary text-center">3</td> -->
                                        <td class="text-center">
                                             @if ($nilaipenguji1 != '' && $nilaipenguji1->sumbangan_pemikiran !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                             @if ($nilaipenguji2 != '' && $nilaipenguji2->sumbangan_pemikiran !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                             @if ($nilaipenguji3 != '' && $nilaipenguji3->sumbangan_pemikiran !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
        </tbody>
        </table>
            </div>

            <div class="col-lg-6">
                <table class="table table-bordered table-responsive-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 200px">Penilaian Pembimbing</th>
                        <!-- <th class="bg-success text-center">B</th> -->
                        <th class="text-center">Pembimbing 1</th>
                        <th class="text-center">Pembimbing 2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Penguasaan Dasar Teori</td>
                        <!-- <td class="bg-secondary text-center">10</td> -->
                        <td class="text-center">
                             @if ($nilaipembimbing1 != '' && $nilaipembimbing1->penguasaan_dasar_teori !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                        <td class="text-center">
                            @if ($nilaipembimbing2 != '' && $nilaipembimbing2->penguasaan_dasar_teori !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Tingkat Penguasaan Materi</td>
                        <!-- <td class="bg-secondary text-center">10</td> -->
                        <td class="text-center">
                            @if ($nilaipembimbing1 != '' && $nilaipembimbing1->tingkat_penguasaan_materi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                        <td class="text-center">
                             @if ($nilaipembimbing2 != '' && $nilaipembimbing2->tingkat_penguasaan_materi !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tinjauan Pustaka</td>
                        <!-- <td class="bg-secondary text-center">9</td> -->
                        <td class="text-center">
                             @if ($nilaipembimbing1 != '' && $nilaipembimbing1->tinjauan_pustaka !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                        <td class="text-center">
                            @if ($nilaipembimbing2 != '' && $nilaipembimbing2->tinjauan_pustaka !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Tata Tulis</td>
                        <!-- <td class="bg-secondary text-center">8</td> -->
                        <td class="text-center">
                            @if ($nilaipembimbing1 != '' && $nilaipembimbing1->tata_tulis !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                        <td class="text-center">
                            @if ($nilaipembimbing2 != '' && $nilaipembimbing2->tata_tulis !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Hasil dan Pembahasan</td>
                        <!-- <td class="bg-secondary text-center">10</td> -->
                        <td class="text-center">
                            @if ($nilaipembimbing1 != '' && $nilaipembimbing1->hasil_dan_pembahasan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                        <td class="text-center">
                            @if ($nilaipembimbing2 != '' && $nilaipembimbing2->hasil_dan_pembahasan !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Sikap dan Kepribadian Ketika Bimbingan</td>
                        <!-- <td class="bg-secondary text-center">8</td> -->
                        <td class="text-center">
                            @if ($nilaipembimbing1 != '' && $nilaipembimbing1->sikap_dan_kepribadian !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                        <td class="text-center">
                            @if ($nilaipembimbing2 != '' && $nilaipembimbing2->sikap_dan_kepribadian !== null)
                                                <i class="fas fa-check fa-lg "></i>
                                            @else
                                                -
                                            @endif
                        </td>
                    </tr>


                </tbody>
            </table>

            <table class="table table-bordered table-responsive-md">
                <tbody>
                    @if($jurnal == null)
                    <tr>
                        <td style="width: 250px">NILAI AKHIR</td>
                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                                @if (
                                    $nilaipenguji1 == '' &&
                                        $nilaipenguji2 == '' &&
                                        $nilaipenguji3 == '' &&
                                        $nilaipembimbing1 == '' &&
                                        $nilaipembimbing2 == '')
                                    -
                                @else
                                    <?php
                                    $nilai_masuk = 0;
                                    if (!empty($nilaipenguji1)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $penguji1 = $nilaipenguji1->total_nilai_angka;
                                    } else {
                                        $penguji1 = 0;
                                    }
                                    if (!empty($nilaipenguji2)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $penguji2 = $nilaipenguji2->total_nilai_angka;
                                    } else {
                                        $penguji2 = 0;
                                    }
                                    if (!empty($nilaipenguji3)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $penguji3 = $nilaipenguji3->total_nilai_angka;
                                    } else {
                                        $penguji3 = 0;
                                    }
                                    $nilaitotalpenguji = round(($penguji1 + $penguji2 + $penguji3) / $nilai_masuk);
                                    $nilai_masuk = 0;
                                    
                                    if (!empty($nilaipembimbing1)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $pembimbing1 = $nilaipembimbing1->total_nilai_angka;
                                    } else {
                                        $pembimbing1 = 0;
                                    }
                                    if (!empty($nilaipembimbing2)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $pembimbing2 = $nilaipembimbing2->total_nilai_angka;
                                    } else {
                                        $pembimbing2 = 0;
                                    }
                                    if ($nilai_masuk == 0) {
                                        $nilai_masuk = 1;
                                    }
                                    $nilaitotalpembimbing = round(($pembimbing1 + $pembimbing2) / $nilai_masuk);
                                    $nilai_masuk_akhir = 0;
                                    if ($nilaitotalpenguji != 0) {
                                        $nilai_masuk_akhir = $nilai_masuk_akhir + 1;
                                        $penguji = $nilaitotalpenguji;
                                    } else {
                                        $penguji = 0;
                                    }
                                    if ($nilaitotalpembimbing != 0) {
                                        $nilai_masuk_akhir = $nilai_masuk_akhir + 1;
                                        $pembimbing = $nilaitotalpembimbing;
                                    } else {
                                        $pembimbing = 0;
                                    }
                                    $total_nilai = $penguji + $pembimbing;
                                    ?>
                                    {{ $total_nilai }}
                                @endif

                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 250px">NILAI HURUF</td>

                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                                @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                                    -
                                @else
                                    @if ($total_nilai >= 85)
                                        A
                                    @elseif ($total_nilai >= 80)
                                        A-
                                    @elseif ($total_nilai >= 75)
                                        B+
                                    @elseif ($total_nilai >= 70)
                                        B
                                    @elseif ($total_nilai >= 65)
                                        B-
                                    @elseif ($total_nilai >= 60)
                                        C+
                                    @elseif ($total_nilai >= 55)
                                        C
                                    @elseif ($total_nilai >= 40)
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
                                @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                                    -
                                @else
                                    @if ($total_nilai >= 60)
                                        LULUS
                                    @else
                                        TIDAK LULUS
                                    @endif
                                @endif
                            </h3>
                        </td>
                    </tr>
                    @endif

                    @if($jurnal !== null)
                    <tr>
                        <td style="width: 250px">NILAI SEMENTARA</td>
                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                                @if (
                                    $nilaipenguji1 == '' &&
                                        $nilaipenguji2 == '' &&
                                        $nilaipenguji3 == '' &&
                                        $nilaipembimbing1 == '' &&
                                        $nilaipembimbing2 == '')
                                    -
                                @else
                                    <?php
                                    $nilai_masuk = 0;
                                    if (!empty($nilaipenguji1)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $penguji1 = $nilaipenguji1->total_nilai_angka;
                                    } else {
                                        $penguji1 = 0;
                                    }
                                    if (!empty($nilaipenguji2)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $penguji2 = $nilaipenguji2->total_nilai_angka;
                                    } else {
                                        $penguji2 = 0;
                                    }
                                    if (!empty($nilaipenguji3)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $penguji3 = $nilaipenguji3->total_nilai_angka;
                                    } else {
                                        $penguji3 = 0;
                                    }
                                    $nilaitotalpenguji = round(($penguji1 + $penguji2 + $penguji3) / $nilai_masuk);
                                    $nilai_masuk = 0;
                                    
                                    if (!empty($nilaipembimbing1)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $pembimbing1 = $nilaipembimbing1->total_nilai_angka;
                                    } else {
                                        $pembimbing1 = 0;
                                    }
                                    if (!empty($nilaipembimbing2)) {
                                        $nilai_masuk = $nilai_masuk + 1;
                                        $pembimbing2 = $nilaipembimbing2->total_nilai_angka;
                                    } else {
                                        $pembimbing2 = 0;
                                    }
                                    if ($nilai_masuk == 0) {
                                        $nilai_masuk = 1;
                                    }
                                    $nilaitotalpembimbing = round(($pembimbing1 + $pembimbing2) / $nilai_masuk);
                                    $nilai_masuk_akhir = 0;
                                    if ($nilaitotalpenguji != 0) {
                                        $nilai_masuk_akhir = $nilai_masuk_akhir + 1;
                                        $penguji = $nilaitotalpenguji;
                                    } else {
                                        $penguji = 0;
                                    }
                                    if ($nilaitotalpembimbing != 0) {
                                        $nilai_masuk_akhir = $nilai_masuk_akhir + 1;
                                        $pembimbing = $nilaitotalpembimbing;
                                    } else {
                                        $pembimbing = 0;
                                    }
                                    $total_nilai = $penguji + $pembimbing;
                                    ?>
                                    {{ $total_nilai }}
                                @endif

                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 250px">NILAI HURUF SEMENTARA</td>

                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                                @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                                    -
                                @else
                                    @if ($total_nilai >= 85)
                                        A
                                    @elseif ($total_nilai >= 80)
                                        A-
                                    @elseif ($total_nilai >= 75)
                                        B+
                                    @elseif ($total_nilai >= 70)
                                        B
                                    @elseif ($total_nilai >= 65)
                                        B-
                                    @elseif ($total_nilai >= 60)
                                        C+
                                    @elseif ($total_nilai >= 55)
                                        C
                                    @elseif ($total_nilai >= 40)
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
                                @if ($nilaitotalpenguji == '' && $nilaitotalpembimbing == '')
                                    -
                                @else
                                    @if ($total_nilai >= 60)
                                        LULUS
                                    @else
                                        TIDAK LULUS
                                    @endif
                                @endif
                            </h3>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 250px">NILAI JURNAL</td>

                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                                        {{ $jurnal->nilai }}
                            </h3>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="width: 250px">NILAI AKHIR</td>

                        <td class="bg-success text-center">
                            <h3 class="text-bold">
                                    @if ($total_nilai + $jurnal->nilai > 99)
                                        100
                                    @else
                                        {{ $jurnal->nilai + $total_nilai}}
                                    @endif
                            </h3>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="width: 250px">NILAI HURUF AKHIR</td>

                        <td class="bg-success text-center">
                            <h3 class="text-bold">

                                     @if ($total_nilai + $jurnal->nilai >= 85)
                                        A
                                    @elseif ($total_nilai + $jurnal->nilai >= 80)
                                        A-
                                    @elseif ($total_nilai + $jurnal->nilai >= 75)
                                        B+
                                    @elseif ($total_nilai + $jurnal->nilai >= 70)
                                        B
                                    @elseif ($total_nilai + $jurnal->nilai >= 65)
                                        B-
                                    @elseif ($total_nilai + $jurnal->nilai >= 60)
                                        C+
                                    @elseif ($total_nilai + $jurnal->nilai >= 55)
                                        C
                                    @elseif ($total_nilai + $jurnal->nilai >= 40)
                                        D
                                    @else
                                        E
                                    @endif
                            </h3>
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>


                @if ($penjadwalan->pengujitiga == Auth::user()->nip)
                    @if ($penjadwalan->status_seminar == 0)
                        <form action="/penilaian-skripsi/approve/{{ $penjadwalan->id }}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-lg btn-danger float-right"> Selesai Sidang</button>
                        </form>
                    @endif
                @endif

                @if (Str::length(Auth::guard('dosen')->user()) > 0)
                    @if (Auth::guard('dosen')->user()->role_id == 9 ||
                            Auth::guard('dosen')->user()->role_id == 10 ||
                            Auth::guard('dosen')->user()->role_id == 11)
                        @if ($penjadwalan->status_seminar == 1)
                            <a href="#ModalApproveKPTA" data-toggle="modal"
                                class="btn-lg btn-success float-right border-0 ml-3 mt-5">Setujui</a>
                            <a href="#ModalTolakKPTA" data-toggle="modal"
                                class="btn-lg btn-danger float-right border-0 mt-5">Tolak</a>
                        @endif
                    @endif
                @endif

                @if (Str::length(Auth::guard('dosen')->user()) > 0)
                    @if (Auth::guard('dosen')->user()->role_id == 6 ||
                            Auth::guard('dosen')->user()->role_id == 7 ||
                            Auth::guard('dosen')->user()->role_id == 8)
                        @if ($penjadwalan->status_seminar == 2)
                            <a href="#ModalApproveKoprodi" data-toggle="modal"
                                class="btn-lg btn-success float-right border-0 ml-3 mt-5">Setujui</a>
                            <a href="#ModalTolakKoprodi" data-toggle="modal"
                                class="btn-lg btn-danger float-right border-0 mt-5">Tolak</a>
                        @endif
                    @endif
                @endif

            </div>

        </div>
        <div class="modal fade"id="ModalApproveKPTA">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- <div class="modal-header">
            <h5 class="modal-title">Apakah Anda Yakin?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
                    <div class="modal-body">
                        <div class="container text-center px-5 pt-5 pb-3">
                            <h4>Apakah Anda Yakin?</h4>
                            <p>Data Tidak Bisa Dikembalikan!</p>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-3"><button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tidak</button></div>
                                <div class="col-3">
                                    <form action="/persetujuanskripsi-koordinator/approve/{{ $penjadwalan->id }}"
                                        method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                </div>
                                <div class="col-3"></div>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <form action="/persetujuanskripsi-koordinator/approve/{{ $penjadwalan->id }}" method="POST">
                @method('put')
                @csrf
                <button type="submit" class="btn btn-success">Setujui</button>
            </form>
          </div> -->
                </div>
            </div>
        </div>

        <div class="modal fade"id="ModalTolakKPTA">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- <div class="modal-header">
            <h5 class="modal-title">Apakah Anda Yakin?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
                    <div class="modal-body">
                        <div class="container text-center px-5 pt-5 pb-3">
                            <h4>Apakah Anda Yakin?</h4>
                            <p>Data Akan Dikembalikan Kepada Ketua Penguji!</p>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-3"><button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tidak</button></div>
                                <div class="col-3">
                                    <form action="/persetujuanskripsi-koordinator/tolak/{{ $penjadwalan->id }}"
                                        method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </form>
                                </div>
                                <div class="col-3"></div>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <form action="/persetujuanskripsi-koordinator/tolak/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
          </div> -->
                </div>
            </div>
        </div>

        <div class="modal fade"id="ModalApproveKoprodi">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- <div class="modal-header">
            <h5 class="modal-title">Apakah Anda Yakin?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
                    <div class="modal-body">
                        <div class="container text-center px-5 pt-5 pb-3">
                            <h4>Apakah Anda Yakin?</h4>
                            <p>Data Tidak Bisa Dikembalikan!</p>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-3"><button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tidak</button></div>
                                <div class="col-3">
                                    <form action="/persetujuanskripsi-kaprodi/approve/{{ $penjadwalan->id }}"
                                        method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                </div>
                                <div class="col-3"></div>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <form action="/persetujuanskripsi-kaprodi/approve/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
            </form>
          </div> -->
                </div>
            </div>
        </div>

        <div class="modal fade"id="ModalTolakKoprodi">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- <div class="modal-header">
            <h5 class="modal-title">Apakah Anda Yakin?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
                    <div class="modal-body">
                        <div class="container text-center px-5 pt-5 pb-3">
                            <h4>Apakah Anda Yakin?</h4>
                            <p>Data Akan Dikembalikan Kepada Ketua Penguji!</p>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-3"><button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tidak</button></div>
                                <div class="col-3">
                                    <form action="/persetujuanskripsi-kaprodi/tolak/{{ $penjadwalan->id }}"
                                        method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </form>
                                </div>
                                <div class="col-3"></div>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <form action="/persetujuanskripsi-kaprodi/tolak/{{ $penjadwalan->id }}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-danger">Tolak</button>
            </form>
            </form>
          </div> -->
                </div>
            </div>
        </div>

        <!-- footer -->
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
                        target="_blank" href="/developer/fahril-hadi">Fahril Hadi, </a>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                        href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                        class="text-success fw-bold">&</span>
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">
                        M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection
