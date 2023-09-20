@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI ELEKTRO | Persetujuan KP dan Skripsi
@endsection

@section('sub-title')
    Persetujuan Kerja Praktek dan Skripsi
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container card  p-4">
<ol class="breadcrumb col-lg-12" >
 
<div class="btn-group menu-dosen scrollable-btn-group col-md-12">

   <a href="/kp-skripsi/persetujuan" class="btn btn-outline-success border  border-bottom-0 active"   style="border-top-left-radius: 15px;" >Persetujuan</a>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if ( Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <a href="/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">KP Prodi</span>
  <span class="badge-link">
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-light "> <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  
<a href="/skripsi"  class="btn bg-light border  border-bottom-0 "  >
  <span class="button-text">Skripsi Prodi</span>
  <span class="badge-link">
    <a href="/skripsi/nilai-keluar" class="sejarah pt-2  bg-light ">      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat Skripsi"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

  @endif
@endif

<a href="/pembimbing/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Bimbingan KP</span>
  <span class="badge-link" >
    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="sejarah pt-2  bg-light ">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

<a href="/pembimbing/skripsi" class="btn bg-light border  border-bottom-0">
   <span class="button-text">Bimbingan Skripsi</span>
  <span class="badge-link">
    <a href="/skripsi/pembimbing/nilai-keluar" class="sejarah pt-2  bg-light " style="border-top-right-radius: 15px;">
       <span class="p-1" data-bs-toggle="tooltip" title="Riwayat Skripsi"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

</div>
</ol>

<div class="container-fluid">

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <!-- <th class="text-center" scope="col">No.</th> -->
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <!-- <th class="text-center" scope="col">Konsentrasi</th>   -->
        <th class="text-center" scope="col">Jenis Usulan</th>
        <th class="text-center" scope="col">Status</th>
        <th class="text-center" scope="col">Keterangan</th>   
        <th class="text-center" scope="col" style="padding-left: 50px; padding-right:50px;">Aksi</th>
    </tr>
  </thead>
  <tbody>

      <div></div>
      @foreach ($pendaftaran_kp as $kp)
        <tr>        
            <!-- <td class="text-center">{{$loop->iteration}}</td>                              -->
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>
            <!-- <td class="text-center">{{$kp->mahasiswa->konsentrasi->nama_konsentrasi}}</td>-->
            <td class="text-center">{{$kp->jenis_usulan}}</td>             
            @if ($kp->status_kp == 'USULAN KP' || $kp->status_kp == 'SURAT PERUSAHAAN'|| $kp->status_kp == 'DAFTAR SEMINAR KP' ||$kp->status_kp == 'BUKTI PENYERAHAN LAPORAN' )           
            <td class="text-center bg-secondary">{{$kp->status_kp}}</td>
            @endif
            @if ($kp->status_kp == 'USULAN KP DITERIMA' || $kp->status_kp == 'KP DISETUJUI'|| $kp->status_kp == 'SEMINAR KP SELESAI' ||$kp->status_kp == 'KP SELESAI')           
            <td class="text-center bg-info">{{$kp->status_kp}}</td>
            @endif
            @if ( $kp->status_kp == 'SEMINAR KP DIJADWALKAN')           
            <td class="text-center bg-success">{{$kp->status_kp}}</td>
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
    
    @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu Jadwal Seminar KP')
    
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
            <td class="text-center">{{$skripsi->jenis_usulan}}</td>         
         
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
        confirmButtonText: 'Setuju'
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
@foreach ($pendaftaran_skripsi as $skripsi)
<script>

//APROVAL SKRIPSI
$('.setujui-usuljudul-pemb1').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Judul Skripsi!',
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

function tolakUsulJudulPemb1(id) {
     Swal.fire({
            title: 'Tolak Usulan Judul Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    html: `
                        <form id="reasonForm" action="/usuljudul/pembimbing1/tolak/${id}" method="POST">
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
    
$('.setujui-usuljudul-pemb2').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Judul Skripsi!',
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

function tolakUsulJudulPemb2(id) {
     Swal.fire({
            title: 'Tolak Usulan Judul Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    html: `
                        <form id="reasonForm" action="/usuljudul/pembimbing2/tolak/${id}" method="POST">
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

$('.setujui-usuljudul-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Judul Skripsi!',
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

function tolakUsulJudulKoordinator(id) {
     Swal.fire({
            title: 'Tolak Usulan Judul Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    html: `
                        <form id="reasonForm" action="/usuljudul/koordinator/tolak/${id}" method="POST">
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

$('.setujui-usuljudul-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Judul Skripsi!',
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

function tolakUsulJudulKaprodi(id) {
     Swal.fire({
            title: 'Tolak Usulan Judul Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    html: `
                        <form id="reasonForm" action="/usuljudul/kaprodi/tolak/${id}" method="POST">
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


//SEMPRO
$('.setujui-sempro-pemb1').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sempro!',
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

function tolakSemproPemb1(id) {
     Swal.fire({
            title: 'Tolak Usulan Seminar Proposal',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    html: `
                        <form id="reasonForm" action="/daftarsempro/pembimbing1/tolak/${id}" method="POST">
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

$('.setujui-sempro-pemb2').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sempro!',
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

function tolakSemproPemb2(id) {
     Swal.fire({
            title: 'Tolak Usulan Seminar Proposal',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    html: `
                        <form id="reasonForm" action="/daftarsempro/pembimbing2/tolak/${id}" method="POST">
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

    $('.setujui-sempro-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sempro!',
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

function tolakSemproKoordinator() {
     Swal.fire({
            title: 'Tolak Usulan Seminar Proposal',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    html: `
                        <form id="reasonForm" action="/daftar-sempro/koordinator/tolak/{{$skripsi->id}}" method="POST">
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


$('.setujui-selesai-sempro-pemb1').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Selesai Seminar Proposal!',
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

function tolakSelesaiSempro(id) {
     Swal.fire({
            title: 'Gagal Seminar Proposal',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Gagal',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Gagal Seminar Proposal',
                    html: `
                        <form id="reasonForm" action="/selesaisempro/pembimbing/tolak/${id}" method="POST">
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
$('.setujui-perpanjangan1-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan 1 Waktu Skripsi!',
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

function tolakPerpanjangan1Pembimbing(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan 1 Waktu Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 1 Waktu Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan1/pembimbing/tolak/${id}" method="POST">
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
$('.setujui-perpanjangan1-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan 1 Waktu Skripsi!',
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

function tolakPerpanjangan1Kaprodi(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan 1 Waktu Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 1 Waktu Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan1/kaprodi/tolak/${id}" method="POST">
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


$('.setujui-perpanjangan2-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan 2 Waktu Skripsi!',
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

function tolakPerpanjangan2Pembimbing(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan 2 Waktu Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 2 Waktu Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan2/pembimbing/tolak/${id}" method="POST">
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
$('.setujui-perpanjangan2-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan 2 Waktu Skripsi!',
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

function tolakPerpanjangan2Kaprodi(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan 2 Waktu Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 2 Waktu Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan2/kaprodi/tolak/${id}" method="POST">
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



  // DAFTAR SIDANG PEMBIMBING 1
$('.setujui-sidang-pemb1').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sidang!',
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

function tolakSidangPemb1(id) {
     Swal.fire({
            title: 'Tolak Usulan Sidang Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    html: `
                        <form id="reasonForm" action="/daftarsidang/pembimbing1/tolak/${id}" method="POST">
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

  //DAFTAR SIDANG PEMBIMBING 2
$('.setujui-sidang-pemb2').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sidang!',
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

function tolakSidangPemb2(id) {
     Swal.fire({
            title: 'Tolak Usulan Sidang Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    html: `
                        <form id="reasonForm" action="/daftarsidang/pembimbing2/tolak/${id}" method="POST">
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
$('.setujui-sidang-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Daftar Sidang!',
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

function tolakSidangKoordinator(id) {
     Swal.fire({
            title: 'Tolak Usulan Sidang Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    html: `
                        <form id="reasonForm" action="/daftar-sidang/koordinator/tolak/${id}" method="POST">
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


$('.setujui-selesai-sidang-pemb1').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Selesai Sidang Skripsi!',
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

function tolakSelesaiSidang(id) {
     Swal.fire({
            title: 'Gagal Sidang Skripsi',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Gagal',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Gagal Sidang Skripsi',
                    html: `
                        <form id="reasonForm" action="/selesaisidang/pembimbing/tolak/${id}" method="POST">
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

//PERPANJANGAN REVISI

$('.setujui-perpanjangan-revisi-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan Revisi Skripsi!',
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

function tolakPerpanjanganRevisiPembimbing(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan Revisi Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan Revisi Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan-revisi/pembimbing/tolak/${id}" method="POST">
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
$('.setujui-perpanjangan-revisi-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan Revisi Skripsi!',
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

function tolakPerpanjanganRevisiKaprodi(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan Revisi Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan Revisi Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan-revisi/kaprodi/tolak/${id}" method="POST">
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



$('.setujui-buku-skripsi-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Bukti Penyerahan Buku Skripsi!',
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

function tolakBukuSkripsiKoordinator(id) {
     Swal.fire({
            title: 'Tolak Bukti Penyerahan Buku Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Bukti Penyerahan Buku Skripsi',
                    html: `
                        <form id="reasonForm" action="/buku-skripsi/koordinator/tolak/${id}" method="POST">
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
$('.setujui-lulus-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Lulus Skripsi!',
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




//  $('.setujui-perpanjangan-revisi-pemb1').submit(function(event) {
//     event.preventDefault();
//     Swal.fire({
//         title: 'Setujui Perpanjangan Revisi Skripsi!',
//         text: "Apakah Anda Yakin?",
//         icon: 'question',
//         showCancelButton: true,
//         cancelButtonText: 'Batal',
//         confirmButtonColor: '#28a745',
//         cancelButtonColor: 'grey',
//         confirmButtonText: 'Setuju'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             event.currentTarget.submit();
//         }
//     })
// });

// $('.tolak-perpanjangan-revisi-pemb1').submit(function(event) {
//     event.preventDefault();
//     Swal.fire({
//         title: 'Tolak Perpanjangan Revisi Skripsi!',
//         text: "Apakah Anda Yakin?",
//         icon: 'question',
//         showCancelButton: true,
//         cancelButtonText: 'Batal',
//         confirmButtonColor: '#dc3545',
//         cancelButtonColor: 'grey',
//         confirmButtonText: 'Tolak'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             event.currentTarget.submit();
//         }
//     })
// });
//   //PEMBIMBING 2
// $('.setujui-perpanjangan-revisi-pemb2').submit(function(event) {
//     event.preventDefault();
//     Swal.fire({
//         title: 'Setujui Perpanjangan Revisi Skripsi!',
//         text: "Apakah Anda Yakin?",
//         icon: 'question',
//         showCancelButton: true,
//         cancelButtonText: 'Batal',
//         confirmButtonColor: '#28a745',
//         cancelButtonColor: 'grey',
//         confirmButtonText: 'Setuju'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             event.currentTarget.submit();
//         }
//     })
// });

// $('.tolak-perpanjangan-revisi-pemb2').submit(function(event) {
//     event.preventDefault();
//     Swal.fire({
//         title: 'Tolak Perpanjangan Revisi Skripsi!',
//         text: "Apakah Anda Yakin?",
//         icon: 'question',
//         showCancelButton: true,
//         cancelButtonText: 'Batal',
//         confirmButtonColor: '#dc3545',
//         cancelButtonColor: 'grey',
//         confirmButtonText: 'Tolak'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             event.currentTarget.submit();
//         }
//     })
// });

</script>
@endforeach
@endpush()