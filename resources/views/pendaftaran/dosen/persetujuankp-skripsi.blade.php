@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI ELEKTRO | Persetujuan Kerja Praktek
@endsection

@section('sub-title')
    Persetujuan Kerja Praktek & Skripsi
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card  p-4">

<ol class="breadcrumb col-lg-12">
    <li><a href="/persetujuan-kp-skripsi" class="breadcrumb-item active fw-bold text-success px-1">Persetujuan (<span id="waitingApprovalCount"></span>)</a></li>
    
     
    @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          <span class="px-2">|</span>      
            <li><a href="/persetujuan-kaprodi" class="px-1">Persetujuan Seminar (<span id="seminarKPCount"></span>)</a></li>

          <span class="px-2">|</span>
            <li><a href="/riwayat-kaprodi" class="px-1">Riwayat Persetujuan (<span id=""></span>)</a></li>
            
        @endif
    @endif

    @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

          <span class="px-2">|</span>      
            <li><a href="persetujuan-koordinator" class="px-1">Persetujuan Seminar (<span id="seminarKPCount"></span>)</a></li>

          <span class="px-2">|</span>
            <li><a href="riwayat-koordinator" class="px-1">Riwayat Persetujuan (<span id=""></span>)</a></li>

        @endif
    @endif

    
  </ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <!-- <th class="text-center p-2" scope="col">No.</th> -->
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Status</th>
        <th class="text-center" scope="col">Tanggal Usulan</th> 
        <th class="text-center" scope="col">Batas Persetujuan</th> 
        <th class="text-center" scope="col">Keterangan</th>   
        <th class="text-center" scope="col" style="padding-left: 50px; padding-right:50px;">Aksi</th>
    </tr>
  </thead>
  <tbody>

      <div></div>
      @foreach ($pendaftaran_kp as $kp)


      <!-- TIMER USULAN KP -->

      <!-- PEMBIMBING -->
@php
  $tanggalSaatIniUsulanKPPembimbing = date('Y-m-d');
@endphp

@php
  $tanggalUsulankpPembimbing = $kp->tgl_disetujui_usulankp_admin;
@endphp

<!-- Menghitung selisih hari -->
@php
  $waktuTersisaUsulanKPPembimbing = strtotime($tanggalSaatIniUsulanKPPembimbing) - strtotime($tanggalUsulankpPembimbing);
  $selisihHariUsulanKPPembimbing = floor($waktuTersisaUsulanKPPembimbing / (60 * 60 * 24));
  $jumlahselisihHariUsulanKPPembimbing = 4;
  $waktuUsulanKPPembimbing = $selisihHariUsulanKPPembimbing + $jumlahselisihHariUsulanKPPembimbing;
@endphp

<!-- BATAS -->

<!-- KOORDINATOR -->
@php
  $tanggalSaatIniUsulanKPKoordinator = date('Y-m-d');
@endphp
@php
  $tanggalUsulanKPKoordinator = $kp->tgl_disetujui_usulankp_pembimbing;
@endphp
<!-- Menghitung selisih hari -->
@php
  $waktuTersisaUsulanKPKoordinator = strtotime($tanggalSaatIniUsulanKPKoordinator) - strtotime($tanggalUsulanKPKoordinator);
  $selisihHariUsulanKPKoordinator = floor($waktuTersisaUsulanKPKoordinator / (60 * 60 * 24));
  $jumlahselisihHariUsulanKPKoordinator = 4;
  $waktuUsulanKPKoordinator = $selisihHariUsulanKPKoordinator + $jumlahselisihHariUsulanKPKoordinator;
@endphp

<!-- BATAS -->


<!-- KAPRODI -->
@php
  $tanggalSaatIniUsulanKPKaprodi = date('Y-m-d');
@endphp
@php
  $tanggalUsulanKPKaprodi = $kp->tgl_disetujui_usulankp_koordinator;
@endphp
<!-- Menghitung selisih hari -->
@php
  $waktuTersisaUsulanKPKaprodi = strtotime($tanggalSaatIniUsulanKPKaprodi) - strtotime($tanggalUsulanKPKaprodi);
  $selisihHariUsulanKPKaprodi = floor($waktuTersisaUsulanKPKaprodi / (60 * 60 * 24));
  $jumlahselisihHariUsulanKPKaprodi = 4;
  $waktuUsulanKPKaprodi = $selisihHariUsulanKPKaprodi + $jumlahselisihHariUsulanKPKaprodi;
