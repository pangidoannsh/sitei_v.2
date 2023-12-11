@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Detail Mahasiswa
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

@foreach ($pendaftaran_kp as $kp)
<div>
@if (Str::length(Auth::guard('dosen')->user()) > 0)

       @if ($kp->keterangan == 'Nilai KP Telah Keluar')
    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="badge bg-success p-2 mb-3"> Kembali <a>
@else
   <a href="/pembimbing/kerja-praktek" class="badge bg-success p-2 mb-3 "> Kembali <a>
  @endif

  @endif
<!--@if (Str::length(Auth::guard('web')->user()) > 0)-->
      
<!--      @if ($kp->keterangan == 'Nilai KP Telah Keluar')-->
<!--    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="badge bg-success p-2 mb-3"> Kembali <a>-->
<!--@else-->
<!--   <a href="/kerja-praktek/admin/index" class="badge bg-success p-2 mb-3 "> Kembali <a>-->
<!--  @endif-->

<!--  @endif-->

  
  

  <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h5 class="text-bold">Mahasiswa</h5>
      <hr>
        <p class="card-title text-secondary text-sm " >Nama</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->nama}}</p>
        <p class="card-title text-secondary text-sm " >NIM</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->nim}}</p>
         <p class="card-title text-secondary text-sm " >Program Studi</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->prodi->nama_prodi}}</p>
        <p class="card-title text-secondary text-sm " >Konsentrasi</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->konsentrasi->nama_konsentrasi}}</p>
        
      </div>
    </div>
     <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Dosen Pembimbing</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Nama</p>
        <p class="card-text text-start" >{{$kp->dosen_pembimbingkp->nama}}</p>
        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$kp->dosen_pembimbingkp->nip}}</p> -->

      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
<div class="card-body">
      <h5 class="text-bold">Data Usulan</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >KPTI-10 - Bukti Penyerahan Laporan KP</p>
        <!-- <p class="card-text text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->kpti_10 )}}" class="badge bg-dark pr-3 p-2 pl-3">Buka</a></p> -->
       <p class="card-text text-start " ><button  onclick="window.location.href='{{asset('storage/' .$kp->kpti_10 )}}';" formtarget="_blank" target="_blank"class="badge bg-dark px-3 p-1">Buka</button></p>

       <p class="card-title text-secondary text-sm" >Laporan KP</p>
        <!-- <p class="card-text text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->kpti_10 )}}" class="badge bg-dark pr-3 p-2 pl-3">Buka</a></p> -->
       <p class="card-text text-start " ><button  onclick="window.location.href='{{asset('storage/' .$kp->laporan_akhir )}}';" formtarget="_blank" target="_blank"class="badge bg-dark px-3 p-1">Buka</button></p>

  </div>
  </div>
   
  </div>
</div>
 

    <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Keterangan Pendaftaran</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Jenis Usulan</p>
        <p class="card-text text-start" ><span >{{$kp->jenis_usulan}}</span></p>
        @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' )
        <p class="card-title text-secondary text-sm" >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'KP SELESAI' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$kp->keterangan}}</span></p>

      </div>
    </div>

  
  @endforeach
</div>
</div>
<br>
<br>
<br>
@endsection