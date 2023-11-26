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
         
  <a href="/persetujuan-kp-skripsi" class="badge bg-success p-2 mb-3"> Kembali <a>


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


  @endforeach
</div>
</div>


<br>
<br>
<br>
<br>
<br>

@endsection