@endphp

<!-- BATAS -->

<!-- KOORDINATOR SURAT BALASAN -->
@php
  $tanggalSaatIniBalasanKoordinator = date('Y-m-d');
@endphp
@php
  $tanggalBalasanKoordinator = $kp->tgl_created_balasan;
@endphp
<!-- Menghitung selisih hari -->
@php
  $waktuTersisaBalasanKoordinator = strtotime($tanggalSaatIniBalasanKoordinator) - strtotime($tanggalBalasanKoordinator);
  $selisihHariBalasanKoordinator = floor($waktuTersisaBalasanKoordinator / (60 * 60 * 24));
  $jumlahselisihHariBalasanKoordinator = 4;
  $waktuBalasanKoordinator = $selisihHariBalasanKoordinator + $jumlahselisihHariBalasanKoordinator;
@endphp

<!-- BATAS -->

        <tr>        
            <!-- <td class="text-center">{{$loop->iteration}}</td>-->
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>            
            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'SURAT PERUSAHAAN'|| $kp->status_kp == 'DAFTAR SEMINAR KP' ||$kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' )           
            <td class="text-center bg-secondary">{{$kp->status_kp}}</td>
            @endif
            @if ($kp->status_kp == 'USULAN KP DITERIMA' || $kp->status_kp == 'KP DISETUJUI'|| $kp->status_kp == 'SEMINAR KP SELESAI' ||$kp->status_kp == 'KP SELESAI')           
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
            @endif
            @if ( $kp->status_kp == 'SEMINAR KP DIJADWALKAN')           
            <td class="text-center bg-success">{{$kp->status_kp}}</td>
            @endif
      
                @if ($kp->status_kp == 'USULAN KP')           
                <td class="text-center">{{Carbon::parse($kp->tgl_created_usulan)->translatedFormat('l, d F Y')}}</td>
                @endif
            @if ($kp->status_kp == 'SURAT PERUSAHAAN')           
            <td class="text-center">{{Carbon::parse($kp->tgl_created_balasan)->translatedFormat('l, d F Y')}}</td>
            @endif
            @if ($kp->status_kp == 'DAFTAR SEMINAR KP')           
            <td class="text-center">{{Carbon::parse($kp->tgl_created_semkp)->translatedFormat('l, d F Y')}}</td>
            @endif

            <!-- MULAI -->
             @if ($kp->status_kp == 'USULAN KP')   

             <!-- PEMBIMBING -->
                @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
                @if ($kp->keterangan == 'Menunggu persetujuan Pembimbing' && $kp->status_kp == 'USULAN KP')
            <td class="text-center" >
                @if ($waktuUsulanKPPembimbing >= 0)
                    <span class="text-danger"> {{ $waktuUsulanKPPembimbing }}  hari lagi</span>
                @elseif($waktuUsulanKPPembimbing > 3)
                    Batas Waktu Unggah Surat Balasan telah habis
                @endif
            </td>
            @endif
            @endif
                
            <!-- KOORDINATOR -->
            
           @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator KP' && $kp->status_kp == 'USULAN KP' )
            <td class="text-center" >
                @if ($waktuUsulanKPKoordinator >= 0)
                    <span class="text-danger"> {{ $waktuUsulanKPKoordinator }}  hari lagi</span>
                @elseif($waktuUsulanKPKoordinator > 3)
                    Batas waktu telah habis
                @endif
            </td>
            @endif

            @endif
            @endif
           
            <!-- KAPRODI -->
            
        @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $kp->status_kp == 'USULAN KP' )
            <td class="text-center" >
                @if ($waktuUsulanKPKaprodi >= 0)
                    <span class="text-danger"> {{ $waktuUsulanKPKaprodi }}  hari lagi</span>
                @elseif($waktuUsulanKPKaprodi > 3)
                    Batas waktu telah habis
                @endif
            </td>
            @endif
            @endif
            @endif


            @endif

            <!-- BATAS -->


             <!-- BALASAN KP KOORDINATOR -->
            
           @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          
            @if ($kp->keterangan == 'Menunggu persetujuan Koordinator KP' && $kp->status_kp == 'SURAT PERUSAHAAN' )
            <td class="text-center" >
                @if ($waktuBalasanKoordinator >= 0)
                    <span class="text-danger"> {{ $waktuBalasanKoordinator }}  hari lagi</span>
                @elseif($waktuBalasanKoordinator > 3)
                    Batas waktu telah habis
                @endif
            </td>
            @endif

            @endif
            @endif
                               
            <td class="text-center">{{$kp->keterangan}}</td>  

         
            @if (Str::length(Auth::guard('dosen')->user()) > 0)
            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'USULAN KP DITERIMA' )
            <td class="text-center">
            @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
                @if ($kp->keterangan == 'Menunggu persetujuan Pembimbing' && $kp->status_kp == 'USULAN KP')
                <div class="row persetu">
                <div class="col-4 py-2 py-md-0 col-lg-4">

        <button onclick="tolakUsulanKPPembimbing({{ $kp->id }})" class=" btn btn-danger badge p-1 "  data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
     <a href="/kp-skripsi/persetujuan/usulankp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usulankp/pembimbing/approve/{{$kp->id}}" class="setujui-usulankp-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>

    </div>
       @endif
    @endif

