@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
Pendaftaran Skripsi > Mahasiswa Bimbingan
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif


<div class="container card p-4">
<ol class="breadcrumb col-lg-12" >
 
<div class="btn-group menu-dosen scrollable-btn-group col-md-12" >

   <a href="/kp-skripsi/persetujuan"  class="btn bg-light border  border-bottom-0"  style="border-top-left-radius: 15px;" >Persetujuan</a>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <a href="/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">KP Prodi</span>
  <span class="badge-link">
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-light ">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  
<a href="/skripsi"  class="btn bg-light border  border-bottom-0 "  >
  <span class="button-text">Skripsi Prodi</span>
  <span class="badge-link">
    <a href="/skripsi/nilai-keluar" class="sejarah pt-2 bg-light ">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

  @endif
@endif

<a href="/pembimbing/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Bimbingan KP</span>
  <span class="badge-link" >
    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="sejarah pt-2 bg-light ">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

<a href="/pembimbing/skripsi" class="btn btn-outline-success border  border-bottom-0 active">
   <span class="button-text">Bimbingan Skripsi</span>
  <span class="badge-link">
    <a href="/skripsi/pembimbing/nilai-keluar" class="sejarah pt-2 bg-light " style="border-top-right-radius: 40%;">
       <span class= "p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

</div>
</ol>



<div class="container-fluid">
 

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center px-0" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <!-- <th class="text-center" scope="col">Konsentrasi</th> -->
        <th class="text-center" scope="col">Jenis Usulan</th>
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
            <!-- <td class="text-center">{{$skripsi->konsentrasi->nama_konsentrasi}}</td>            -->
            <td class="text-center">{{$skripsi->jenis_usulan}}</td>   
               
           @if ($skripsi->status_skripsi == 'USULAN JUDUL' || $skripsi->status_skripsi == 'DAFTAR SEMPRO'|| $skripsi->status_skripsi == 'DAFTAR SIDANG' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')           
            <td class="text-center bg-secondary">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI'||$skripsi->status_skripsi == 'SEMPRO SELESAI' || $skripsi->status_skripsi == 'SIDANG SELESAI' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' || $skripsi->status_skripsi == 'SKRIPSI SELESAI')           
            <td class="text-center bg-info">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN')           
            <td class="text-center bg-success">{{$skripsi->status_skripsi}}</td>
            @endif
            @if ($skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' || $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' )           
            <td class="text-center bg-danger">{{$skripsi->status_skripsi}}</td>
            @endif

                               
             @if ($skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' || $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' )
            <td class="text-center text-danger">{{$skripsi->keterangan}}</td>
            @else   
            <td class="text-center">{{$skripsi->keterangan}}</td>
            @endif 

                        <!-- USUL JUDUL  -->
            @if ($skripsi->status_skripsi == 'USULAN JUDUL'|| $skripsi->status_skripsi == 'JUDUL DISETUJUI'  )
            <td class="text-center">
            
               <a href="/usuljudul/detail/pembimbing/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

            </td>
            @endif

           <!-- DAFTAR SEMPRO -->
           @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO' || $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN'|| $skripsi->status_skripsi == 'SEMPRO SELESAI' ) 
            <td class="text-center">
          <a href="/daftar-sempro/detail/pembimbing/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
     @endif
            
            <!-- DAFTAR SIDANG -->
            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG SELESAI' ) 

           <td class="text-center">
          <a href="/daftar-sidang/detail/pembimbing/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' ) 

           <td class="text-center">
          <a href="/kp-skripsi/pembimbing/perpanjangan-1/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' ) 

           <td class="text-center">
          <a href="/kp-skripsi/pembimbing/perpanjangan-2/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' || $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' ) 

           <td class="text-center">
          <a href="/kp-skripsi/pembimbing/perpanjangan-revisi/{{($skripsi->id)}}" class="badge btn btn-info p-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif
            @if ($skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' || $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK' || $skripsi->status_skripsi == 'SKRIPSI SELESAI' ) 

           <td class="text-center">
          <a href="/kp-skripsi/pembimbing/bukti-buku-skripsi/{{($skripsi->id)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>
@endif



        </tr>

    @endforeach
  </tbody>


</table>
</div>
</div>


@endsection

