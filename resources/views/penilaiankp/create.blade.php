@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('header')
    SITEI | Penilaian Seminar Kerja Praktek
@endsection

@section('title')
    SITEI | Penilaian Seminar Kerja Praktek
@endsection

@section('sub-title')
    Penilaian Seminar Kerja Praktek
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif



    <a href="/kp-skripsi/seminar-pembimbing-penguji" class="btn btn-success mb-3"> <i class="fas fa-arrow-left fa-xs"></i>
        Kembali <a>

            <div class="container">
                <div class="row shadow-sm rounded">
                    <div class="col-lg-4 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                        <h5 class="text-bold">Mahasiswa</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm ">Nama</p>
                        <p class="card-text text-start">{{ $kp->mahasiswa->nama }}</p>
                        <p class="card-title text-secondary text-sm ">NIM</p>
                        <p class="card-text text-start">{{ $kp->mahasiswa->nim }}</p>
                        <p class="card-title text-secondary text-sm ">Program Studi</p>
                        <p class="card-text text-start">{{ $kp->mahasiswa->prodi->nama_prodi }}</p>
                        <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                        <p class="card-text text-start">{{ $kp->mahasiswa->konsentrasi->nama_konsentrasi }}</p>
                    </div>
                    <div class="col-lg-4 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                        <h5 class="text-bold">Dosen Pembimbing</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Nama Pembimbing</p>
                        <p class="card-text text-start">{{ $kp->pembimbing->nama }}</p>
                    </div>
                    <div class="col-lg-4 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                        <h5 class="text-bold">Dosen Penguji</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Nama Penguji</p>
                        <p class="card-text text-start">{{ $kp->penguji->nama }}</p>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row shadow-sm rounded">
                    <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                        <h5 class="text-bold">Judul Kerja Praktek</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Judul</p>
                        <p class="card-text text-start">{{ $kp->judul_kp }}</p>
                        <p class="card-title text-secondary text-sm">Laporan</p>
                        <p class="card-text  text-start"><a formtarget="_blank" target="_blank"
                                href="{{ asset('storage/' . $laporan_kp->laporan_kp) }}"
                                class="badge bg-dark px-3 py-2">Buka</a></p>
                    </div>
                    <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                        <h5 class="text-bold">Jadwal Seminar</h5>
                        <hr>
                        <p class="card-title text-secondary text-sm">Hari/Tanggal</p>
                        <p class="card-text text-start">{{ Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y') }}</p>
                        <p class="card-title text-secondary text-sm">Pukul</p>
                        <p class="card-text text-start">{{ $kp->waktu }}</p>
                        <p class="card-title text-secondary text-sm">Ruangan</p>
                        <p class="card-text text-start">{{ $kp->lokasi }}</p>
                    </div>
                </div>
            </div>



            @if (auth()->user()->nip == $kp->penguji_nip && auth()->user()->nip !== $kp->pembimbing_nip)
                <form action="/penilaian-kp-penguji/create/{{ $kp->id }}" method="POST">
                    @csrf
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link btn-success text-white active" id="custom-tabs-one-home-tab"
                                        data-toggle="pill" href="#custom-tabs-one-home" role="tab"
                                        aria-controls="custom-tabs-one-home" aria-selected="true">Form Nilai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-success text-white" id="custom-tabs-one-profile-tab"
                                        data-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                        aria-controls="custom-tabs-one-profile" aria-selected="false">Saran Perbaikan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">

                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-home-tab">

                                    <div class="mb-3 gridratakiri ">
                                        <label for="presentasi" class="col-form-label">1). Presentasi</label>
                                        <div class="radio1 d-inline">
                                            <hr>

                                            <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror" name="presentasi" id="tombol_bulat_{{ $i }}" value="{{ $nilai }}" onclick="setBulatValue({{ $nilai }})" {{ old('presentasi', $kp->presentasi) == $nilai ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

             <br> -->

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi1" value="2" onclick="hasil()"
                                                {{ old('presentasi') == '2' ? 'checked' : null }}>
                                            <label class="btn tombol btn-danger fw-normal" for="presentasi1">Sangat Kurang
                                                Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi2" value="4" onclick="hasil()"
                                                {{ old('presentasi') == '4' ? 'checked' : null }}>
                                            <label class="btn tombol btn-warning fw-normal " for="presentasi2">Kurang
                                                Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi3" value="6" onclick="hasil()"
                                                {{ old('presentasi') == '6' ? 'checked' : null }}>
                                            <label class="btn tombol btn-info fw-normal " for="presentasi3">Biasa</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi4" value="8" onclick="hasil()"
                                                {{ old('presentasi') == '8' ? 'checked' : null }}>
                                            <label class="btn tombol btn-primary fw-normal "
                                                for="presentasi4">Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi5" value="10" onclick="hasil()"
                                                {{ old('presentasi') == '10' ? 'checked' : null }}>
                                            <label class="btn tombol btn-success fw-normal " for="presentasi5">Sangat
                                                Baik</label>

                                        </div>
                                    </div>
                                    @error('presentasi')
                                        <div class="invalid-feedback">
                                            Error
                                        </div>
                                    @enderror

                                    <div class="mb-3 gridratakiri ">
                                        <label for="materi" class="col-form-label">2). Materi</label>
                                        <div class="radio1 d-inline">
                                            <hr>

                                            <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai2 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('materi') is-invalid @enderror" name="materi" id="tombol_bulat2_{{ $i }}" value="{{ $nilai2 }}" onclick="setBulatValue2({{ $nilai2 }})" {{ old('materi', $kp->materi) == $nilai2 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat2_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

             <br> -->

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi1" value="2" onclick="hasil()"
                                                {{ old('materi') == '2' ? 'checked' : null }}>
                                            <label class="btn tombol btn-danger fw-normal" for="materi1">Sangat Kurang
                                                Baik</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi2" value="4" onclick="hasil()"
                                                {{ old('materi') == '4' ? 'checked' : null }}>
                                            <label class="btn tombol btn-warning fw-normal " for="materi2">Kurang
                                                Baik</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi3" value="6" onclick="hasil()"
                                                {{ old('materi') == '6' ? 'checked' : null }}>
                                            <label class="btn tombol btn-info fw-normal " for="materi3">Biasa</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi4" value="8" onclick="hasil()"
                                                {{ old('materi') == '8' ? 'checked' : null }}>
                                            <label class="btn tombol btn-primary fw-normal " for="materi4">Baik</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi5" value="10" onclick="hasil()"
                                                {{ old('materi') == '10' ? 'checked' : null }}>
                                            <label class="btn tombol btn-success fw-normal " for="materi5">Sangat
                                                Baik</label>

                                        </div>
                                    </div>
                                    @error('materi')
                                        <div class="invalid-feedback">
                                            Error
                                        </div>
                                    @enderror

                                    <div class="mb-3 gridratakiri ">
                                        <label for="tanya_jawab" class="col-form-label">3). Tanya Jawab</label>
                                        <div class="radio1 d-inline">
                                            <hr>

                                            <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai3 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('tanya_jawab') is-invalid @enderror" name="tanya_jawab" id="tombol_bulat3_{{ $i }}" value="{{ $nilai3 }}" onclick="setBulatValue3({{ $nilai3 }})" {{ old('tanya_jawab', $kp->tanya_jawab) == $nilai3 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat3_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

                <br> -->

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab1" value="2" onclick="hasil()"
                                                {{ old('tanya_jawab') == '2' ? 'checked' : null }}>
                                            <label class="btn tombol btn-danger fw-normal" for="tanya_jawab1">Sangat
                                                Kurang Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab2" value="4" onclick="hasil()"
                                                {{ old('tanya_jawab') == '4' ? 'checked' : null }}>
                                            <label class="btn tombol btn-warning fw-normal " for="tanya_jawab2">Kurang
                                                Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab3" value="6" onclick="hasil()"
                                                {{ old('tanya_jawab') == '6' ? 'checked' : null }}>
                                            <label class="btn tombol btn-info fw-normal " for="tanya_jawab3">Biasa</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab4" value="8" onclick="hasil()"
                                                {{ old('tanya_jawab') == '8' ? 'checked' : null }}>
                                            <label class="btn tombol btn-primary fw-normal "
                                                for="tanya_jawab4">Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab5" value="10" onclick="hasil()"
                                                {{ old('tanya_jawab') == '10' ? 'checked' : null }}>
                                            <label class="btn tombol btn-success fw-normal " for="tanya_jawab5">Sangat
                                                Baik</label>

                                        </div>
                                    </div>
                                    @error('tanya_jawab')
                                        <div class="invalid-feedback">
                                            Error
                                        </div>
                                    @enderror

                                    <div class="col-lg-6 mt-5 ml-auto mr-auto">
                                        <table class="table table-bordered bg-success">
                                            <tbody>
                                                <tr class="text-center">
                                                    <td style="width: 250px; padding-top:1.5rem; font-weight:bold;">TOTAL
                                                        NILAI (ANGKA)</td>
                                                    <td class="bg-success text-center">
                                                        <input type="text" id="total_nilai_angka"
                                                            class="form-control text-bold text-center ml-auto mr-auto"
                                                            name="total_nilai_angka"
                                                            style=" width: 50px;
                  background-color: rgb(255, 255, 255);                                                
                "
                                                            readonly>
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td style="width: 250px; padding-top:1.3rem; font-weight:bold;">TOTAL
                                                        NILAI (HURUF)</td>

                                                    <td class="bg-success text-center">
                                                        <input type="text" id="total_nilai_huruf"
                                                            class="form-control text-bold text-center ml-auto mr-auto"
                                                            name="total_nilai_huruf"
                                                            style=" width: 50px;
                  background-color: rgb(255, 255, 255);
                "
                                                            readonly>
                                                        </h3>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-lg btnsimpan btn-success float-right">Simpan</button>     -->

                                    <button type="submit"
                                        class="btn btn-lg btnsimpan btn-success float-right">Simpan</button>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-profile-tab">

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Perbaikan 1</div>
                                        <input type="text" name="revisi_naskah1" class="form-control"
                                            value="{{ $kp->revisi_naskah1 != null ? $kp->revisi_naskah1 : '' }}">
                                    </div>

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Perbaikan 2</div>
                                        <input type="text" name="revisi_naskah2" class="form-control"
                                            value="{{ $kp->revisi_naskah2 != null ? $kp->revisi_naskah2 : '' }}">
                                    </div>

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Perbaikan 3</div>
                                        <input type="text" name="revisi_naskah3" class="form-control"
                                            value="{{ $kp->revisi_naskah3 != null ? $kp->revisi_naskah3 : '' }}">
                                    </div>

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Perbaikan 4</div>
                                        <input type="text" name="revisi_naskah4" class="form-control"
                                            value="{{ $kp->revisi_naskah4 != null ? $kp->revisi_naskah4 : '' }}">
                                    </div>

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Perbaikan 5</div>
                                        <input type="text" name="revisi_naskah5" class="form-control"
                                            value="{{ $kp->revisi_naskah5 != null ? $kp->revisi_naskah5 : '' }}">
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-success float-right">Simpan</button>
                                </div>
                </form>
                </div>
                </div>
            @endif

            @if (auth()->user()->nip == $kp->pembimbing_nip && auth()->user()->nip !== $kp->penguji_nip)
                <form action="/penilaian-kp-pembimbing/create/{{ $kp->id }}" method="POST">
                    @csrf
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link btn-success text-white active" id="custom-tabs-one-home-tab"
                                        data-toggle="pill" href="#custom-tabs-one-home" role="tab"
                                        aria-controls="custom-tabs-one-home" aria-selected="true">Form Nilai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-success text-white" id="custom-tabs-one-profile-tab"
                                        data-toggle="pill" href="#custom-tabs-one-profile" role="tab"
                                        aria-controls="custom-tabs-one-profile" aria-selected="false">Nilai Pembimbing
                                        Lapangan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-success text-white" id="custom-tabs-one-form-tab"
                                        data-toggle="pill" href="#custom-tabs-one-form" role="tab"
                                        aria-controls="custom-tabs-one-form" aria-selected="false">Catatan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-success text-white" id="custom-tabs-one-setting-tab"
                                        data-toggle="pill" href="#custom-tabs-one-setting" role="tab"
                                        aria-controls="custom-tabs-one-setting" aria-selected="false">Berita Acara</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">

                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-home-tab">

                                    <div class="mb-3 gridratakiri ">
                                        <label for="presentasi" class="col-form-label">1). Presentasi</label>
                                        <div class="radio1 d-inline">
                                            <hr>

                                            <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai11 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror" name="presentasi" id="tombol_bulat11_{{ $i }}" value="{{ $nilai11 }}" onclick="setBulatValue11({{ $nilai11 }})" {{ old('presentasi', $kp->presentasi) == $nilai11 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat11_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

                <br> -->

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi1" value="2" onclick="hasil()"
                                                {{ old('presentasi') == '2' ? 'checked' : null }}>
                                            <label class="btn tombol btn-danger fw-normal" for="presentasi1">Sangat Kurang
                                                Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi2" value="4" onclick="hasil()"
                                                {{ old('presentasi') == '4' ? 'checked' : null }}>
                                            <label class="btn tombol btn-warning fw-normal " for="presentasi2">Kurang
                                                Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi3" value="6" onclick="hasil()"
                                                {{ old('presentasi') == '6' ? 'checked' : null }}>
                                            <label class="btn tombol btn-info fw-normal " for="presentasi3">Biasa</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi4" value="8" onclick="hasil()"
                                                {{ old('presentasi') == '8' ? 'checked' : null }}>
                                            <label class="btn tombol btn-primary fw-normal "
                                                for="presentasi4">Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('presentasi') is-invalid @enderror"
                                                name="presentasi" id="presentasi5" value="10" onclick="hasil()"
                                                {{ old('presentasi') == '10' ? 'checked' : null }}>
                                            <label class="btn tombol btn-success fw-normal " for="presentasi5">Sangat
                                                Baik</label>

                                        </div>
                                    </div>
                                    @error('presentasi')
                                        <div class="invalid-feedback">
                                            Error
                                        </div>
                                    @enderror

                                    <div class="mb-3 gridratakiri ">
                                        <label for="materi" class="col-form-label">2). Materi</label>
                                        <div class="radio1 d-inline">
                                            <hr>

                                            <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai12 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('materi') is-invalid @enderror" name="materi" id="tombol_bulat12_{{ $i }}" value="{{ $nilai12 }}" onclick="setBulatValue12({{ $nilai12 }})" {{ old('materi', $kp->materi) == $nilai12 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat12_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

                <br> -->

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi1" value="2" onclick="hasil()"
                                                {{ old('materi') == '2' ? 'checked' : null }}>
                                            <label class="btn tombol btn-danger fw-normal" for="materi1">Sangat Kurang
                                                Baik</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi2" value="4" onclick="hasil()"
                                                {{ old('materi') == '4' ? 'checked' : null }}>
                                            <label class="btn tombol btn-warning fw-normal " for="materi2">Kurang
                                                Baik</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi3" value="6" onclick="hasil()"
                                                {{ old('materi') == '6' ? 'checked' : null }}>
                                            <label class="btn tombol btn-info fw-normal " for="materi3">Biasa</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi4" value="8" onclick="hasil()"
                                                {{ old('materi') == '8' ? 'checked' : null }}>
                                            <label class="btn tombol btn-primary fw-normal " for="materi4">Baik</label>

                                            <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                                name="materi" id="materi5" value="10" onclick="hasil()"
                                                {{ old('materi') == '10' ? 'checked' : null }}>
                                            <label class="btn tombol btn-success fw-normal " for="materi5">Sangat
                                                Baik</label>

                                        </div>
                                    </div>
                                    @error('materi')
                                        <div class="invalid-feedback">
                                            Error
                                        </div>
                                    @enderror

                                    <div class="mb-3 gridratakiri ">
                                        <label for="tanya_jawab" class="col-form-label">3). Tanya Jawab</label>
                                        <div class="radio1 d-inline">
                                            <hr>

                                            <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai13 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('tanya_jawab') is-invalid @enderror" name="tanya_jawab" id="tombol_bulat13_{{ $i }}" value="{{ $nilai13 }}" onclick="setBulatValue13({{ $nilai13 }})" {{ old('tanya_jawab', $kp->tanya_jawab) == $nilai13 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat13_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

                <br> -->

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab1" value="2" onclick="hasil()"
                                                {{ old('tanya_jawab') == '2' ? 'checked' : null }}>
                                            <label class="btn tombol btn-danger fw-normal" for="tanya_jawab1">Sangat
                                                Kurang Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab2" value="4" onclick="hasil()"
                                                {{ old('tanya_jawab') == '4' ? 'checked' : null }}>
                                            <label class="btn tombol btn-warning fw-normal " for="tanya_jawab2">Kurang
                                                Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab3" value="6" onclick="hasil()"
                                                {{ old('tanya_jawab') == '6' ? 'checked' : null }}>
                                            <label class="btn tombol btn-info fw-normal " for="tanya_jawab3">Biasa</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab4" value="8" onclick="hasil()"
                                                {{ old('tanya_jawab') == '8' ? 'checked' : null }}>
                                            <label class="btn tombol btn-primary fw-normal "
                                                for="tanya_jawab4">Baik</label>

                                            <input type="radio"
                                                class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                                name="tanya_jawab" id="tanya_jawab5" value="10" onclick="hasil()"
                                                {{ old('tanya_jawab') == '10' ? 'checked' : null }}>
                                            <label class="btn tombol btn-success fw-normal " for="tanya_jawab5">Sangat
                                                Baik</label>

                                        </div>
                                    </div>
                                    @error('tanya_jawab')
                                        <div class="invalid-feedback">
                                            Error
                                        </div>
                                    @enderror

                                    <div class="col-lg-6 mt-5 ml-auto mr-auto">
                                        <table class="table table-bordered bg-success">
                                            <tbody>
                                                <tr class="text-center">
                                                    <td style="width: 250px; padding-top:1.5rem; font-weight:bold;">TOTAL
                                                        NILAI (ANGKA)</td>
                                                    <td class="bg-success text-center">
                                                        <input type="text" id="total_nilai_angka"
                                                            class="form-control text-bold text-center ml-auto mr-auto"
                                                            name="total_nilai_angka"
                                                            style=" width: 50px;
                  background-color: rgb(255, 255, 255);                                                
                "
                                                            readonly>
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td style="width: 250px; padding-top:1.3rem; font-weight:bold;">TOTAL
                                                        NILAI (HURUF)</td>

                                                    <td class="bg-success text-center">
                                                        <input type="text" id="total_nilai_huruf"
                                                            class="form-control text-bold text-center ml-auto mr-auto"
                                                            name="total_nilai_huruf"
                                                            style=" width: 50px;
                  background-color: rgb(255, 255, 255);
                "
                                                            readonly>
                                                        </h3>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-lg btnsimpan btn-success float-right">Simpan</button>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-profile-tab">

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Input Nilai :</div>
                                        <input type="number" name="nilai_pembimbing_lapangan" class="form-control"
                                            value="{{ $kp->nilai_pembimbing_lapangan != null ? $kp->nilai_pembimbing_lapangan : '' }}"
                                            min="0" max="100">
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success float-right">Simpan</button>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-form" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-form-tab">

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Catatan 1</div>
                                        <input type="text" name="catatan1" class="form-control"
                                            value="{{ $kp->catatan1 != null ? $kp->catatan1 : '' }}">
                                    </div>

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Catatan 2</div>
                                        <input type="text" name="catatan2" class="form-control"
                                            value="{{ $kp->catatan2 != null ? $kp->catatan2 : '' }}">
                                    </div>

                                    <div class="mb-3 gridratakiri">
                                        <div class="fw-bold mb-2">Catatan 3</div>
                                        <input type="text" name="catatan3" class="form-control"
                                            value="{{ $kp->catatan3 != null ? $kp->catatan3 : '' }}">
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-success float-right">Simpan</button>
                </form>
                </div>

                <div class="tab-pane fade" id="custom-tabs-one-setting" role="tabpanel"
                    aria-labelledby="custom-tabs-one-setting-tab">
                    <div>

                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px">#</th>
                                            <th style="width: 200px">Penilaian Penguji</th>
                                            <!-- <th class="bg-success text-center">B</th> -->
                                            <th class="text-center">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Presentasi</td>
                                            <!-- <td class="bg-secondary text-center">10%</td> -->
                                            <td class="text-center">
                                                @if ($nilaipenguji != '' && $nilaipenguji->presentasi !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Materi</td>
                                            <!-- <td class="bg-secondary text-center">10%</td> -->
                                            <td class="text-center">
                                                @if ($nilaipenguji != '' && $nilaipenguji->materi !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Tanya Jawab</td>
                                            <!-- <td class="bg-secondary text-center">10%</td> -->
                                            <td class="text-center">
                                                @if ($nilaipenguji != '' && $nilaipenguji->tanya_jawab !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- <tr>
                                          <td colspan="2">Total Nilai Penguji</td>
                                          <td class="bg-success text-center">30%</td>
                                          <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_angka : '-' }}</td>
                                      </tr>
                                      <tr>
                                          <td colspan="3">Nilai Huruf Penguji</td>
                                          <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_huruf : '-' }}</td>
                                      </tr>                                   -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px">#</th>
                                            <th style="width: 200px">Penilaian Pembimbing</th>
                                            <!-- <th class="bg-success text-center">B</th> -->
                                            <th class="text-center">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Presentasi</td>
                                            <!-- <td class="bg-secondary text-center">10%</td> -->
                                            <td class="text-center">
                                                @if ($nilaipembimbing != '' && $nilaipembimbing->presentasi !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Materi</td>
                                            <!-- <td class="bg-secondary text-center">10%</td> -->
                                            <td class="text-center">
                                                @if ($nilaipembimbing != '' && $nilaipembimbing->materi !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Tanya Jawab</td>
                                            <!-- <td class="bg-secondary text-center">10%</td> -->
                                            <td class="text-center">
                                                @if ($nilaipembimbing != '' && $nilaipembimbing->tanya_jawab !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- <tr>
                                        <td colspan="2">Total Nilai Pembimbing</td>
                                        <td class="bg-success text-center">30%</td>
                                        <td class="text-center">{{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_angka : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Nilai Huruf Pembimbing</td>
                                        <td class="text-center">{{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_huruf : '-' }}</td>
                                    </tr>                                   -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <table class="table table-bordered" style="background-color:white;">
                            <thead class="bg-success">
                                <tr>
                                    <th class="text-center" style="width: 50px">#</th>
                                    <th style="width: 600px">Nilai</th>
                                    <th>Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="gridratakiri">
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Nilai Seminar</td>
                                    <td>
                                        @if ($nilaipenguji != '' && $nilaipenguji->total_nilai_angka !== null)
                                            <i class="fas fa-check fa-lg "></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Nilai Pembimbing Lapangan</td>
                                    <td>
                                        @if ($nilaipembimbing != '' && $nilaipembimbing->nilai_pembimbing_lapangan !== null)
                                            <i class="fas fa-check fa-lg "></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Nilai Pembimbing KP</td>
                                    <td>
                                        @if ($nilaipembimbing != '' && $nilaipembimbing->total_nilai_angka !== null)
                                            <i class="fas fa-check fa-lg "></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">Total Akhir</td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- <form action="/penilaian-kp/approve/{{ $penjadwalan->id }}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit"  class="btn btn-lg btn-danger float-right">Selesai Seminar</button>
                          </form>                 -->

                        <div class="container pb-5">
                            <button type="button" class="btn mt-5 btn-lg btn-danger float-right" data-bs-toggle="modal"
                                data-bs-target="#ModalApprove">Selesai Seminar</button>

                            <div class="modal fade"id="ModalApprove">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="container px-5 pt-5 pb-2 text-center">
                                                <h1 class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i>
                                                </h1>
                                                <h5>Anda belum melakukan Input Nilai</h5>
                                                <button type="button" class="btn mt-3 btn-secondary"
                                                    data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                </div>
                </div>
            @endif





            <!-- BATAS -->


            @if (auth()->user()->nip == $kp->penguji_nip && auth()->user()->nip == $kp->pembimbing_nip)
                <div class="bg-white pb-5 rounded">
                    <ul class="nav nav-tabs navbar-success" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-success active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Form Nilai</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-success" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Saran Perbaikan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-success" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Nilai Pembimbing Lapangan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-success" id="empat-tab" data-bs-toggle="tab"
                                data-bs-target="#empat" type="button" role="tab" aria-controls="empat"
                                aria-selected="false">Catatan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn-success" id="lima-tab" data-bs-toggle="tab"
                                data-bs-target="#lima" type="button" role="tab" aria-controls="lima"
                                aria-selected="false">Berita Acara</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
        <button class="nav-link btn-successtext-light bg-success" id="enam-tab" data-bs-toggle="tab" data-bs-target="#enam" type="button" role="tab" aria-controls="enam" aria-selected="false">Contact</button>
      </li> -->
                    </ul>
                    <div class="tab-content p-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <form action="/penilaian-kp-penguji-pembimbing-sama/create/{{ $kp->id }}" method="POST">
                                @csrf
                                <div class="mb-3 gridratakiri ">
                                    <label for="presentasi" class="col-form-label">1). Presentasi</label>
                                    <div class="radio1 d-inline">
                                        <hr>

                                        <!-- <div class="d-flex justify-content-center justify-content-lg-start">
                @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror" name="presentasi" id="tombol_bulat_{{ $i }}" value="{{ $nilai }}" onclick="setBulatValue({{ $nilai }})" {{ old('presentasi', $kp->presentasi) == $nilai ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

                <br> -->

                                        <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                            name="presentasi" id="presentasi1" value="2" onclick="hasil()"
                                            {{ old('presentasi') == '2' ? 'checked' : null }}>
                                        <label class="btn tombol btn-danger fw-normal" for="presentasi1">Sangat Kurang
                                            Baik</label>

                                        <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                            name="presentasi" id="presentasi2" value="4" onclick="hasil()"
                                            {{ old('presentasi') == '4' ? 'checked' : null }}>
                                        <label class="btn tombol btn-warning fw-normal " for="presentasi2">Kurang
                                            Baik</label>

                                        <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                            name="presentasi" id="presentasi3" value="6" onclick="hasil()"
                                            {{ old('presentasi') == '6' ? 'checked' : null }}>
                                        <label class="btn tombol btn-info fw-normal " for="presentasi3">Biasa</label>

                                        <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                            name="presentasi" id="presentasi4" value="8" onclick="hasil()"
                                            {{ old('presentasi') == '8' ? 'checked' : null }}>
                                        <label class="btn tombol btn-primary fw-normal " for="presentasi4">Baik</label>

                                        <input type="radio" class="btn-check @error('presentasi') is-invalid @enderror"
                                            name="presentasi" id="presentasi5" value="10" onclick="hasil()"
                                            {{ old('presentasi') == '10' ? 'checked' : null }}>
                                        <label class="btn tombol btn-success fw-normal " for="presentasi5">Sangat
                                            Baik</label>

                                    </div>
                                </div>
                                @error('presentasi')
                                    <div class="invalid-feedback">
                                        Error
                                    </div>
                                @enderror

                                <div class="mb-3 gridratakiri ">
                                    <label for="materi" class="col-form-label">2). Materi</label>
                                    <div class="radio1 d-inline">
                                        <hr>

                                        <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai2 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('materi') is-invalid @enderror" name="materi" id="tombol_bulat2_{{ $i }}" value="{{ $nilai2 }}" onclick="setBulatValue2({{ $nilai2 }})" {{ old('materi', $kp->materi) == $nilai2 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat2_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

             <br> -->

                                        <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                            name="materi" id="materi1" value="2" onclick="hasil()"
                                            {{ old('materi') == '2' ? 'checked' : null }}>
                                        <label class="btn tombol btn-danger fw-normal" for="materi1">Sangat Kurang
                                            Baik</label>

                                        <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                            name="materi" id="materi2" value="4" onclick="hasil()"
                                            {{ old('materi') == '4' ? 'checked' : null }}>
                                        <label class="btn tombol btn-warning fw-normal " for="materi2">Kurang
                                            Baik</label>

                                        <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                            name="materi" id="materi3" value="6" onclick="hasil()"
                                            {{ old('materi') == '6' ? 'checked' : null }}>
                                        <label class="btn tombol btn-info fw-normal " for="materi3">Biasa</label>

                                        <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                            name="materi" id="materi4" value="8" onclick="hasil()"
                                            {{ old('materi') == '8' ? 'checked' : null }}>
                                        <label class="btn tombol btn-primary fw-normal " for="materi4">Baik</label>

                                        <input type="radio" class="btn-check @error('materi') is-invalid @enderror"
                                            name="materi" id="materi5" value="10" onclick="hasil()"
                                            {{ old('materi') == '10' ? 'checked' : null }}>
                                        <label class="btn tombol btn-success fw-normal " for="materi5">Sangat
                                            Baik</label>

                                    </div>
                                </div>
                                @error('materi')
                                    <div class="invalid-feedback">
                                        Error
                                    </div>
                                @enderror

                                <div class="mb-3 gridratakiri ">
                                    <label for="tanya_jawab" class="col-form-label">3). Tanya Jawab</label>
                                    <div class="radio1 d-inline">
                                        <hr>

                                        <!-- <div class="d-flex justify-content-center justify-content-lg-start">
           @for ($i = 1; $i <= 10; $i++)
    @php
        $nilai3 = ($i / 10) * 10;
    @endphp
                <input type="radio" class="btn-check @error('tanya_jawab') is-invalid @enderror" name="tanya_jawab" id="tombol_bulat3_{{ $i }}" value="{{ $nilai3 }}" onclick="setBulatValue3({{ $nilai3 }})" {{ old('tanya_jawab', $kp->tanya_jawab) == $nilai3 ? 'checked' : null }}>
                <label class="btn tombol text-sm ml-1 shadow-sm btn-secondary fw-normal" for="tombol_bulat3_{{ $i }}">{{ $i }}</label>
    @endfor
                </div>

                <br> -->

                                        <input type="radio"
                                            class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                            name="tanya_jawab" id="tanya_jawab1" value="2" onclick="hasil()"
                                            {{ old('tanya_jawab') == '2' ? 'checked' : null }}>
                                        <label class="btn tombol btn-danger fw-normal" for="tanya_jawab1">Sangat Kurang
                                            Baik</label>

                                        <input type="radio"
                                            class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                            name="tanya_jawab" id="tanya_jawab2" value="4" onclick="hasil()"
                                            {{ old('tanya_jawab') == '4' ? 'checked' : null }}>
                                        <label class="btn tombol btn-warning fw-normal " for="tanya_jawab2">Kurang
                                            Baik</label>

                                        <input type="radio"
                                            class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                            name="tanya_jawab" id="tanya_jawab3" value="6" onclick="hasil()"
                                            {{ old('tanya_jawab') == '6' ? 'checked' : null }}>
                                        <label class="btn tombol btn-info fw-normal " for="tanya_jawab3">Biasa</label>

                                        <input type="radio"
                                            class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                            name="tanya_jawab" id="tanya_jawab4" value="8" onclick="hasil()"
                                            {{ old('tanya_jawab') == '8' ? 'checked' : null }}>
                                        <label class="btn tombol btn-primary fw-normal " for="tanya_jawab4">Baik</label>

                                        <input type="radio"
                                            class="btn-check @error('tanya_jawab') is-invalid @enderror"
                                            name="tanya_jawab" id="tanya_jawab5" value="10" onclick="hasil()"
                                            {{ old('tanya_jawab') == '10' ? 'checked' : null }}>
                                        <label class="btn tombol btn-success fw-normal " for="tanya_jawab5">Sangat
                                            Baik</label>

                                    </div>
                                </div>
                                @error('tanya_jawab')
                                    <div class="invalid-feedback">
                                        Error
                                    </div>
                                @enderror

                                <div class="col-lg-6 mt-5 ml-auto mr-auto">
                                    <table class="table table-bordered bg-success">
                                        <tbody>
                                            <tr class="text-center">
                                                <td style="width: 250px; padding-top:1.5rem; font-weight:bold;">TOTAL NILAI
                                                    (ANGKA)</td>
                                                <td class="bg-success text-center">
                                                    <input type="text" id="total_nilai_angka"
                                                        class="form-control text-bold text-center ml-auto mr-auto"
                                                        name="total_nilai_angka"
                                                        style=" width: 50px;
                  background-color: rgb(255, 255, 255);                                                
                "
                                                        readonly>
                                                    </h3>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td style="width: 250px; padding-top:1.3rem; font-weight:bold;">TOTAL NILAI
                                                    (HURUF)</td>

                                                <td class="bg-success text-center">
                                                    <input type="text" id="total_nilai_huruf"
                                                        class="form-control text-bold text-center ml-auto mr-auto"
                                                        name="total_nilai_huruf"
                                                        style=" width: 50px;
                  background-color: rgb(255, 255, 255);
                "
                                                        readonly>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <button type="submit"
                                    class="btn btn-lg btnsimpan btn-success float-right">Simpan</button>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 1</div>
                                <input type="text" name="revisi_naskah1" class="form-control"
                                    value="{{ $kp->revisi_naskah1 != null ? $kp->revisi_naskah1 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 2</div>
                                <input type="text" name="revisi_naskah2" class="form-control"
                                    value="{{ $kp->revisi_naskah2 != null ? $kp->revisi_naskah2 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 3</div>
                                <input type="text" name="revisi_naskah3" class="form-control"
                                    value="{{ $kp->revisi_naskah3 != null ? $kp->revisi_naskah3 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 4</div>
                                <input type="text" name="revisi_naskah4" class="form-control"
                                    value="{{ $kp->revisi_naskah4 != null ? $kp->revisi_naskah4 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Perbaikan 5</div>
                                <input type="text" name="revisi_naskah5" class="form-control"
                                    value="{{ $kp->revisi_naskah5 != null ? $kp->revisi_naskah5 : '' }}">
                            </div>

                            <button type="submit" class="btn btn-lg btn-success float-right">Simpan</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="/penilaian-kp-pembimbing/create/{{ $kp->id }}" method="POST">
                                @csrf
                                <div class="mb-3 gridratakiri">
                                    <div class="fw-bold mb-2">Input Nilai :</div>
                                    <input type="number" name="nilai_pembimbing_lapangan" class="form-control"
                                        value="{{ $kp->nilai_pembimbing_lapangan != null ? $kp->nilai_pembimbing_lapangan : '' }}"
                                        min="0" max="100">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success float-right">Simpan</button>
                        </div>
                        <div class="tab-pane fade" id="empat" role="tabpanel" aria-labelledby="empat-tab">
                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Catatan 1</div>
                                <input type="text" name="catatan1" class="form-control"
                                    value="{{ $kp->catatan1 != null ? $kp->catatan1 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Catatan 2</div>
                                <input type="text" name="catatan2" class="form-control"
                                    value="{{ $kp->catatan2 != null ? $kp->catatan2 : '' }}">
                            </div>

                            <div class="mb-3 gridratakiri">
                                <div class="fw-bold mb-2">Catatan 3</div>
                                <input type="text" name="catatan3" class="form-control"
                                    value="{{ $kp->catatan3 != null ? $kp->catatan3 : '' }}">
                            </div>

                            <button type="submit" class="btn btn-lg btn-success float-right">Simpan</button>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="lima" role="tabpanel" aria-labelledby="lima-tab">
                            <div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px">#</th>
                                                    <th style="width: 200px">Penilaian Penguji</th>
                                                    <!-- <th class="bg-success text-center">B</th> -->
                                                    <th class="text-center">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Presentasi</td>
                                                    <!-- <td class="bg-secondary text-center">10%</td> -->
                                                    <td class="text-center">
                                                        @if ($nilaipenguji != '' && $nilaipenguji->presentasi !== null)
                                                            <i class="fas fa-check fa-lg "></i>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>Materi</td>
                                                    <!-- <td class="bg-secondary text-center">10%</td> -->
                                                    <td class="text-center">
                                                        @if ($nilaipenguji != '' && $nilaipenguji->materi !== null)
                                                            <i class="fas fa-check fa-lg "></i>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>Tanya Jawab</td>
                                                    <!-- <td class="bg-secondary text-center">10%</td> -->
                                                    <td class="text-center">
                                                        @if ($nilaipenguji != '' && $nilaipenguji->tanya_jawab !== null)
                                                            <i class="fas fa-check fa-lg "></i>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>

                                                <!-- <tr>
                                          <td colspan="2">Total Nilai Penguji</td>
                                          <td class="bg-success text-center">30%</td>
                                          <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_angka : '-' }}</td>
                                      </tr>
                                      <tr>
                                          <td colspan="3">Nilai Huruf Penguji</td>
                                          <td class="text-center">{{ $nilaipenguji != '' ? $nilaipenguji->total_nilai_huruf : '-' }}</td>
                                      </tr>                                   -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-lg-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px">#</th>
                                                    <th style="width: 200px">Penilaian Pembimbing</th>
                                                    <!-- <th class="bg-success text-center">B</th> -->
                                                    <th class="text-center">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Presentasi</td>
                                                    <!-- <td class="bg-secondary text-center">10%</td> -->
                                                    <td class="text-center">
                                                        @if ($nilaipembimbing != '' && $nilaipembimbing->presentasi !== null)
                                                            <i class="fas fa-check fa-lg "></i>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>Materi</td>
                                                    <!-- <td class="bg-secondary text-center">10%</td> -->
                                                    <td class="text-center">
                                                        @if ($nilaipembimbing != '' && $nilaipembimbing->materi !== null)
                                                            <i class="fas fa-check fa-lg "></i>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>Tanya Jawab</td>
                                                    <!-- <td class="bg-secondary text-center">10%</td> -->
                                                    <td class="text-center">
                                                        @if ($nilaipembimbing != '' && $nilaipembimbing->tanya_jawab !== null)
                                                            <i class="fas fa-check fa-lg "></i>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>

                                                <!-- <tr>
                                        <td colspan="2">Total Nilai Pembimbing</td>
                                        <td class="bg-success text-center">30%</td>
                                        <td class="text-center">{{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_angka : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Nilai Huruf Pembimbing</td>
                                        <td class="text-center">{{ $nilaipembimbing != '' ? $nilaipembimbing->total_nilai_huruf : '-' }}</td>
                                    </tr>                                   -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <table class="table table-bordered" style="background-color:white;">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="text-center" style="width: 50px">#</th>
                                            <th style="width: 600px">Nilai</th>
                                            <th>Total Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody class="gridratakiri">
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Nilai Seminar</td>
                                            <td>
                                                @if ($nilaipenguji != '' && $nilaipenguji->total_nilai_angka !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Nilai Pembimbing Lapangan</td>
                                            <td>
                                                @if ($nilaipembimbing != '' && $nilaipembimbing->nilai_pembimbing_lapangan !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Nilai Pembimbing KP</td>
                                            <td>
                                                @if ($nilaipembimbing != '' && $nilaipembimbing->total_nilai_angka !== null)
                                                    <i class="fas fa-check fa-lg "></i>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">Total Akhir</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>

                                <!-- <form action="/penilaian-kp/approve/{{ $penjadwalan->id }}" method="POST">
                            @method('put')
                            @csrf
                            <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="btn btn-lg btn-danger float-right">Selesai Seminar</button>
                          </form> -->
                                <div class="container pb-5">
                                    <button type="button" class="btn mt-5 btn-lg btn-danger float-right"
                                        data-bs-toggle="modal" data-bs-target="#ModalApprove">Selesai Seminar</button>

                                    <div class="modal fade"id="ModalApprove">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container px-5 pt-5 pb-2 text-center">
                                                        <h1 class="text-danger"><i
                                                                class="fas fa-exclamation-triangle fa-lg"></i> </h1>
                                                        <h5>Anda belum melakukan Input Nilai</h5>
                                                        <button type="button" class="btn mt-3 btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <!-- <div class="tab-pane fade" id="enam" role="tabpanel" aria-labelledby="enam-tab">6</div>
    </div> -->
            @endif


        @endsection

        @section('footer')
            <section class="bg-dark p-1">
                <div class="container">
                    <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                                class="text-success fw-bold">(</span><a class="text-success fw-bold"
                                formtarget="_blank" target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a>
                            <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                                href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                                class="text-success fw-bold">&</span>
                            <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                                href="/developer/m-seprinaldi"> M. Seprinaldi</a><span
                                class="text-success fw-bold">)</span></small></p>
                </div>
            </section>
        @endsection

        <!-- NILAI ANGKA PENGUJI  -->

        @push('scripts')
            <script>
                function setBulatValue(value) {
                    // Setiap radio dengan nama 'presentasi' akan di-set checked sesuai dengan korelasi nilai
                    document.querySelectorAll('input[name="presentasi"]').forEach(function(radio) {
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
                    // Setiap radio dengan nama 'materi' akan di-set checked sesuai dengan korelasi nilai
                    document.querySelectorAll('input[name="materi"]').forEach(function(radio) {
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
                    // Setiap radio dengan nama 'tanya_jawab' akan di-set checked sesuai dengan korelasi nilai
                    document.querySelectorAll('input[name="tanya_jawab"]').forEach(function(radio) {
                        radio.checked = (parseFloat(radio.value) <= parseFloat(value));
                        if (radio.checked) {
                            // Panggil script hasil() dengan nilai yang sesuai
                            hasil();
                        }
                    });
                }
            </script>
        @endpush()

        <!-- NILAI ANGKA PEMBIMBING -->

        @push('scripts')
            <script>
                function setBulatValue11(value) {
                    // Setiap radio dengan nama 'presentasi' akan di-set checked sesuai dengan korelasi nilai
                    document.querySelectorAll('input[name="presentasi"]').forEach(function(radio) {
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
                function setBulatValue12(value) {
                    // Setiap radio dengan nama 'materi' akan di-set checked sesuai dengan korelasi nilai
                    document.querySelectorAll('input[name="materi"]').forEach(function(radio) {
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
                function setBulatValue13(value) {
                    // Setiap radio dengan nama 'tanya_jawab' akan di-set checked sesuai dengan korelasi nilai
                    document.querySelectorAll('input[name="tanya_jawab"]').forEach(function(radio) {
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
                function hasil() {

                    var nilai_presentasi;
                    var nilai_materi;
                    var nilai_tanya_jawab;
                    var presentasi = $('input[name="presentasi"]:checked').val();
                    var materi = $('input[name="materi"]:checked').val();
                    var tanya_jawab = $('input[name="tanya_jawab"]:checked').val();

                    if (isNaN(parseFloat(presentasi))) {
                        nilai_presentasi = parseFloat(0);
                    } else {
                        nilai_presentasi = parseFloat(presentasi);
                    }

                    if (isNaN(parseFloat(materi))) {
                        nilai_materi = parseFloat(0);
                    } else {
                        nilai_materi = parseFloat(materi);
                    }

                    if (isNaN(parseFloat(tanya_jawab))) {
                        nilai_tanya_jawab = parseFloat(0);
                    } else {
                        nilai_tanya_jawab = parseFloat(tanya_jawab);
                    }

                    var total = parseFloat(nilai_presentasi) + parseFloat(nilai_materi) + parseFloat(nilai_tanya_jawab);
                    var total_angka = parseFloat(total) * parseFloat(3.3333);

                    $('input[name="total_nilai_angka"]').val(Math.round(total_angka));
                    if (total_angka > 85) {
                        $('input[name="total_nilai_huruf"]').val("A");
                    } else if (total_angka > 79) {
                        $('input[name="total_nilai_huruf"]').val("A-");
                    } else if (total_angka > 75) {
                        $('input[name="total_nilai_huruf"]').val("B+");
                    } else if (total_angka > 70) {
                        $('input[name="total_nilai_huruf"]').val("B");
                    } else if (total_angka > 65) {
                        $('input[name="total_nilai_huruf"]').val("B-");
                    } else if (total_angka > 60) {
                        $('input[name="total_nilai_huruf"]').val("C+");
                    } else if (total_angka > 55) {
                        $('input[name="total_nilai_huruf"]').val("C");
                    } else if (total_angka > 40) {
                        $('input[name="total_nilai_huruf"]').val("D");
                    } else {
                        $('input[name="total_nilai_huruf"]').val("E");
                    }

                }

                function total() {
                    var nilai_pembimbing_kp = $('input[name="nilai_pembimbing_kp"]').val();
                    var nilai_pembimbing_kp1 = parseFloat(nilai_pembimbing_kp) * parseFloat(0.3);
                    var nilai_pembimbing_lapangan = $('input[name="nilai_pembimbing_lapangan"]').val();
                    var nilai_pembimbing_lapangan1 = parseFloat(nilai_pembimbing_lapangan) * parseFloat(0.4);
                    var total_angka = $('input[name="total_nilai_seminar"]').val();

                    var total_akhir = (parseFloat(total_angka) * parseFloat(0.3)) + parseFloat(nilai_pembimbing_kp1) + parseFloat(
                        nilai_pembimbing_lapangan1);

                    if (!isNaN(total_akhir)) {
                        $('input[name="total_nilai_angka"]').val(Math.round(total_akhir));
                        if (total_akhir >= 85) {
                            $('input[name="total_nilai_huruf"]').val("A");
                        } else if (total_akhir > 79) {
                            $('input[name="total_nilai_huruf"]').val("A-");
                        } else if (total_akhir >= 75) {
                            $('input[name="total_nilai_huruf"]').val("B+");
                        } else if (total_akhir >= 70) {
                            $('input[name="total_nilai_huruf"]').val("B");
                        } else if (total_akhir >= 65) {
                            $('input[name="total_nilai_huruf"]').val("B-");
                        } else if (total_akhir >= 60) {
                            $('input[name="total_nilai_huruf"]').val("C+");
                        } else if (total_akhir >= 55) {
                            $('input[name="total_nilai_huruf"]').val("C");
                        } else if (total_akhir >= 40) {
                            $('input[name="total_nilai_huruf"]').val("D");
                        } else {
                            $('input[name="total_nilai_huruf"]').val("E");
                        }
                    } else {
                        $('input[name="total_nilai_angka"]').val(total_angka | nilai_pembimbing_kp1 | nilai_pembimbing_lapangan1);
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
