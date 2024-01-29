@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('header')
    SITEI | Edit Penilaian Sidang Skripsi
@endsection

@section('sub-title')
    Edit Penilaian Sidang Skripsi
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <div class="container">
        <a href="/kp-skripsi/seminar-pembimbing-penguji" class="btn btn-success py-1 px-2 mb-3"> <i
                class="fas fa-arrow-left fa-xs"></i> Kembali <a>
    </div>

    <div class="container">
        <div class="row shadow-sm rounded">
            <div class="col-lg-4 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                <h5 class="text-bold">Mahasiswa</h5>
                <hr>
                <p class="card-title text-secondary text-sm ">Nama</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->mahasiswa->nama }}</p>
                <p class="card-title text-secondary text-sm ">NIM</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->mahasiswa->nim }}</p>
                <p class="card-title text-secondary text-sm ">Program Studi</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->mahasiswa->prodi->nama_prodi }}</p>
                <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                <p class="card-text text-start">
                    {{ $skripsi->penjadwalan_skripsi->mahasiswa->konsentrasi->nama_konsentrasi }}</p>
            </div>
            <div class="col-lg-4 col-md-12 px-4 py-3 mb-2 bg-white ">
                <h5 class="text-bold">Dosen Pembimbing</h5>
                <hr>
                @if ($skripsi->penjadwalan_skripsi->pembimbingdua_nip == null)
                    <p class="card-title text-secondary text-sm">Nama</p>
                    <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->pembimbingsatu->nama }}</p>
                @elseif($skripsi->penjadwalan_skripsi->pembimbingdua_nip !== null)
                    <p class="card-title text-secondary text-sm">Nama Pembimbing 1</p>
                    <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->pembimbingsatu->nama }}</p>

                    <p class="card-title text-secondary text-sm">Nama Pembimbing 2</p>
                    <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->pembimbingdua->nama }}</p>
                @endif
            </div>
            <div class="col-lg-4 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                <h5 class="text-bold">Dosen Penguji</h5>
                <hr>

                <p class="card-title text-secondary text-sm">Nama Penguji 1</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->pengujisatu->nama }}</p>



                <p class="card-title text-secondary text-sm">Nama Penguji 2</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->pengujidua->nama }}</p>
                @if ($skripsi->penjadwalan_skripsi->pengujitiga == !null)
                    <p class="card-title text-secondary text-sm">Nama Penguji 3</p>
                    <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->pengujitiga->nama }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row shadow-sm rounded">
            <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                <h5 class="text-bold">Judul Skripsi</h5>
                <hr>

                <p class="card-title text-secondary text-sm">Judul</p>
                <p class="card-text text-start">
                    {{ $skripsi->penjadwalan_skripsi->revisi_skripsi != null ? $skripsi->penjadwalan_skripsi->revisi_skripsi : $skripsi->penjadwalan_skripsi->judul_skripsi }}
                </p>

                <p class="card-title text-secondary text-sm">Naskah</p>
                <p class="card-text  text-start"><a formtarget="_blank" target="_blank"
                        href="{{ asset('storage/' . $naskah->naskah) }}" class="badge bg-dark px-3 py-2">Buka</a></p>
                @if (auth()->user()->nip == $skripsi->pembimbingsatu_nip || auth()->user()->nip == $skripsi->pembimbingdua_nip)
                @if($jurnal != null)
               <p class="card-title text-secondary text-sm">File Jurnal/Artikel</p>
                        <p class="card-text  text-start mb-2"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $jurnal->file_jurnal) }}" class="badge bg-dark px-3 py-2">Buka</a></p>
                @endif
                @endif
                
            </div>
            <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                <h5 class="text-bold">Jadwal Sidang Skripsi</h5>
                <hr>

                <p class="card-title text-secondary text-sm">Hari/Tanggal</p>
                <p class="card-text text-start">
                    {{ Carbon::parse($skripsi->penjadwalan_skripsi->tanggal)->translatedFormat('l, d F Y') }}</p>
                <p class="card-title text-secondary text-sm">Pukul</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->waktu }}</p>
                <p class="card-title text-secondary text-sm">Lokasi</p>
                <p class="card-text text-start">{{ $skripsi->penjadwalan_skripsi->lokasi }}</p>
            </div>
        </div>
    </div>
    @if (auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujisatu_nip ||
            auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujidua_nip ||
            auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujitiga_nip)
        <div class="container">
            <div class="row rounded shadow-sm">
                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                    <h5 class="text-bold">Perbaikan Penguji (Sempro)</h5>
                    <hr>
                    <p class="card-title text-secondary text-sm ">Perbaikan Penguji 1</p>
                    <p class="card-text  text-start"><a formtarget="_blank" target="_blank"
                            href="/perbaikan-pengujisempro/{{ Crypt::encryptString($penjadwalan_sempro_id) }}/{{ $sempro->pengujisatu->nip }}"
                            class="badge bg-dark px-3 py-2">Buka</a></p>
                    <p class="card-title text-secondary text-sm ">Perbaikan Penguji 2</p>
                    <p class="card-text  text-start"><a formtarget="_blank" target="_blank"
                            href="/perbaikan-pengujisempro/{{ Crypt::encryptString($penjadwalan_sempro_id) }}/{{ $sempro->pengujidua->nip }}"
                            class="badge bg-dark px-3 py-2">Buka</a></p>
                    @if ($sempro->pengujitiga == !null)
                        <p class="card-title text-secondary text-sm ">Perbaikan Penguji 3</p>
                        <p class="card-text  text-start"><a formtarget="_blank" target="_blank"
                                href="/perbaikan-pengujisempro/{{ Crypt::encryptString($penjadwalan_sempro_id) }}/{{ $sempro->pengujitiga->nip }}"
                                class="badge bg-dark px-3 py-2">Buka</a></p>
                    @endif



                </div>
                <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                    <h5 class="text-bold">Publikasi Jurnal</h5>
                    <hr>

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                        @if($jurnal != null)
                        <p class="card-title text-secondary text-sm">Indeksasi Jurnal</p>
                        <p class="card-text text-start">{{ $jurnal->indeksasi_jurnal }}</p>
                        <p class="card-title text-secondary text-sm">Judul Jurnal</p>
                        <p class="card-text text-start">{{ $jurnal->judul_jurnal }}</p>
                        <p class="card-title text-secondary text-sm">File Jurnal/Artikel</p>
                        <p class="card-text  text-start mb-2"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $jurnal->file_jurnal) }}" class="badge bg-dark px-3 py-2">Buka</a></p>
                        @else
                        <p class="card-title text-secondary text-sm">Indeksasi Jurnal</p>
                        <p class="card-text text-start">Tanpa Jurnal</p>
                        @endif
                        </div>
                        <div class="col-lg-6 col-md-12">
                         @if($jurnal != null)
                        <p class="card-title text-secondary text-sm">Status Publikasi Jurnal</p>
                        <p class="card-text text-start">{{ $jurnal->status_publikasi_jurnal }}</p>
                        <p class="card-title text-secondary text-sm">URL Jurnal</p>
                        <p class="card-text text-start"><a class="text-dark" formtarget="_blank" target="_blank"
                                    href="https://{{ $jurnal->link_jurnal ?? '' }}">{{ $jurnal->link_jurnal }} <i class="fas fa-external-link-alt"></i></a> </p>
                        @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif


    @if (auth()->user()->nip == $skripsi->penjadwalan_skripsi->pembimbingsatu_nip ||
            auth()->user()->nip == $skripsi->penjadwalan_skripsi->pembimbingdua_nip)
        <div class="card card-success card-tabs">
            <div class="card-header p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                            href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                            aria-selected="true">Form Nilai</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">
                        <form action="/penilaian-skripsi-pembimbing/edit/{{ $skripsi->id }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="mb-3 gridratakiri">
                                <label for="penguasaan_dasar_teori" class="col-form-label">1). Penguasaan Dasar
                                    Teori</label>
                                <div class="radio1 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center  justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai = ($i / 10) * 10;
    @endphp

                  <input type="radio" class="btn-check d-flex flex-row @error('penguasaan_dasar_teori') is-invalid @enderror" name="penguasaan_dasar_teori" id="tombol_bulat_{{ $i }}" value="{{ $nilai }}" onclick="setBulatValue({{ $nilai }})" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == $nilai ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
             <br> -->

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori1" value="2"
                                        onclick="hasil()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="penguasaan_dasar_teori1">Sangat
                                        Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori2" value="4"
                                        onclick="hasil()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="penguasaan_dasar_teori2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori3" value="6"
                                        onclick="hasil()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="penguasaan_dasar_teori3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori4" value="8"
                                        onclick="hasil()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="penguasaan_dasar_teori4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori5" value="10"
                                        onclick="hasil()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '10' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="penguasaan_dasar_teori5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="tingkat_penguasaan_materi" class="col-form-label">2). Tingkat Penguasaan
                                    Materi</label>
                                <div class="radio2 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai2 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror" name="tingkat_penguasaan_materi" id="tombol_bulat2_{{ $i }}" value="{{ $nilai2 }}" onclick="setBulatValue2({{ $nilai2 }})" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == $nilai2 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat2_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi1" value="2"
                                        onclick="hasil()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal "
                                        for="tingkat_penguasaan_materi1">Sangat Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi2" value="4"
                                        onclick="hasil()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal "
                                        for="tingkat_penguasaan_materi2">Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi3" value="6"
                                        onclick="hasil()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="tingkat_penguasaan_materi3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi4" value="8"
                                        onclick="hasil()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="tingkat_penguasaan_materi4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi5" value="10"
                                        onclick="hasil()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '10' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal "
                                        for="tingkat_penguasaan_materi5">Sangat Baik</label>
                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="tinjauan_pustaka" class="col-form-label">3). Tinjauan Pustaka</label>
                                <div class="radio3 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai3 = ($i / 10) * 9;
    @endphp
                <input type="radio" class="btn-check @error('tinjauan_pustaka') is-invalid @enderror" name="tinjauan_pustaka" id="tombol_bulat3_{{ $i }}" value="{{ $nilai3 }}" onclick="setBulatValue3({{ $nilai3 }})" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == $nilai3 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat3_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka1" value="1.8" onclick="hasil()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="tinjauan_pustaka1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka2" value="3.6" onclick="hasil()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '3.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="tinjauan_pustaka2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka3" value="5.4" onclick="hasil()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '5.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="tinjauan_pustaka3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka4" value="7.2" onclick="hasil()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '7.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="tinjauan_pustaka4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka5" value="9" onclick="hasil()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '9' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="tinjauan_pustaka5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="penguasaan_dasar_teori" class="col-form-label">4). Tata Tulis</label>
                                <div class="radio4 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai4 = ($i / 10) * 8;
    @endphp
                <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror" name="tata_tulis" id="tombol_bulat4_{{ $i }}" value="{{ $nilai4 }}" onclick="setBulatValue4({{ $nilai4 }})" {{ old('tata_tulis', $skripsi->tata_tulis) == $nilai4 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat4_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis1" value="1.6" onclick="hasil()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="tata_tulis1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis2" value="3.2" onclick="hasil()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '3.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="tata_tulis2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis3" value="4.8" onclick="hasil()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '4.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="tata_tulis3">Biasa</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis4" value="6.4" onclick="hasil()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '6.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="tata_tulis4">Baik</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis5" value="8" onclick="hasil()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="tata_tulis5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="hasil_dan_pembahasan" class="col-form-label">5). Hasil dan Pembahasan</label>
                                <div class="radio15 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai5 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('hasil_dan_pembahasan') is-invalid @enderror" name="hasil_dan_pembahasan" id="tombol_bulat5_{{ $i }}" value="{{ $nilai5 }}" onclick="setBulatValue5({{ $nilai5 }})" {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == $nilai5 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat5_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('hasil_dan_pembahasan') is-invalid @enderror"
                                        name="hasil_dan_pembahasan" id="hasil_dan_pembahasan1" value="1.6"
                                        onclick="hasil()"
                                        {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="hasil_dan_pembahasan1">Sangat
                                        Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('hasil_dan_pembahasan') is-invalid @enderror"
                                        name="hasil_dan_pembahasan" id="hasil_dan_pembahasan2" value="4"
                                        onclick="hasil()"
                                        {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="hasil_dan_pembahasan2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('hasil_dan_pembahasan') is-invalid @enderror"
                                        name="hasil_dan_pembahasan" id="hasil_dan_pembahasan3" value="6"
                                        onclick="hasil()"
                                        {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="hasil_dan_pembahasan3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('hasil_dan_pembahasan') is-invalid @enderror"
                                        name="hasil_dan_pembahasan" id="hasil_dan_pembahasan4" value="8"
                                        onclick="hasil()"
                                        {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="hasil_dan_pembahasan4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('hasil_dan_pembahasan') is-invalid @enderror"
                                        name="hasil_dan_pembahasan" id="hasil_dan_pembahasan5" value="10"
                                        onclick="hasil()"
                                        {{ old('hasil_dan_pembahasan', $skripsi->hasil_dan_pembahasan) == '10' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="hasil_dan_pembahasan5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="hasil_dan_pembahasan" class="col-form-label">6). Sikap dan Kepribadian Ketika
                                    Bimbingan</label>
                                <div class="radio5 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai6 = ($i / 10) * 8;
    @endphp
                <input type="radio" class="btn-check @error('sikap_dan_kepribadian') is-invalid @enderror" name="sikap_dan_kepribadian" id="tombol_bulat6_{{ $i }}" value="{{ $nilai6 }}" onclick="setBulatValue6({{ $nilai6 }})" {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == $nilai6 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat6_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('sikap_dan_kepribadian') is-invalid @enderror"
                                        name="sikap_dan_kepribadian" id="sikap_dan_kepribadian1" value="1.6"
                                        onclick="hasil()"
                                        {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="sikap_dan_kepribadian1">Sangat
                                        Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('sikap_dan_kepribadian') is-invalid @enderror"
                                        name="sikap_dan_kepribadian" id="sikap_dan_kepribadian2" value="3.2"
                                        onclick="hasil()"
                                        {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '3.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="sikap_dan_kepribadian2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('sikap_dan_kepribadian') is-invalid @enderror"
                                        name="sikap_dan_kepribadian" id="sikap_dan_kepribadian3" value="4.8"
                                        onclick="hasil()"
                                        {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '4.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="sikap_dan_kepribadian3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('sikap_dan_kepribadian') is-invalid @enderror"
                                        name="sikap_dan_kepribadian" id="sikap_dan_kepribadian4" value="6.4"
                                        onclick="hasil()"
                                        {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '6.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="sikap_dan_kepribadian4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('sikap_dan_kepribadian') is-invalid @enderror"
                                        name="sikap_dan_kepribadian" id="sikap_dan_kepribadian5" value="8"
                                        onclick="hasil()"
                                        {{ old('sikap_dan_kepribadian', $skripsi->sikap_dan_kepribadian) == '8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="sikap_dan_kepribadian5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="col-lg-6 mt-5 ml-auto mr-auto">
                                <table class="table table-bordered bg-success">
                                    <tbody>
                                        <tr>
                                            <td style="width: 250px">TOTAL NILAI (ANGKA)</td>
                                            <td class="bg-success text-center">
                                                <input type="text" id="total_nilai_angka"
                                                    class="form-control text-bold text-center ml-auto mr-auto"
                                                    name="total_nilai_angka"
                                                    style=" width: 50px;
                  background-color: rgb(255, 255, 255);                                                
                "
                                                    readonly value="{{ $skripsi->total_nilai_angka }}">
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px">TOTAL NILAI (HURUF)</td>

                                            <td class="bg-success text-center">
                                                <input type="text" id="total_nilai_huruf"
                                                    class="form-control text-bold text-center ml-auto mr-auto"
                                                    name="total_nilai_huruf"
                                                    style=" width: 50px;
                  background-color: rgb(255, 255, 255);
                "
                                                    readonly value="{{ $skripsi->total_nilai_huruf }}">
                                                </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if ($skripsi->penjadwalan_skripsi->status_seminar == '0')
                                <button type="submit"
                                    class="btn btn-lg btnsimpan btn-success float-right">Perbarui</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujisatu_nip ||
            auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujidua_nip ||
            auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujitiga_nip)

        <form action="/penilaian-skripsi-penguji/edit/{{ $skripsi->id }}" method="POST">
            @method('put')
            @csrf
            <div class="card card-success card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">Form Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                aria-selected="false">Saran Perbaikan</a>
                        </li>
                        @if (auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujisatu_nip)
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-form-tab" data-toggle="pill"
                                    href="#custom-tabs-one-form" role="tab" aria-controls="custom-tabs-one-form"
                                    aria-selected="false">Revisi Judul</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-setting-tab" data-toggle="pill"
                                    href="#custom-tabs-one-setting" role="tab"
                                    aria-controls="custom-tabs-one-setting" aria-selected="false">Berita Acara</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <input type="hidden" name="penjadwalan_skripsi_id"
                            value="{{ $skripsi->penjadwalan_skripsi_id }}">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab">

                            <div class="mb-3 gridratakiri">
                                <label for="presentasi" class="col-form-label">1). Presentasi</label>
                                <div class="radio6 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai11 = ($i / 10) * 2;
    @endphp
                <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror" name="presentasi" id="tombol_bulat11_{{ $i }}" value="{{ $nilai11 }}" onclick="setBulatValue11({{ $nilai11 }})" {{ old('presentasi', $skripsi->presentasi) == $nilai11 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat11_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                        name="presentasi" id="presentasi1" value="0.4" onclick="total()"
                                        {{ old('presentasi', $skripsi->presentasi) == '0.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="presentasi1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                        name="presentasi" id="presentasi2" value="0.8" onclick="total()"
                                        {{ old('presentasi', $skripsi->presentasi) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="presentasi2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                        name="presentasi" id="presentasi3" value="1.2" onclick="total()"
                                        {{ old('presentasi', $skripsi->presentasi) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="presentasi3">Biasa</label>

                                    <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                        name="presentasi" id="presentasi4" value="1.6" onclick="total()"
                                        {{ old('presentasi', $skripsi->presentasi) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="presentasi4">Baik</label>

                                    <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                        name="presentasi" id="presentasi5" value="2" onclick="total()"
                                        {{ old('presentasi', $skripsi->presentasi) == '2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="presentasi5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="tingkat_penguasaan_materi" class="col-form-label">2). Tingkat Penguasaan
                                    Materi</label>
                                <div class="radio7 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai12 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror" name="tingkat_penguasaan_materi" id="tombol_bulat12_{{ $i }}" value="{{ $nilai12 }}" onclick="setBulatValue12({{ $nilai12 }})" {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == $nilai12 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat12_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi1" value="0.6"
                                        onclick="total()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal "
                                        for="tingkat_penguasaan_materi1">Sangat Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi2" value="1.2"
                                        onclick="total()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal "
                                        for="tingkat_penguasaan_materi2">Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi3" value="1.8"
                                        onclick="total()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="tingkat_penguasaan_materi3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi4" value="2.4"
                                        onclick="total()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="tingkat_penguasaan_materi4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tingkat_penguasaan_materi') is-invalid @enderror"
                                        name="tingkat_penguasaan_materi" id="tingkat_penguasaan_materi5" value="3"
                                        onclick="total()"
                                        {{ old('tingkat_penguasaan_materi', $skripsi->tingkat_penguasaan_materi) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal "
                                        for="tingkat_penguasaan_materi5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="keaslian" class="col-form-label">3). Keaslian</label>
                                <div class="radio8 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai13 = ($i / 10) * 2;
    @endphp
                <input type="radio" class="btn-check @error('keaslian') is-invalid @enderror" name="keaslian" id="tombol_bulat13_{{ $i }}" value="{{ $nilai13 }}" onclick="setBulatValue13({{ $nilai13 }})" {{ old('keaslian', $skripsi->keaslian) == $nilai13 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat13_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('keaslian') is-invalid @enderror"
                                        name="keaslian" id="keaslian1" value="0.4" onclick="total()"
                                        {{ old('keaslian', $skripsi->keaslian) == '0.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="keaslian1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('keaslian') is-invalid @enderror"
                                        name="keaslian" id="keaslian2" value="0.8" onclick="total()"
                                        {{ old('keaslian', $skripsi->keaslian) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="keaslian2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('keaslian') is-invalid @enderror"
                                        name="keaslian" id="keaslian3" value="1.2" onclick="total()"
                                        {{ old('keaslian', $skripsi->keaslian) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="keaslian3">Biasa</label>

                                    <input type="radio" class="btn-check @error('keaslian') is-invalid @enderror"
                                        name="keaslian" id="keaslian4" value="1.6" onclick="total()"
                                        {{ old('keaslian', $skripsi->keaslian) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="keaslian4">Baik</label>

                                    <input type="radio" class="btn-check @error('keaslian') is-invalid @enderror"
                                        name="keaslian" id="keaslian5" value="2" onclick="total()"
                                        {{ old('keaslian', $skripsi->keaslian) == '2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="keaslian5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="ketepatan_metodologi" class="col-form-label">4). Ketepatan Metodologi</label>
                                <div class="radio9 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai14 = ($i / 10) * 4;
    @endphp
                <input type="radio" class="btn-check @error('ketepatan_metodologi') is-invalid @enderror" name="ketepatan_metodologi" id="tombol_bulat14_{{ $i }}" value="{{ $nilai14 }}" onclick="setBulatValue14({{ $nilai14 }})" {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == $nilai14 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat14_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('ketepatan_metodologi') is-invalid @enderror"
                                        name="ketepatan_metodologi" id="ketepatan_metodologi1" value="0.8"
                                        onclick="total()"
                                        {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="ketepatan_metodologi1">Sangat
                                        Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('ketepatan_metodologi') is-invalid @enderror"
                                        name="ketepatan_metodologi" id="ketepatan_metodologi2" value="1.6"
                                        onclick="total()"
                                        {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="ketepatan_metodologi2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('ketepatan_metodologi') is-invalid @enderror"
                                        name="ketepatan_metodologi" id="ketepatan_metodologi3" value="2.4"
                                        onclick="total()"
                                        {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="ketepatan_metodologi3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('ketepatan_metodologi') is-invalid @enderror"
                                        name="ketepatan_metodologi" id="ketepatan_metodologi4" value="3.2"
                                        onclick="total()"
                                        {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '3.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="ketepatan_metodologi4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('ketepatan_metodologi') is-invalid @enderror"
                                        name="ketepatan_metodologi" id="ketepatan_metodologi5" value="4"
                                        onclick="total()"
                                        {{ old('ketepatan_metodologi', $skripsi->ketepatan_metodologi) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="ketepatan_metodologi5">Sangat
                                        Baik</label>
                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="penguasaan_dasar_teori" class="col-form-label">5). Penguasaan Dasar
                                    Teori</label>
                                <div class="radio10 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai15 = ($i / 10) * 4;
    @endphp
                <input type="radio" class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror" name="penguasaan_dasar_teori" id="tombol_bulat15_{{ $i }}" value="{{ $nilai15 }}" onclick="setBulatValue15({{ $nilai15 }})" {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == $nilai15 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat15_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori1" value="0.8"
                                        onclick="total()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="penguasaan_dasar_teori1">Sangat
                                        Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori2" value="1.6"
                                        onclick="total()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="penguasaan_dasar_teori2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori3" value="2.4"
                                        onclick="total()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="penguasaan_dasar_teori3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori4" value="3.2"
                                        onclick="total()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '3.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="penguasaan_dasar_teori4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penguasaan_dasar_teori') is-invalid @enderror"
                                        name="penguasaan_dasar_teori" id="penguasaan_dasar_teori5" value="4"
                                        onclick="total()"
                                        {{ old('penguasaan_dasar_teori', $skripsi->penguasaan_dasar_teori) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="penguasaan_dasar_teori5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="kecermatan_perumusan_masalah" class="col-form-label">6). Kecermatan Perumusan
                                    Masalah</label>
                                <div class="radio11 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai16 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('kecermatan_perumusan_masalah') is-invalid @enderror" name="kecermatan_perumusan_masalah" id="tombol_bulat16_{{ $i }}" value="{{ $nilai16 }}" onclick="setBulatValue16({{ $nilai16 }})" {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == $nilai16 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat16_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('kecermatan_perumusan_masalah') is-invalid @enderror"
                                        name="kecermatan_perumusan_masalah" id="kecermatan_perumusan_masalah1"
                                        value="0.6" onclick="total()"
                                        {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal "
                                        for="kecermatan_perumusan_masalah1">Sangat Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('kecermatan_perumusan_masalah') is-invalid @enderror"
                                        name="kecermatan_perumusan_masalah" id="kecermatan_perumusan_masalah2"
                                        value="1.2" onclick="total()"
                                        {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal "
                                        for="kecermatan_perumusan_masalah2">Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('kecermatan_perumusan_masalah') is-invalid @enderror"
                                        name="kecermatan_perumusan_masalah" id="kecermatan_perumusan_masalah3"
                                        value="1.8" onclick="total()"
                                        {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="kecermatan_perumusan_masalah3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('kecermatan_perumusan_masalah') is-invalid @enderror"
                                        name="kecermatan_perumusan_masalah" id="kecermatan_perumusan_masalah4"
                                        value="2.4" onclick="total()"
                                        {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="kecermatan_perumusan_masalah4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('kecermatan_perumusan_masalah') is-invalid @enderror"
                                        name="kecermatan_perumusan_masalah" id="kecermatan_perumusan_masalah5"
                                        value="3" onclick="total()"
                                        {{ old('kecermatan_perumusan_masalah', $skripsi->kecermatan_perumusan_masalah) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal "
                                        for="kecermatan_perumusan_masalah5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="tinjauan_pustaka" class="col-form-label">7). Tinjauan Pustaka</label>
                                <div class="radio12 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai17 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('tinjauan_pustaka') is-invalid @enderror" name="tinjauan_pustaka" id="tombol_bulat17_{{ $i }}" value="{{ $nilai17 }}" onclick="setBulatValue17({{ $nilai17 }})" {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == $nilai17 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat17_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka1" value="0.6" onclick="total()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="tinjauan_pustaka1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka2" value="1.2" onclick="total()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="tinjauan_pustaka2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka3" value="1.8" onclick="total()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="tinjauan_pustaka3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka4" value="2.4" onclick="total()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="tinjauan_pustaka4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('tinjauan_pustaka') is-invalid @enderror"
                                        name="tinjauan_pustaka" id="tinjauan_pustaka5" value="3" onclick="total()"
                                        {{ old('tinjauan_pustaka', $skripsi->tinjauan_pustaka) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="tinjauan_pustaka5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="tata_tulis" class="col-form-label">8). Tata Tulis</label>
                                <div class="radio13 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai18 = ($i / 10) * 2;
    @endphp
                <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror" name="tata_tulis" id="tombol_bulat18_{{ $i }}" value="{{ $nilai18 }}" onclick="setBulatValue18({{ $nilai18 }})" {{ old('tata_tulis', $skripsi->tata_tulis) == $nilai18 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat18_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis1" value="0.4" onclick="total()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '0.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="tata_tulis1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis2" value="0.8" onclick="total()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="tata_tulis2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis3" value="1.2" onclick="total()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="tata_tulis3">Biasa</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis4" value="1.6" onclick="total()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="tata_tulis4">Baik</label>

                                    <input type="radio" class="btn-check @error('tata_tulis') is-invalid @enderror"
                                        name="tata_tulis" id="tata_tulis5" value="2" onclick="total()"
                                        {{ old('tata_tulis', $skripsi->tata_tulis) == '2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="tata_tulis5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="tools" class="col-form-label">9). Tools yang digunakan</label>
                                <div class="radio16 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai19 = ($i / 10) * 2;
    @endphp
                <input type="radio" class="btn-check @error('tools') is-invalid @enderror" name="tools" id="tombol_bulat19_{{ $i }}" value="{{ $nilai19 }}" onclick="setBulatValue19({{ $nilai19 }})" {{ old('tools', $skripsi->tools) == $nilai19 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat19_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('tools') is-invalid @enderror"
                                        name="tools" id="tools1" value="0.4" onclick="total()"
                                        {{ old('tools', $skripsi->tools) == '0.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="tools1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('tools') is-invalid @enderror"
                                        name="tools" id="tools2" value="0.8" onclick="total()"
                                        {{ old('tools', $skripsi->tools) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="tools2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('tools') is-invalid @enderror"
                                        name="tools" id="tools3" value="1.2" onclick="total()"
                                        {{ old('tools', $skripsi->tools) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="tools3">Biasa</label>

                                    <input type="radio" class="btn-check @error('tools') is-invalid @enderror"
                                        name="tools" id="tools4" value="1.6" onclick="total()"
                                        {{ old('tools', $skripsi->tools) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="tools4">Baik</label>

                                    <input type="radio" class="btn-check @error('tools') is-invalid @enderror"
                                        name="tools" id="tools5" value="2" onclick="total()"
                                        {{ old('tools', $skripsi->tools) == '2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="tools5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="penyajian_data" class="col-form-label">10). Penyajian Data</label>
                                <div class="radio17 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai20 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('penyajian_data') is-invalid @enderror" name="penyajian_data" id="tombol_bulat20_{{ $i }}" value="{{ $nilai20 }}" onclick="setBulatValue20({{ $nilai20 }})" {{ old('penyajian_data', $skripsi->penyajian_data) == $nilai20 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat20_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('penyajian_data') is-invalid @enderror"
                                        name="penyajian_data" id="penyajian_data1" value="0.6" onclick="total()"
                                        {{ old('penyajian_data', $skripsi->penyajian_data) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="penyajian_data1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('penyajian_data') is-invalid @enderror"
                                        name="penyajian_data" id="penyajian_data2" value="1.2" onclick="total()"
                                        {{ old('penyajian_data', $skripsi->penyajian_data) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="penyajian_data2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penyajian_data') is-invalid @enderror"
                                        name="penyajian_data" id="penyajian_data3" value="1.8" onclick="total()"
                                        {{ old('penyajian_data', $skripsi->penyajian_data) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="penyajian_data3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('penyajian_data') is-invalid @enderror"
                                        name="penyajian_data" id="penyajian_data4" value="2.4" onclick="total()"
                                        {{ old('penyajian_data', $skripsi->penyajian_data) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="penyajian_data4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('penyajian_data') is-invalid @enderror"
                                        name="penyajian_data" id="penyajian_data5" value="3" onclick="total()"
                                        {{ old('penyajian_data', $skripsi->penyajian_data) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="penyajian_data5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="hasil" class="col-form-label">11). Hasil</label>
                                <div class="radio18 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai21 = ($i / 10) * 4;
    @endphp
                <input type="radio" class="btn-check @error('hasil') is-invalid @enderror" name="hasil" id="tombol_bulat21_{{ $i }}" value="{{ $nilai21 }}" onclick="setBulatValue21({{ $nilai21 }})" {{ old('hasil', $skripsi->hasil) == $nilai21 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat21_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('hasil') is-invalid @enderror"
                                        name="hasil" id="hasil1" value="0.8" onclick="total()"
                                        {{ old('hasil', $skripsi->hasil) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="hasil1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('hasil') is-invalid @enderror"
                                        name="hasil" id="hasil2" value="1.6" onclick="total()"
                                        {{ old('hasil', $skripsi->hasil) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="hasil2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('hasil') is-invalid @enderror"
                                        name="hasil" id="hasil3" value="2.4" onclick="total()"
                                        {{ old('hasil', $skripsi->hasil) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="hasil3">Biasa</label>

                                    <input type="radio" class="btn-check @error('hasil') is-invalid @enderror"
                                        name="hasil" id="hasil4" value="3.2" onclick="total()"
                                        {{ old('hasil', $skripsi->hasil) == '3.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="hasil4">Baik</label>

                                    <input type="radio" class="btn-check @error('hasil') is-invalid @enderror"
                                        name="hasil" id="hasil5" value="4" onclick="total()"
                                        {{ old('hasil', $skripsi->hasil) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="hasil5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="pembahasan" class="col-form-label">12). Pembahasan</label>
                                <div class="radio19 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai22 = ($i / 10) * 4;
    @endphp
                <input type="radio" class="btn-check @error('pembahasan') is-invalid @enderror" name="pembahasan" id="tombol_bulat22_{{ $i }}" value="{{ $nilai22 }}" onclick="setBulatValue22({{ $nilai22 }})" {{ old('pembahasan', $skripsi->pembahasan) == $nilai22 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat22_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('pembahasan') is-invalid @enderror"
                                        name="pembahasan" id="pembahasan1" value="0.8" onclick="total()"
                                        {{ old('pembahasan', $skripsi->pembahasan) == '0.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="pembahasan1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('pembahasan') is-invalid @enderror"
                                        name="pembahasan" id="pembahasan2" value="1.6" onclick="total()"
                                        {{ old('pembahasan', $skripsi->pembahasan) == '1.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="pembahasan2">Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('pembahasan') is-invalid @enderror"
                                        name="pembahasan" id="pembahasan3" value="2.4" onclick="total()"
                                        {{ old('pembahasan', $skripsi->pembahasan) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="pembahasan3">Biasa</label>

                                    <input type="radio" class="btn-check @error('pembahasan') is-invalid @enderror"
                                        name="pembahasan" id="pembahasan4" value="3.2" onclick="total()"
                                        {{ old('pembahasan', $skripsi->pembahasan) == '3.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="pembahasan4">Baik</label>

                                    <input type="radio" class="btn-check @error('pembahasan') is-invalid @enderror"
                                        name="pembahasan" id="pembahasan5" value="4" onclick="total()"
                                        {{ old('pembahasan', $skripsi->pembahasan) == '4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="pembahasan5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="kesimpulan" class="col-form-label">13). Kesimpulan</label>
                                <div class="radio20 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai23 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('kesimpulan') is-invalid @enderror" name="kesimpulan" id="tombol_bulat23_{{ $i }}" value="{{ $nilai23 }}" onclick="setBulatValue23({{ $nilai23 }})" {{ old('kesimpulan', $skripsi->kesimpulan) == $nilai23 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat23_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('kesimpulan') is-invalid @enderror"
                                        name="kesimpulan" id="kesimpulan1" value="0.6" onclick="total()"
                                        {{ old('kesimpulan', $skripsi->kesimpulan) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="kesimpulan1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('kesimpulan') is-invalid @enderror"
                                        name="kesimpulan" id="kesimpulan2" value="1.2" onclick="total()"
                                        {{ old('kesimpulan', $skripsi->kesimpulan) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="kesimpulan2">Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('kesimpulan') is-invalid @enderror"
                                        name="kesimpulan" id="kesimpulan3" value="1.8" onclick="total()"
                                        {{ old('kesimpulan', $skripsi->kesimpulan) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="kesimpulan3">Biasa</label>

                                    <input type="radio" class="btn-check @error('kesimpulan') is-invalid @enderror"
                                        name="kesimpulan" id="kesimpulan4" value="2.4" onclick="total()"
                                        {{ old('kesimpulan', $skripsi->kesimpulan) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="kesimpulan4">Baik</label>

                                    <input type="radio" class="btn-check @error('kesimpulan') is-invalid @enderror"
                                        name="kesimpulan" id="kesimpulan5" value="3" onclick="total()"
                                        {{ old('kesimpulan', $skripsi->kesimpulan) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="kesimpulan5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="luaran" class="col-form-label">14). Luaran</label>
                                <div class="radio21 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                      @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai24 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('luaran') is-invalid @enderror" name="luaran" id="tombol_bulat24_{{ $i }}" value="{{ $nilai24 }}" onclick="setBulatValue24({{ $nilai24 }})" {{ old('luaran', $skripsi->luaran) == $nilai24 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat24_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio" class="btn-check @error('luaran') is-invalid @enderror"
                                        name="luaran" id="luaran1" value="0.6" onclick="total()"
                                        {{ old('luaran', $skripsi->luaran) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="luaran1">Sangat Kurang
                                        Baik</label>

                                    <input type="radio" class="btn-check @error('luaran') is-invalid @enderror"
                                        name="luaran" id="luaran2" value="1.2" onclick="total()"
                                        {{ old('luaran', $skripsi->luaran) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="luaran2">Kurang Baik</label>

                                    <input type="radio" class="btn-check @error('luaran') is-invalid @enderror"
                                        name="luaran" id="luaran3" value="1.8" onclick="total()"
                                        {{ old('luaran', $skripsi->luaran) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal " for="luaran3">Biasa</label>

                                    <input type="radio" class="btn-check @error('luaran') is-invalid @enderror"
                                        name="luaran" id="luaran4" value="2.4" onclick="total()"
                                        {{ old('luaran', $skripsi->luaran) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal " for="luaran4">Baik</label>

                                    <input type="radio" class="btn-check @error('luaran') is-invalid @enderror"
                                        name="luaran" id="luaran5" value="3" onclick="total()"
                                        {{ old('luaran', $skripsi->luaran) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="luaran5">Sangat Baik</label>

                                </div>
                            </div>

                            <div class="mb-3 gridratakiri">
                                <label for="sumbangan_pemikiran" class="col-form-label">15). Sumbangan Pemikiran
                                    Terhadap Ilmu
                                    Pengetahuan</label>
                                <div class="radio14 d-inline">
                                    <hr>

                                    <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                  @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai25 = ($i / 10) * 3;
    @endphp
                <input type="radio" class="btn-check @error('sumbangan_pemikiran') is-invalid @enderror" name="sumbangan_pemikiran" id="tombol_bulat25_{{ $i }}" value="{{ $nilai25 }}" onclick="setBulatValue25({{ $nilai25 }})" {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == $nilai25 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat25_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>
                <br> -->

                                    <input type="radio"
                                        class="btn-check @error('sumbangan_pemikiran') is-invalid @enderror"
                                        name="sumbangan_pemikiran" id="sumbangan_pemikiran1" value="0.6"
                                        onclick="total()"
                                        {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '0.6' ? 'checked' : null }}>
                                    <label class="btn tombol btn-danger fw-normal " for="sumbangan_pemikiran1">Sangat
                                        Kurang Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('sumbangan_pemikiran') is-invalid @enderror"
                                        name="sumbangan_pemikiran" id="sumbangan_pemikiran2" value="1.2"
                                        onclick="total()"
                                        {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '1.2' ? 'checked' : null }}>
                                    <label class="btn tombol btn-warning fw-normal " for="sumbangan_pemikiran2">Kurang
                                        Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('sumbangan_pemikiran') is-invalid @enderror"
                                        name="sumbangan_pemikiran" id="sumbangan_pemikiran3" value="1.8"
                                        onclick="total()"
                                        {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '1.8' ? 'checked' : null }}>
                                    <label class="btn tombol btn-info fw-normal "
                                        for="sumbangan_pemikiran3">Biasa</label>

                                    <input type="radio"
                                        class="btn-check @error('sumbangan_pemikiran') is-invalid @enderror"
                                        name="sumbangan_pemikiran" id="sumbangan_pemikiran4" value="2.4"
                                        onclick="total()"
                                        {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '2.4' ? 'checked' : null }}>
                                    <label class="btn tombol btn-primary fw-normal "
                                        for="sumbangan_pemikiran4">Baik</label>

                                    <input type="radio"
                                        class="btn-check @error('sumbangan_pemikiran') is-invalid @enderror"
                                        name="sumbangan_pemikiran" id="sumbangan_pemikiran5" value="3"
                                        onclick="total()"
                                        {{ old('sumbangan_pemikiran', $skripsi->sumbangan_pemikiran) == '3' ? 'checked' : null }}>
                                    <label class="btn tombol btn-success fw-normal " for="sumbangan_pemikiran5">Sangat
                                        Baik</label>

                                </div>
                            </div>

                            <div class="col-lg-6 mt-5 ml-auto mr-auto">
                                <table class="table table-bordered bg-success">
                                    <tbody>
                                        <tr>
                                            <td style="width: 250px">TOTAL NILAI (ANGKA)</td>
                                            <td class="bg-success text-center">
                                                <input type="text" id="total_nilai_angka"
                                                    class="form-control text-bold text-center ml-auto mr-auto"
                                                    name="total_nilai_angka"
                                                    style=" width: 50px;
                  background-color: rgb(255, 255, 255);                                                
                "
                                                    readonly value="{{ $skripsi->total_nilai_angka }}">
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px">TOTAL NILAI (HURUF)</td>

                                            <td class="bg-success text-center">
                                                <input type="text" id="total_nilai_huruf"
                                                    class="form-control text-bold text-center ml-auto mr-auto"
                                                    name="total_nilai_huruf"
                                                    style=" width: 50px;
                  background-color: rgb(255, 255, 255);
                "
                                                    readonly value="{{ $skripsi->total_nilai_huruf }}">
                                                </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if ($skripsi->penjadwalan_skripsi->status_seminar == '0')
                                <button type="submit"
                                    class="btn btn-lg btnsimpan btn-success float-right">Perbarui</button>
                            @endif

                        </div>

                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-one-profile-tab">

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 1</div>
                                <input type="text" name="revisi_naskah1" class="form-control"
                                    value="{{ $skripsi->revisi_naskah1 != null ? $skripsi->revisi_naskah1 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 2</div>
                                <input type="text" name="revisi_naskah2" class="form-control"
                                    value="{{ $skripsi->revisi_naskah2 != null ? $skripsi->revisi_naskah2 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 3</div>
                                <input type="text" name="revisi_naskah3" class="form-control"
                                    value="{{ $skripsi->revisi_naskah3 != null ? $skripsi->revisi_naskah3 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 4</div>
                                <input type="text" name="revisi_naskah4" class="form-control"
                                    value="{{ $skripsi->revisi_naskah4 != null ? $skripsi->revisi_naskah4 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 5</div>
                                <input type="text" name="revisi_naskah5" class="form-control"
                                    value="{{ $skripsi->revisi_naskah5 != null ? $skripsi->revisi_naskah5 : '' }}">
                            </div>
                            @if ($skripsi->penjadwalan_skripsi->status_seminar == '0')
                                <button type="submit"
                                    class="btn btn-lg btnsimpan btn-success float-right">Perbarui</button>
                            @endif
        </form>
        </div>

        @if (auth()->user()->nip == $skripsi->penjadwalan_skripsi->pengujisatu_nip)
            <div class="tab-pane fade" id="custom-tabs-one-form" role="tabpanel"
                aria-labelledby="custom-tabs-one-form-tab">

                <form action="/revisi-skripsi/create/{{ $skripsi->penjadwalan_skripsi->id }}" method="POST">
                    @csrf
                    <div class="mb-3 gridratakiri">
                        <label class="form-label">Judul Lama</label>
                        <input type="text" class="form-control"
                            value="{{ $skripsi->penjadwalan_skripsi->judul_skripsi }}" readonly>
                    </div>
                    <div class="mb-3 gridratakiri">
                        <label class="form-label">Judul Baru</label>
                        <input type="text" name="revisi_skripsi" class="form-control"
                            value="{{ $skripsi->penjadwalan_skripsi->revisi_skripsi != null ? $skripsi->penjadwalan_skripsi->revisi_skripsi : '' }}">
                    </div>
                    @if ($skripsi->penjadwalan_skripsi->status_seminar == '0')
                        <button type="submit" class="btn btn-lg btnsimpan btn-success float-right">Perbarui</button>
                    @endif
                </form>

            </div>
            <div class="tab-pane fade" id="custom-tabs-one-setting" role="tabpanel"
                aria-labelledby="custom-tabs-one-setting-tab">
                <div>
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

                                    <!-- <tr>
                                                        <td colspan="2">Total Nilai Penguji</td>
                                                        <td class="bg-success text-center">45</td>
                                                        <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_angka : '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_angka : '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_angka : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Nilai Huruf Penguji</td>
                                                        <td class="text-center">{{ $nilaipenguji1 != '' ? $nilaipenguji1->total_nilai_huruf : '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $nilaipenguji2 != '' ? $nilaipenguji2->total_nilai_huruf : '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $nilaipenguji3 != '' ? $nilaipenguji3->total_nilai_huruf : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Rata Rata Nilai Penguji</td>
                                                        <td class="text-center" colspan="3">
                                                            <h3 class="text-bold">
                                                            @if ($nilaipenguji1 == '' && $nilaipenguji2 == '' && $nilaipenguji3 == '')
    - -->
                                @else
                                    <!-- <?php
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
                                    ?> -->
                                    {{ $nilaitotalpenguji }}
        @endif
        <!-- </h3>
                                                        </td>
                                                    </tr> -->
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

                    <!-- <tr>
                                                        <td colspan="2">Total Nilai Pembimbing</td>
                                                        <td class="bg-success text-center">55</td>
                                                        <td class="text-center">{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->total_nilai_angka : '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->total_nilai_angka : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Nilai Huruf Pembimbing</td>
                                                        <td class="text-center">{{ $nilaipembimbing1 != '' ? $nilaipembimbing1->total_nilai_huruf : '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $nilaipembimbing2 != '' ? $nilaipembimbing2->total_nilai_huruf : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Rata Rata Nilai Pembimbing</td>
                                                        <td class="text-center" colspan="2">
                                                            <h3 class="text-bold">
                                                            @if ($nilaipembimbing1 == '' && $nilaipembimbing2 == '')
    - -->
                @else
                    <!-- <?php
                    $nilai_masuk1 = 0;
                    
                    if (!empty($nilaipembimbing1)) {
                        $nilai_masuk1 = $nilai_masuk1 + 1;
                        $pembimbing1 = $nilaipembimbing1->total_nilai_angka;
                    } else {
                        $pembimbing1 = 0;
                    }
                    if (!empty($nilaipembimbing2)) {
                        $nilai_masuk1 = $nilai_masuk1 + 1;
                        $pembimbing2 = $nilaipembimbing2->total_nilai_angka;
                    } else {
                        $pembimbing2 = 0;
                    }
                    $nilaitotalpembimbing = round(($pembimbing1 + $pembimbing2) / $nilai_masuk1);
                    ?> -->
                    <!-- {{ $nilaitotalpembimbing }}
    @endif
                                                            </h3>
                                                        </td>
                                                    </tr> -->

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

            @if ($total_nilai <= 60)
                <form action="/catatanskripsi/create/{{ $skripsi->penjadwalan_skripsi->id }}" method="POST">
                    @csrf
                    <div class="mb-3 gridratakiri">
                        <label class="form-label">Catatan</label>
                        <input type="text" name="catatan" class="form-control"
                            value="{{ $skripsi->penjadwalan_skripsi->catatan != null ? $skripsi->penjadwalan_skripsi->catatan : '' }}">
                        <button type="submit" class="btn btn-success my-3">+ Catatan</button>
                    </div>
                </form>
            @else
            @endif

            @if ($total_nilai <= 60)
                <div class="mb-3 gridratakiri">
                    <form action="/nilaijurnal/create/{{ $jurnal->penjadwalan_skripsi_id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="fw-bold mb-2">Input Nilai Jurnal</div>
                        <input type="number" name="nilai" class="form-control"
                            value="{{ $jurnal->nilai != null ? $jurnal->nilai : '' }}" min="0"
                            max="100" step="1">
                </div>
                <button type="submit" class="btn  btn-success">+ Nilai</button>
        </div>
        </form>
        </div>
    @else
    @endif



    @if ($nilaipembimbing1 == null && $nilaipembimbing2 == null)
        <a href="#ModalApprove1" data-toggle="modal" class="btn btn-lg btn-danger float-right">Selesai Seminar</a>
        <div class="modal fade"id="ModalApprove1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container p-5 text-center">
                            <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                            <h5><b>Pembimbing</b> belum melakukan Input Nilai</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($nilaipenguji2 == null && $nilaipenguji3 == null && $skripsi->penjadwalan_skripsi->pengujitiga_nip == !null)
        <a href="#ModalApprove2" data-toggle="modal" class="btn mt-5 btn-lg btn-danger float-right">Selesai
            Seminar</a>
        <div class="modal fade"id="ModalApprove2">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2 text-center">
                            <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                            <h5><b>Penguji 2 & 3</b> belum melakukan Input Nilai</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($nilaipenguji2 == null)
        <a href="#ModalApprove3" data-toggle="modal" class="btn mt-5 btn-lg btn-danger float-right">Selesai
            Seminar</a>
        <div class="modal fade"id="ModalApprove3">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2 text-center">
                            <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                            <h5><b>Penguji 2</b> belum melakukan Input Nilai</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($nilaipenguji3 == null && $skripsi->penjadwalan_skripsi->pengujitiga_nip == !null)
        <a href="#ModalApprove4" data-toggle="modal" class="btn mt-5 btn-lg btn-danger float-right">Selesai
            Seminar</a>
        <div class="modal fade"id="ModalApprove4">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2 text-center">
                            <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                            <h5><b>Penguji 3</b> belum melakukan Input Nilai</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($total_nilai <= 60)
        <a href="#ModalApprove7" data-toggle="modal" class="btn mt-5 btn-lg btn-danger float-right">Selesai
            Seminar</a>

        <div class="modal fade"id="ModalApprove7">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2">
                            <h3 class="text-center">Apakah Anda Yakin?</h3>
                            <p class="text-center">Data Tidak Bisa Dikembalikan!</p>
                            <div class="row text-center">
                                <div class="col-4">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tidak</button>
                                </div>
                                <div class="col-2">
                                    <form action="/penilaian-skripsi/tolak/{{ $penjadwalan->id }}" method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-danger"> Selesai</button>
                                    </form>
                                </div>
                                <div class="col-4">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @elseif(
        ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Sinta 3' && $total_nilai < 80) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Sinta 4' && $total_nilai < 80) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'IEEE' && $total_nilai < 80) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'IOP' && $total_nilai < 80) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'SCOPUS' && $total_nilai < 80))
        <a href="#ModalApprove6" data-toggle="modal" class="btn btn-md btn-danger float-right">Selesai Seminar</a>
        <div class="modal fade"id="ModalApprove6">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2 text-center">
                            <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                            <h5>Nilai Harus Mencapai A-!</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- @elseif(
        ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Sinta 1' && $total_nilai < 85) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Sinta 2' && $total_nilai < 85) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Q1' && $total_nilai < 85) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Q2' && $total_nilai < 85) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Q3' && $total_nilai < 85) ||
            ($skripsi->penjadwalan_skripsi->indeksasi_jurnal == 'Q4' && $total_nilai < 85))
        <a href="#ModalApprove7" data-toggle="modal" class="btn btn-md btn-danger float-right">Selesai Seminar</a>
        <div class="modal fade"id="ModalApprove7">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2 text-center">
                            <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                            <h5>Nilai Harus Mencapai A!</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    @elseif($skripsi->penjadwalan_skripsi->status_seminar > 0)
        <!-- <a href="#ModalApprove6" data-toggle="modal" class="btn mt-5 btn-lg btn-success float-right"><i class="fas fa-check fa-lg"></i> </a> -->
        <div class="modal fade"id="ModalApprove6">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2 text-center">
                            <h1 class="text-success"><i class="fas fa-check-circle fa-lg"></i> </h1>
                            <h5>Seminar telah disetujui</h5>
                            <button type="button" class="btn mt-3 btn-secondary"
                                data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <a href="#ModalApprove7" data-toggle="modal" class="btn mt-5 btn-lg btn-success float-right">Selesai
            Seminar</a>

        <div class="modal fade"id="ModalApprove7">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-sm">
                    <div class="modal-body">
                        <div class="container px-5 pt-5 pb-2">
                            <h3 class="text-center">Apakah Anda Yakin?</h3>
                            <p class="text-center">Data Tidak Bisa Dikembalikan!</p>
                            <div class="row text-center">
                                <div class="col-4">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tidak</button>
                                </div>
                                <div class="col-2">
                                    <form action="/penilaian-skripsi/approve/{{ $penjadwalan->id }}" method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-success"> Selesai</button>
                                    </form>
                                </div>
                                <div class="col-4">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif

    </div>

    </div>
    </div>

    @endif

    </div>
    </div>
    <!-- </div> -->
    <!-- /.card -->
    </div>


    @endif

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
                    <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                        href="/developer/m-seprinaldi"> M. Seprinaldi</a><span
                        class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection


<!-- NILAI ANGKA PEMBIMBING -->

@push('scripts')
    <script>
        function setBulatValue(value) {
            // Setiap radio dengan nama 'penguasaan_dasar_teori' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="penguasaan_dasar_teori"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    hasil();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue2(value) {
            // Setiap radio dengan nama 'tingkat_penguasaan_materi' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tingkat_penguasaan_materi"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    hasil();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue3(value) {
            // Setiap radio dengan nama 'tinjauan_pustaka' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tinjauan_pustaka"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    hasil();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue4(value) {
            // Setiap radio dengan nama 'tata_tulis' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tata_tulis"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    hasil();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue5(value) {
            // Setiap radio dengan nama 'hasil_dan_pembahasan' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="hasil_dan_pembahasan"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    hasil();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue6(value) {
            // Setiap radio dengan nama 'sikap_dan_kepribadian' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="sikap_dan_kepribadian"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    hasil();
                }
            });
        }
    </script>
@endpush()


<!-- NILAI ANGKA PENGUJI -->

@push('scripts')
    <script>
        function setBulatValue11(value) {
            // Setiap radio dengan nama 'presentasi' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="presentasi"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue12(value) {
            // Setiap radio dengan nama 'tingkat_penguasaan_materi' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tingkat_penguasaan_materi"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue13(value) {
            // Setiap radio dengan nama 'keaslian' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="keaslian"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue14(value) {
            // Setiap radio dengan nama 'ketepatan_metodologi' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="ketepatan_metodologi"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue15(value) {
            // Setiap radio dengan nama 'penguasaan_dasar_teori' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="penguasaan_dasar_teori"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue16(value) {
            // Setiap radio dengan nama 'kecermatan_perumusan_masalah' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="kecermatan_perumusan_masalah"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue17(value) {
            // Setiap radio dengan nama 'tinjauan_pustaka' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tinjauan_pustaka"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue18(value) {
            // Setiap radio dengan nama 'tata_tulis' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tata_tulis"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue19(value) {
            // Setiap radio dengan nama 'tools' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="tools"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue20(value) {
            // Setiap radio dengan nama 'penyajian_data' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="penyajian_data"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue21(value) {
            // Setiap radio dengan nama 'hasil' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="hasil"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue22(value) {
            // Setiap radio dengan nama 'pembahasan' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="pembahasan"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue23(value) {
            // Setiap radio dengan nama 'kesimpulan' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="kesimpulan"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue24(value) {
            // Setiap radio dengan nama 'luaran' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="luaran"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()

@push('scripts')
    <script>
        function setBulatValue25(value) {
            // Setiap radio dengan nama 'sumbangan_pemikiran' akan di-set checked sesuai dengan korelasi nilai
            document.querySelectorAll('input[name="sumbangan_pemikiran"]').forEach(function(radio) {
                radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                if (radio.checked) {
                    // Panggil script hasil() dengan nilai yang sesuai
                    total();
                }
            });
        }
    </script>
@endpush()


@push('scripts')
    <script>
        function hasil() {

            var nilai_penguasaan_dasar_teori;
            var nilai_tingkat_penguasaan_materi;
            var nilai_tinjauan_pustaka;
            var nilai_tata_tulis;
            var nilai_hasil_dan_pembahasan;
            var nilai_sikap_dan_kepribadian;
            var penguasaan_dasar_teori = $('input[name="penguasaan_dasar_teori"]:checked').val();
            var tingkat_penguasaan_materi = $('input[name="tingkat_penguasaan_materi"]:checked').val();
            var tinjauan_pustaka = $('input[name="tinjauan_pustaka"]:checked').val();
            var tata_tulis = $('input[name="tata_tulis"]:checked').val();
            var hasil_dan_pembahasan = $('input[name="hasil_dan_pembahasan"]:checked').val();
            var sikap_dan_kepribadian = $('input[name="sikap_dan_kepribadian"]:checked').val();

            if (isNaN(parseFloat(penguasaan_dasar_teori))) {
                nilai_penguasaan_dasar_teori = parseFloat(0);
            } else {
                nilai_penguasaan_dasar_teori = parseFloat(penguasaan_dasar_teori);
            }

            if (isNaN(parseFloat(tingkat_penguasaan_materi))) {
                nilai_tingkat_penguasaan_materi = parseFloat(0);
            } else {
                nilai_tingkat_penguasaan_materi = parseFloat(tingkat_penguasaan_materi);
            }

            if (isNaN(parseFloat(tinjauan_pustaka))) {
                nilai_tinjauan_pustaka = parseFloat(0);
            } else {
                nilai_tinjauan_pustaka = parseFloat(tinjauan_pustaka);
            }

            if (isNaN(parseFloat(tata_tulis))) {
                nilai_tata_tulis = parseFloat(0);
            } else {
                nilai_tata_tulis = parseFloat(tata_tulis);
            }

            if (isNaN(parseFloat(hasil_dan_pembahasan))) {
                nilai_hasil_dan_pembahasan = parseFloat(0);
            } else {
                nilai_hasil_dan_pembahasan = parseFloat(hasil_dan_pembahasan);
            }

            if (isNaN(parseFloat(sikap_dan_kepribadian))) {
                nilai_sikap_dan_kepribadian = parseFloat(0);
            } else {
                nilai_sikap_dan_kepribadian = parseFloat(sikap_dan_kepribadian);
            }


            var total = parseFloat(nilai_penguasaan_dasar_teori) + parseFloat(nilai_tingkat_penguasaan_materi) + parseFloat(
                    nilai_tinjauan_pustaka) + parseFloat(nilai_tata_tulis) + parseFloat(nilai_hasil_dan_pembahasan) +
                parseFloat(nilai_sikap_dan_kepribadian);
            var total_angka = parseFloat(total);

            $('input[name="total_nilai_angka"]').val(Math.round(total_angka));
            if (total_angka >= 47) {
                $('input[name="total_nilai_huruf"]').val("A");
            } else if (total_angka >= 44) {
                $('input[name="total_nilai_huruf"]').val("A-");
            } else if (total_angka >= 42) {
                $('input[name="total_nilai_huruf"]').val("B+");
            } else if (total_angka >= 39) {
                $('input[name="total_nilai_huruf"]').val("B");
            } else if (total_angka >= 36) {
                $('input[name="total_nilai_huruf"]').val("B-");
            } else if (total_angka >= 33) {
                $('input[name="total_nilai_huruf"]').val("C+");
            } else if (total_angka >= 31) {
                $('input[name="total_nilai_huruf"]').val("C");
            } else if (total_angka >= 22) {
                $('input[name="total_nilai_huruf"]').val("D");
            } else if (total_angka >= 0) {
                $('input[name="total_nilai_huruf"]').val("E");
            }

        }

        function total() {
            var nilai_presentasi;
            var nilai_tingkat_penguasaan_materi;
            var nilai_keaslian;
            var nilai_ketepatan_metodologi;
            var nilai_penguasaan_dasar_teori;
            var nilai_kecermatan_perumusan_masalah;
            var nilai_tinjauan_pustaka;
            var nilai_tata_tulis;
            var nilai_tools;
            var nilai_penyajian_data;
            var nilai_hasil;
            var nilai_pembahasan;
            var nilai_kesimpulan;
            var nilai_luaran;
            var nilai_sumbangan_pemikiran;
            var presentasi = $('input[name="presentasi"]:checked').val();
            var tingkat_penguasaan_materi = $('input[name="tingkat_penguasaan_materi"]:checked').val();
            var keaslian = $('input[name="keaslian"]:checked').val();
            var ketepatan_metodologi = $('input[name="ketepatan_metodologi"]:checked').val();
            var penguasaan_dasar_teori = $('input[name="penguasaan_dasar_teori"]:checked').val();
            var kecermatan_perumusan_masalah = $('input[name="kecermatan_perumusan_masalah"]:checked').val();
            var tinjauan_pustaka = $('input[name="tinjauan_pustaka"]:checked').val();
            var tata_tulis = $('input[name="tata_tulis"]:checked').val();
            var tools = $('input[name="tools"]:checked').val();
            var penyajian_data = $('input[name="penyajian_data"]:checked').val();
            var hasil = $('input[name="hasil"]:checked').val();
            var pembahasan = $('input[name="pembahasan"]:checked').val();
            var kesimpulan = $('input[name="kesimpulan"]:checked').val();
            var luaran = $('input[name="luaran"]:checked').val();
            var sumbangan_pemikiran = $('input[name="sumbangan_pemikiran"]:checked').val();

            if (isNaN(parseFloat(presentasi))) {
                nilai_presentasi = parseFloat(0);
            } else {
                nilai_presentasi = parseFloat(presentasi);
            }

            if (isNaN(parseFloat(tingkat_penguasaan_materi))) {
                nilai_tingkat_penguasaan_materi = parseFloat(0);
            } else {
                nilai_tingkat_penguasaan_materi = parseFloat(tingkat_penguasaan_materi);
            }

            if (isNaN(parseFloat(keaslian))) {
                nilai_keaslian = parseFloat(0);
            } else {
                nilai_keaslian = parseFloat(keaslian);
            }

            if (isNaN(parseFloat(ketepatan_metodologi))) {
                nilai_ketepatan_metodologi = parseFloat(0);
            } else {
                nilai_ketepatan_metodologi = parseFloat(ketepatan_metodologi);
            }

            if (isNaN(parseFloat(penguasaan_dasar_teori))) {
                nilai_penguasaan_dasar_teori = parseFloat(0);
            } else {
                nilai_penguasaan_dasar_teori = parseFloat(penguasaan_dasar_teori);
            }

            if (isNaN(parseFloat(kecermatan_perumusan_masalah))) {
                nilai_kecermatan_perumusan_masalah = parseFloat(0);
            } else {
                nilai_kecermatan_perumusan_masalah = parseFloat(kecermatan_perumusan_masalah);
            }

            if (isNaN(parseFloat(tinjauan_pustaka))) {
                nilai_tinjauan_pustaka = parseFloat(0);
            } else {
                nilai_tinjauan_pustaka = parseFloat(tinjauan_pustaka);
            }

            if (isNaN(parseFloat(tata_tulis))) {
                nilai_tata_tulis = parseFloat(0);
            } else {
                nilai_tata_tulis = parseFloat(tata_tulis);
            }

            if (isNaN(parseFloat(tools))) {
                nilai_tools = parseFloat(0);
            } else {
                nilai_tools = parseFloat(tools);
            }

            if (isNaN(parseFloat(penyajian_data))) {
                nilai_penyajian_data = parseFloat(0);
            } else {
                nilai_penyajian_data = parseFloat(penyajian_data);
            }

            if (isNaN(parseFloat(hasil))) {
                nilai_hasil = parseFloat(0);
            } else {
                nilai_hasil = parseFloat(hasil);
            }

            if (isNaN(parseFloat(pembahasan))) {
                nilai_pembahasan = parseFloat(0);
            } else {
                nilai_pembahasan = parseFloat(pembahasan);
            }

            if (isNaN(parseFloat(kesimpulan))) {
                nilai_kesimpulan = parseFloat(0);
            } else {
                nilai_kesimpulan = parseFloat(kesimpulan);
            }

            if (isNaN(parseFloat(luaran))) {
                nilai_luaran = parseFloat(0);
            } else {
                nilai_luaran = parseFloat(luaran);
            }

            if (isNaN(parseFloat(sumbangan_pemikiran))) {
                nilai_sumbangan_pemikiran = parseFloat(0);
            } else {
                nilai_sumbangan_pemikiran = parseFloat(sumbangan_pemikiran);
            }

            var jumlah = parseFloat(nilai_presentasi) + parseFloat(nilai_tingkat_penguasaan_materi) + parseFloat(
                    nilai_keaslian) + parseFloat(nilai_ketepatan_metodologi) + parseFloat(nilai_penguasaan_dasar_teori) +
                parseFloat(nilai_kecermatan_perumusan_masalah) + parseFloat(nilai_tinjauan_pustaka) + parseFloat(
                    nilai_tata_tulis) + parseFloat(nilai_tools) + parseFloat(nilai_penyajian_data) + parseFloat(
                nilai_hasil) + parseFloat(nilai_pembahasan) + parseFloat(nilai_kesimpulan) + parseFloat(nilai_luaran) +
                parseFloat(nilai_sumbangan_pemikiran);
            var angka = parseFloat(jumlah);

            $('input[name="total_nilai_angka"]').val(Math.round(angka));
            if (angka >= 39) {
                $('input[name="total_nilai_huruf"]').val("A");
            } else if (angka >= 36) {
                $('input[name="total_nilai_huruf"]').val("A-");
            } else if (angka >= 34) {
                $('input[name="total_nilai_huruf"]').val("B+");
            } else if (angka >= 32) {
                $('input[name="total_nilai_huruf"]').val("B");
            } else if (angka >= 30) {
                $('input[name="total_nilai_huruf"]').val("B-");
            } else if (angka >= 27) {
                $('input[name="total_nilai_huruf"]').val("C+");
            } else if (angka >= 25) {
                $('input[name="total_nilai_huruf"]').val("C");
            } else if (angka >= 18) {
                $('input[name="total_nilai_huruf"]').val("D");
            } else if (angka >= 0) {
                $('input[name="total_nilai_huruf"]').val("E");
            }
        }
    </script>
@endpush

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
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                title: 'Berhasil',
                text: swal,
                confirmButtonColor: '#28A745',
                icon: 'success'
            })
        }
    </script>
@endpush()
