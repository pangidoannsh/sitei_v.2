@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Skripsi | SITEI UNRI
@endsection

@section('sub-title')
Riwayat Skripsi Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card p-4">
{{-- <ol class="breadcrumb col-lg-12">
 
<div class="btn-group scrollable-btn-group menu-dosen col-md-12">

@if (Str::length(Auth::guard('dosen')->user()) > 0)

   <a href="/kp-skripsi/persetujuan-skripsi"  class="btn bg-light border  border-bottom-0"  style="border-top-left-radius: 15px;" >Persetujuan</a>
   <a href="/kp-skripsi/penilaian-skripsi" class="btn bg-light border  border-bottom-0">Seminar</a>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  
          <a href="/skripsi" class="btn bg-light border  border-bottom-0 " >
   <span class="button-text">Skripsi Prodi</span>
  <span class="badge-link">
    <a href="/skripsi/nilai-keluar" class="sejarah pt-2 bg-success ">  
       <span class= "p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  @endif
@endif

<a href="/pembimbing/skripsi"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Bimbingan Skripsi</span>
  <span class="badge-link" >
    <a href="/skripsi/pembimbing/nilai-keluar" class="sejarah pt-2 bg-light " style="border-top-right-radius: 40%;">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
 
  @endif
@if (Str::length(Auth::guard('web')->user()) > 0)

@if (Str::length(Auth::guard('web')->user()) > 0)
 @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
  <a href="/persetujuan/admin/index" class="btn bg-light border  border-bottom-0" style="border-top-left-radius: 15px;">Persetujuan</a>
@endif
@endif
    <a href="/kerja-praktek/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Kerja Praktek</span>
  <span class="badge-link">
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-light ">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
    <a href="/sidang/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Skripsi</span>
  <span class="badge-link">
    <a href="/skripsi/nilai-keluar" class="sejarah pt-2 bg-success " style="border-top-right-radius: 15px;">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  @endif

</div>

</ol> --}}

<ol class="breadcrumb col-lg-12">

  @if (Str::length(Auth::guard('dosen')->user()) > 0)

  <li><a href="/kp-skripsi/persetujuan-skripsi" class="px-1">Persetujuan</a></li>
  (<span id="waitingApprovalCount"></span>)
  <span class="px-2">|</span>      
  <li><a href="/kp-skripsi/penilaian-skripsi" class="px-1">Seminar</a></li>
  (<span id="seminarKPCount"></span>)  
  <span class="px-2">|</span>
  <li><a href="/kp-skripsi/riwayat-penilaian-skripsi" class="px-1">Riwayat Seminar</a></li>
  (<span id=""></span>)
  <span class="px-2">|</span>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

        <li><a href="/skripsi" class="px-1">Data Skripsi</a></li>
        (<span id="prodiKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/skripsi/nilai-keluar" class="breadcrumb-item active fw-bold text-black px-1">Riwayat Skripsi</a></li>
        (<span id=""></span>)
        <span class="px-2">|</span>

      @endif
  @endif

        <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi</a></li>
        (<span id="bimbinganKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/skripsi/pembimbing/nilai-keluar" class="px-1">Riwayat Bimbingan Skripsi</a></li>
        (<span id=""></span>)

  @endif

  @if (Str::length(Auth::guard('web')->user()) > 0)

@if (Str::length(Auth::guard('web')->user()) > 0)
 @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
  {{-- <a href="/persetujuan/admin/index" class="btn bg-light border  border-bottom-0" style="border-top-left-radius: 15px;">Persetujuan</a> --}}
  <li><a href="/persetujuan/admin/index" class="px-1">Persetujuan</a></li>
  (<span id="waitingApprovalCount"></span>)
  <span class="px-2">|</span> 
@endif
@endif
    {{-- <a href="/kerja-praktek/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Kerja Praktek</span>
  <span class="badge-link">
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-light ">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
    <a href="/sidang/admin/index"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Skripsi</span>
  <span class="badge-link">
    <a href="/skripsi/nilai-keluar" class="sejarah pt-2 bg-success " style="border-top-right-radius: 15px;">  
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a> --}}

<li><a href="/kerja-praktek/admin/index" class="px-1">Data KP</a></li>
(<span id="seminarKPCount"></span>)  
<span class="px-2">|</span>
<li><a href="/kerja-praktek/nilai-keluar" class="px-1">Riwayat KP</a></li>
(<span id=""></span>)
<span class="px-2">|</span>
<li><a href="/sidang/admin/index" class="px-1">Data Skripsi</a></li>
(<span id="seminarKPCount"></span>)  
<span class="px-2">|</span>
<li><a href="/skripsi/nilai-keluar" class="breadcrumb-item active fw-bold text-black px-1">Riwayat Skripsi</a></li>
(<span id=""></span>)

  @endif


  
</ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center px-0" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <!-- <th class="text-center" scope="col">Konsentrasi</th> -->
        <!-- <th class="text-center" scope="col">Jenis Usulan</th> -->
        <th class="text-center" scope="col">Status Skripsi</th>
        <th class="text-center" scope="col">Keterangan</th>     
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($pendaftaran_skripsi as $skripsi)
<div></div>
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$skripsi->konsentrasi->nama_konsentrasi}}</td>                    -->
                        
            <!-- <td class="text-center">{{$skripsi->jenis_usulan}}</td>    -->
            <!-- USUL JUDUL  -->
  
            @if ($skripsi->status_skripsi == 'SKRIPSI SELESAI')           
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>
            @endif
            <!-- ___________batas____________ -->

            <td class="text-center">{{$skripsi->keterangan}}</td> 
            <!-- USUL JUDUL  -->
              @if ($skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' || $skripsi->status_skripsi == 'SKRIPSI SELESAI' ) 

           <td class="text-center">
          <a href="/bukti-buku-skripsi/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
          @endif
        </tr>

    @endforeach
  </tbody>


</table>
</div>
</div>


@endsection