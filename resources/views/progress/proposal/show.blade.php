@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Progres Proposal Mahasiswa
@endsection

@section('sub-title')
    Progres Proposal Mahasiswa
@endsection


@section('content')
    <section class="mb-5">
        <a href="{{ url()->previous() }}" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i>
            Kembali <a>
                <div class="container">
                    <div class="row rounded shadow-sm">
                        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                            <h5 class="text-bold">Mahasiswa</h5>
                            <hr>
                            <p class="card-title text-secondary text-sm ">Nama</p>
                            <p class="card-text text-start">{{ $proposal->mahasiswa_nama }}</p>
                            <p class="card-title text-secondary text-sm ">NIM</p>
                            <p class="card-text text-start">{{ $proposal->mahasiswa_nim }}</p>
                            <p class="card-title text-secondary text-sm ">Program Studi</p>
                            <p class="card-text text-start">{{ $prodi->nama_prodi }}</p>
                            <p class="card-title text-secondary text-sm ">Konsentrasi</p>
                            <p class="card-text text-start">{{ $konsentrasi->nama_konsentrasi }}</p>
                        </div>
                        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                            <h5 class="text-bold">Dosen Pembimbing</h5>
                            <hr>
                            <p class="card-title text-secondary text-sm">Nama</p>
                            <p class="card-text text-start">{{ $proposal->pembimbing_nama }}</p>
                            <p class="card-title text-secondary text-sm">NIP</p>
                            <p class="card-text text-start">{{ $proposal->pembimbing_nip }}</p>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row rounded shadow-sm">
                        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
                            <h5 class="text-bold">Data Usulan</h5>
                            <hr>
                            <p class="card-title text-secondary text-sm">Judul Laporan</p>
                            <p class="card-text text-start"> {{ $pendaftaran_skripsi->judul }}</p>
                            <p class="card-title text-secondary text-sm">BAB 1</p>
                            <ul>
                                @foreach ($proposal->bab1 as $bab1)
                                    <li class="card-text">{{ $bab1 }}</li>
                                @endforeach
                            </ul>

                            @if ($proposal->bab2)
                                <p class="card-title text-secondary text-sm">BAB 2</p>
                                <ul>
                                    @foreach ($proposal->bab2 as $bab2)
                                        <li class="card-text">{{ $bab2 }}</li>
                                    @endforeach
                                </ul>
                            @endif


                            @if ($proposal->bab3)
                                <p class="card-title text-secondary text-sm">BAB 3</p>
                                <ul>
                                    @foreach ($proposal->bab3 as $bab3)
                                        <li class="card-text">{{ $bab3 }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <p class="card-title text-secondary text-sm">Naskah</p>
                            <p class="card-text  text-start"><a formtarget="_blank" target="_blank"
                                    href="{{ asset('storage/' . $proposal->naskah) }}"
                                    class="badge bg-dark px-3 py-2">Buka</a>
                            </p>

                        </div>
                        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
                            <h5 class="text-bold">Keterangan Proposal</h5>
                            <hr>
                            <p class="card-title text-secondary text-sm">Jenis Usulan</p>
                            <p class="card-text text-start"><span>{{ $proposal->status }}</span></p>
                            <p class="card-title text-secondary text-sm">Bimbingan Ke </p>
                            <p class="card-text text-start"><span>{{ $proposal->bimbingan }}</span></p>
                            <p class="card-title text-secondary text-sm ">Diskusi</p>
                            <p class="card-text text-start"><span>{{ $proposal->diskusi }}</span></p>
                            <p class="card-title text-secondary text-sm">Komentar</p>
                            @if ($proposal->komentar)
                                <p class="card-text text-start"><span>{{ $proposal->komentar }}</span></p>
                            @else
                                <p class="card-text text-start"><span> - </span></p>
                            @endif
                            <p class="card-title text-secondary text-sm">Keterangan</p>
                            @if ($proposal->keterangan)
                                <p class="card-text text-start"><span>{{ $proposal->keterangan }}</span></p>
                            @else
                                <p class="card-text text-start"><span> - </span></p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container">
                </div>
    </section>
    <br>
    <br>
    <br>
@endsection


@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( Ibadurahman )</a></p>
        </div>
    </section>
@endsection
