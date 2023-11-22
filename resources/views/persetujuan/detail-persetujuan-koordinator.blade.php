@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Detail Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif


<div class="container-fluid">

<div>
@if (Str::length(Auth::guard('dosen')->user()) > 0)
         
  <a href="/pembimbing/skripsi" class="badge bg-success p-2 mb-3"> Kembali <a>


  @endif
@if (Str::length(Auth::guard('web')->user()) > 0)
         
  <a href="/sidang/admin/index" class="badge bg-success p-2 mb-3"> Kembali <a>
  @endif


  

  @foreach ($penjadwalan_skripsis as $skripsi)


  <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h5 class="text-bold">Mahasiswa</h5>
      <hr>
        <p class="card-title text-secondary text-sm " >Nama</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->nama}}</p>
        <p class="card-title text-secondary text-sm " >NIM</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->nim}}</p>
         <p class="card-title text-secondary text-sm " >Program Studi</p>
        <p class="card-text text-start" >{{$skripsi->prodi->nama_prodi}}</p>
        <p class="card-title text-secondary text-sm " >Konsentrasi</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->konsentrasi->nama_konsentrasi}}</p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Dosen Pembimbing</h5>
        <hr>
        @if ($skripsi->pembimbingdua == null )
        <p class="card-title text-secondary text-sm" >Nama</p>
        <p class="card-text text-start" >{{$skripsi->pembimbingsatu->nama}}</p>


        @elseif($skripsi->pembimbingdua !== null)
        <p class="card-title text-secondary text-sm" >Nama Pembimbing 1</p>
        <p class="card-text text-start" >{{$skripsi->pembimbingsatu->nama}}</p>

        <p class="card-title text-secondary text-sm" >Nama Pembimbing 2</p>
        <p class="card-text text-start" >{{$skripsi->pembimbingdua->nama}}</p>

        @endif
      </div>
    </div>
  </div>
</div>

  <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h5 class="text-bold">Keterangan Seminar</h5>
      <hr>
        <p class="card-title text-secondary text-sm " >Judul Skripsi</p>
        <p class="card-text text-start" >{{$skripsi->judul_skripsi}}</p>
        <p class="card-title text-secondary text-sm " >Jenis Seminar</p>
        <p class="card-text text-start" ><span class="bg-warning px-2" style="border-radius:20px;">{{$skripsi->jenis_seminar}}</span></p>
        <p class="card-title text-secondary text-sm " >Tanggal Seminar</p>
        <p class="card-text text-start" >{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</p>
         <p class="card-title text-secondary text-sm " >Lokasi</p>
        <p class="card-text text-start" >{{$skripsi->lokasi}}</p>
        <p class="card-title text-secondary text-sm " >Berita Acara</p> <br>
        <a href="/penilaian-skripsi/cek-nilai/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2 rounded">Buka</a>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Dosen Penguji</h5>
        <hr>
        @if ($skripsi->pengujitiga == null )
        <p class="card-title text-secondary text-sm" >Nama Penguji 1</p>
        <p class="card-text text-start" >{{$skripsi->pengujisatu->nama}}</p>
        <p class="card-title text-secondary text-sm" >Nama Penguji 2</p>
        <p class="card-text text-start" >{{$skripsi->pengujidua->nama}}</p>


        @elseif($skripsi->pengujitiga !== null)
        <p class="card-title text-secondary text-sm" >Nama Penguji 1</p>
        <p class="card-text text-start" >{{$skripsi->pengujisatu->nama}}</p>
        <p class="card-title text-secondary text-sm" >Nama Penguji 2</p>
        <p class="card-text text-start" >{{$skripsi->pengujidua->nama}}</p>
        <p class="card-title text-secondary text-sm" >Nama Penguji 3</p>
        <p class="card-text text-start" >{{$skripsi->pengujitiga->nama}}</p>

        @endif
      </div>
    </div>
  </div>
</div>



<!-- <div class="card">
      <div class="card-body">
      <h5 class="text-bold">Data Seminar</h5>
      <hr>
      <p class="card-title text-secondary text-sm" >Judul diusulkan</p>
        <p class="card-text text-start" >{{$skripsi->judul_skripsi}}</p>
        <p class="card-title text-secondary text-sm " >KRS Semester Berjalan</p>
        <p class="card-text text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$skripsi->krs_berjalan )}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></p>
        <p class="card-title text-secondary text-sm " >Kartu Hasil Studi</p>
        <p class="card-text text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$skripsi->khs )}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></p>
        <p class="card-title text-secondary text-sm " >Transkip Nilai</p>
        <p class="card-text text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$skripsi->transkip_nilai )}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></p>

        
        
      </div>
    </div> -->

    <!-- <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Keterangan Pendaftaran</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Jenis Usulan</p>
        <p class="card-text text-start" ><span >{{$skripsi->jenis_usulan}}</span></p>
        @if ($skripsi->status_skripsi == 'USULAN JUDUL'||$skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI KOORDINATOR SKRIPSI' || $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING' || $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING 1' || $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI PEMBIMBING 2' )
        <p class="card-title text-secondary text-sm" >Status Skripsi</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        @if ($skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$skripsi->keterangan}}</span></p>

      </div>
    </div> -->
    



  @endforeach
</div>
</div>


<br>
<br>
<br>
<br>
<br>

@endsection