@if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator KP' && $kp->status_kp == 'USULAN KP' )
  <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulanKPKoordinator({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
     <a href="/kp-skripsi/persetujuan/usulankp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
    </div>
       <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usulankp/koordinator/approve/{{$kp->id}}" class="setujui-usulankp-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>
       @endif
    @endif
    @endif

@if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $kp->status_kp == 'USULAN KP' )
   <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
           <button onclick="tolakUsulanKPKaprodi({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
     <a href="/kp-skripsi/persetujuan/usulankp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
    </div>
       <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usulankp/kaprodi/approve/{{$kp->id}}" class="setujui-usulankp-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>
       @endif
    @endif
    @endif
          

            </td>
            @endif
            
            @if ($kp->status_kp == 'SURAT PERUSAHAAN' || $kp->status_kp == 'KP DISETUJUI' )
            <td class="text-center">
           @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator KP' && $kp->status_kp == 'SURAT PERUSAHAAN' )
  <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakBalasanKPKoordinator({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
                    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/suratperusahaan/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a></div>
          <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/balasankp/koordinator/approve/{{$kp->id}}" class="setujui-balasankp-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>

       @endif
    @endif
    @endif
            </td>
            @endif
            @if ($kp->status_kp == 'DAFTAR SEMINAR KP' || $kp->status_kp == 'SEMINAR KP DIJADWALKAN'|| $kp->status_kp == 'SEMINAR KP SELESAI')
            <td class="text-center">
        @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
          @if ($kp->keterangan == 'Menunggu persetujuan Pembimbing' && $kp->status_kp == 'DAFTAR SEMINAR KP' )
   <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemKPPemb({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
     <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/semkp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
<div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usulan-semkp/pembimbing/approve/{{$kp->id}}" class="setujui-semkp-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>


    @endif
    @endif
    
    @if (Str::length(Auth::guard('dosen')->user()) > 0)
    @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
    
    @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Koordinator KP')
    
     <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemKPKoordinator({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
     <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/semkp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
<div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usulan-semkp/koordinator/approve/{{$kp->id}}" class="setujui-semkp-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>
    
    @endif
    @endif
    @endif

    @if (Str::length(Auth::guard('dosen')->user()) > 0)
    @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
    
    @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Koordinator Program Studi')
    
     <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemKPKaprodi({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
     <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/semkp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
<div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usulan-semkp/kaprodi/approve/{{$kp->id}}" class="setujui-semkp-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>
    
    @endif
    @endif
    @endif

        @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
          @if ($kp->keterangan == 'Seminar KP Dijadwalkan' && $kp->status_kp == 'SEMINAR KP DIJADWALKAN' )
  <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakGagalSemKPPemb({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Gagal Seminar KP" ><i class="fas fa-times-circle"></i></button> 
</div>
     <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/semkp/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
<div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/selesaiseminar-kp/pembimbing/approve/{{$kp->id}}" class="setujui-selesai-semkp-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Selesai Seminar KP"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>

    @endif
    @endif


            </td>
            @endif

            @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' || $kp->status_kp == 'KP SELESAI')
            <td class="text-center">

        @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
 
          @if ($kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' && $kp->keterangan == 'Menunggu persetujuan Koordinator KP')
    <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakKPTI10Koordinator({{ $kp->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button> 
</div>
      <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/kpti10/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
   <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/kpti10/koordinator/approve/{{$kp->id}}" class="setujui-kpti10-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>

 @endif
    @endif
    @endif
        @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
 
          @if ($kp->status_kp == 'KP SELESAI' && $kp->keterangan == 'Proses Kerja Praktek Selesai')
    <div class="row persetu">
 
      <div class="col-4 py-2 py-md-0 col-lg-6">
                <a href="/kp-skripsi/persetujuan/kpti10/{{($kp->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
   <div class="col-4 py-2 py-md-0 col-lg-6">
        <form action="/nilaikpkeluar/koordinator/approve/{{$kp->id}}" class="setujui-nilai-kp-keluar-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
   
    </div>
    </div>

 @endif
    @endif
    @endif
    </div>
            </td>
            @endif  

@endif 

        </tr>

    @endforeach


     @foreach ($pendaftaran_skripsi as $skripsi)
<div></div>
        <tr>        
            <!-- <td class="text-center">{{$loop->iteration}}</td>                              -->
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$skripsi->jenis_usulan}}</td>          -->
         
            @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'DAFTAR SIDANG' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')           
            <td class="text-center bg-secondary">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI' || $skripsi->status_skripsi == 'SEMPRO SELESAI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' || $skripsi->status_skripsi == 'SIDANG SELESAI'  || $skripsi->status_skripsi == 'SKRIPSI SELESAI')           
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>
            @endif
           
            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN')           
            <td class="text-center bg-success">{{$skripsi->status_skripsi}}</td>
            @endif

            <!-- ___________batas____________ -->

            @if ($skripsi->status_skripsi == 'USULAN JUDUL')           
            <td class="text-center">{{Carbon::parse($skripsi->tgl_created_usuljudul)->translatedFormat('l, d F Y')}}</td>
            @endif

               
            <td class="text-center">{{$skripsi->keterangan}}</td> 


            <!-- USUL JUDUL  -->
            @if ($skripsi->status_skripsi == 'USULAN JUDUL'|| $skripsi->status_skripsi == 'USULAN JUDUL DISETUJUI'  )
            <td class="text-center">
            
            @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' && $skripsi->status_skripsi == 'USULAN JUDUL' )
            <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulJudulPemb1({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/usulanjudul/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usuljudul/pembimbing1/approve/{{$skripsi->id}}" class="setujui-usuljudul-pemb1" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>
    </div>

    @endif
    @endif
            @if ($skripsi->pembimbing_2_nip == Auth::user()->nip)
            @if ($skripsi->keterangan == 'Menunggu persetujuan Pembimbing 2' && $skripsi->status_skripsi == 'USULAN JUDUL' )
            <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulJudulPemb2({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>

    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/usulanjudul/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usuljudul/pembimbing2/approve/{{$skripsi->id}}" class="setujui-usuljudul-pemb2" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>

    @endif
    @endif

     @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
           @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Skripsi' && $skripsi->status_skripsi == 'USULAN JUDUL' )
            <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulJudulKoordinator({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/usulanjudul/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usuljudul/koordinator/approve/{{$skripsi->id}}" class="setujui-usuljudul-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>

    @endif
    @endif
    @endif

     

     @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
           @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $skripsi->status_skripsi == 'USULAN JUDUL' )
            <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakUsulJudulKaprodi({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/usulanjudul/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/usuljudul/kaprodi/approve/{{$skripsi->id}}" class="setujui-usuljudul-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>

    @endif
    @endif
    @endif

            </td>
            @endif

           <!-- DAFTAR SEMPRO -->

           @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemproPemb1({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sempro/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/daftarsempro/pembimbing1/approve/{{$skripsi->id}}" class="setujui-sempro-pemb1" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     @endif

      @if (Str::length(Auth::guard('dosen')->user()) > 0)
    @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
    
    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' && $skripsi->keterangan == 'Menunggu Jadwal Seminar Proposal')
      <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSemproKoordinator({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sempro/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/daftar-sempro/koordinator/approve/{{$skripsi->id}}" class="setujui-sempro-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
    
    @endif
    @endif
    @endif

           @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' && $skripsi->keterangan == 'Seminar Proposal Dijadwalkan' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSelesaiSempro({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Gagal Sempro" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sempro/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/selesaisempro/pembimbing/approve/{{$skripsi->id}}" class="setujui-selesai-sempro-pemb1" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Selesai Sempro"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     @endif
           

           @if ($skripsi->pembimbing_2_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 2' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakSemproPemb2({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sempro/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/daftarsempro/pembimbing2/approve/{{$skripsi->id}}" class="setujui-sempro-pemb2" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     @endif


     @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakPerpanjangan1Pembimbing({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Gagal Sempro" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/perpanjangan-1/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/perpanjangan1/pembimbing/approve/{{$skripsi->id}}" class="setujui-perpanjangan1-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     @endif

     @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakPerpanjangan2Pembimbing({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Gagal Sempro" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/perpanjangan-2/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/perpanjangan2/pembimbing/approve/{{$skripsi->id}}" class="setujui-perpanjangan2-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     @endif

     @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakPerpanjanganRevisiPembimbing({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Gagal Sempro" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/perpanjangan-revisi/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/perpanjangan-revisi/pembimbing/approve/{{$skripsi->id}}" class="setujui-perpanjangan-revisi-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     @endif


           @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
           @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $skripsi->status_skripsi == 'PERPANJANGAN 1' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakPerpanjangan1Kaprodi({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/perpanjangan-1/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/perpanjangan1/kaprodi/approve/{{$skripsi->id}}" class="setujui-perpanjangan1-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
           @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $skripsi->status_skripsi == 'PERPANJANGAN 2' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakPerpanjangan2Kaprodi({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/perpanjangan-2/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/perpanjangan2/kaprodi/approve/{{$skripsi->id}}" class="setujui-perpanjangan2-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif

           @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $skripsi->status_skripsi == 'PERPANJANGAN REVISI' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakPerpanjanganRevisiKaprodi({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/perpanjangan-revisi/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/perpanjangan-revisi/kaprodi/approve/{{$skripsi->id}}" class="setujui-perpanjangan-revisi-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif

     @endif
     @endif

     @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
           
           @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Skripsi' && $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakBukuSkripsiKoordinator({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/bukti-buku-skripsi/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/buku-skripsi/koordinator/approve/{{$skripsi->id}}" class="setujui-buku-skripsi-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif
     
           @if ($skripsi->keterangan == 'Proses Skripsi Selesai!' && $skripsi->status_skripsi == 'SKRIPSI SELESAI' )
            <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-6">
                <a href="/kp-skripsi/persetujuan/bukti-buku-skripsi/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-6">
        <form action="/nilaiskripsikeluar/koordinator/approve/{{$skripsi->id}}" class="setujui-lulus-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Lulus"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
     @endif

     @endif
     @endif

            
            <!-- DAFTAR SIDANG -->
    

            @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' )
             <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSidangPemb1({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sidang/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/daftarsidang/pembimbing1/approve/{{$skripsi->id}}" class="setujui-sidang-pemb1" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
</tr>
@endif
            @if ($skripsi->status_skripsi == 'SIDANG DIJADWALKAN' && $skripsi->keterangan == 'Sidang Skripsi Dijadwalkan' )
             <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <button onclick="tolakSelesaiSidang({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Gagal Sidang" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sidang/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/selesaisidang/pembimbing/approve/{{$skripsi->id}}" class="setujui-selesai-sidang-pemb1" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Selesai Sidang"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
</tr>
@endif

@endif
            @if ($skripsi->pembimbing_2_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 2' )
             <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakSidangPemb2({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sidang/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/daftarsidang/pembimbing2/approve/{{$skripsi->id}}" class="setujui-sidang-pemb2" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
</tr>
@endif
@endif


     @if (Str::length(Auth::guard('dosen')->user()) > 0)
      @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG' && $skripsi->keterangan == 'Menunggu Jadwal Sidang Skripsi' )
             <td class="text-center">
                <div class="row persetu">
    <div class="col-4 py-2 py-md-0 col-lg-4">
       <button onclick="tolakSidangKoordinator({{ $skripsi->id }})" class="btn btn-danger badge p-1 " data-bs-toggle="tooltip" title="Tolak" ><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
                <a href="/kp-skripsi/persetujuan/sidang/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
    <div class="col-4 py-2 py-md-0 col-lg-4">
        <form action="/daftar-sidang/koordinator/approve/{{$skripsi->id}}" class="setujui-sidang-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-1 " data-bs-toggle="tooltip" title="Setujui"><i class="fas fa-check-circle"></i></button>
</form>

    </div>
</tr>
@endif
@endif
@endif

    @endforeach



     @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>                     
          <td class="bg-warning text-center">Seminar {{$skripsi->jenis_seminar}}</td>                     
          <!-- <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>           -->
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">-</td>                   
          <td class="text-center">{{$skripsi->lokasi}}</td>                     
          <!-- <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td> 
          <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>           -->
          <!-- <td class="text-center">                        
            <a href="/penilaian-skripsi/cek-nilai/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2"style="border-radius:20px;">Berita Acara</a>                  
          </td> -->

@if (Str::length(Auth::guard('dosen')->user()) > 0)
      @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          <td class="text-center">
            <div class="col-12 py-2 py-md-0 col-lg-12">
                <a href="/persetujuan-koordinator/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
          </td>
    @endif
    @endif

@if (Str::length(Auth::guard('dosen')->user()) > 0)
      @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          <td class="text-center">
            <div class="col-12 py-2 py-md-0 col-lg-12">
                <a href="/persetujuan-kaprodi/detail/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                 </div>
          </td>

 @endif
    @endif

        </tr>
    @endforeach



  </tbody>

</table>
</div>

</div>


@endsection


@push('scripts')
@foreach ($pendaftaran_kp as $kp)
<script>
//APPROVAL KERJA PRAKTEK
$('.setujui-usulankp-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju',
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

 function tolakUsulanKPPembimbing(id) {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    
                    title: 'Tolak Usulan KP',
                    html: `
                        <form  action="/usulankp/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                           @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control @error ('alasan') is-invalid @enderror" value="{{ old('alasan') }}" name="alasan" rows="4" cols="50" autofocus required></textarea>
                            @error('alasan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            <br>
                            <button type="submit"  class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                      
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-usulankp-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});


 function tolakUsulanKPKoordinator(id) {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-usulankp-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakUsulanKPKaprodi(id) {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

    
$('.setujui-balasankp-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Surat Balasan Peusahaan!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakBalasanKPKoordinator(id) {
     Swal.fire({
            title: 'Tolak Surat Basalan Perusahaan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Surat Basalan Perusahaan KP',
                    html: `
                        <form id="reasonForm" action="/balasankp/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-semkp-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Seminar KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakSemKPPemb(id) {
     Swal.fire({
            title: 'Tolak Usulan Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    html: `
                        <form id="reasonForm" action="/usulan-semkp/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }
$('.setujui-semkp-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Seminar KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakSemKPKoordinator(id) {
     Swal.fire({
            title: 'Tolak Usulan Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    html: `
                        <form id="reasonForm" action="/usulan-semkp/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }
$('.setujui-semkp-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Seminar KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakSemKPKaprodi(id) {
     Swal.fire({
            title: 'Tolak Usulan Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    html: `
                        <form id="reasonForm" action="/usulan-semkp/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-selesai-semkp-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Selesai Seminar KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Selesai'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakGagalSemKPPemb(id) {
     Swal.fire({
            title: 'Gagal Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Gagal',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Gagal Seminar KP',
                    html: `
                        <form id="reasonForm" action="/selesaiseminar-kp/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-kpti10-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Bukti Penyerahan Laporan KP!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakKPTI10Koordinator(id) {
     Swal.fire({
            title: 'Tolak KPTI-10/Bukti Penyerahan Laporan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak KPTI-10/Bukti Penyerahan Laporan KP',
                    html: `
                        <form id="reasonForm" action="/kpti10/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }

$('.setujui-nilai-kp-keluar-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Nilai KP Keluar!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});
</script>
@endforeach
@endpush()


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($pendaftaran_kp->count()) !!};
    const waitingApprovalElement = document.getElementById('waitingApprovalCount');
    waitingApprovalElement.innerText = waitingApprovalCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prodiKPCount = {!! json_encode($jml_prodikp->count()) !!};
    const prodiKPElement = document.getElementById('prodiKPCount');
       prodiKPElement.innerText = prodiKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bimbinganKPCount = {!! json_encode($jml_bimbingankp->count()) !!};
    const bimbinganKPElement = document.getElementById('bimbinganKPCount');
       bimbinganKPElement.innerText = bimbinganKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seminarKPCount = {!! json_encode($jml_seminarkp->count()) !!};
    const seminarKPElement = document.getElementById('seminarKPCount');
       seminarKPElement.innerText = seminarKPCount;
});
</script>
@endpush()