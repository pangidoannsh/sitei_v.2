@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Penilaian | SIA ELEKTRO
@endsection

@section('sub-title')
    Penilaian
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

@if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('loginError')}}        
      </div>
@endif
<div class="container card  p-4">
<ol class="breadcrumb col-lg-12" >
 
<div class="btn-group menu-dosen scrollable-btn-group col-md-12">

   <a href="/kp-skripsi/persetujuan-kp" class="btn bg-light border  border-bottom-0 "   style="border-top-left-radius: 15px;" >Persetujuan</a>
   <a href="/kp-skripsi/penilaian-kp" class="btn btn-outline-success border  border-bottom-0 active">Seminar</a>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <a href="/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">KP Prodi</span>
  <span class="badge-link">
    <a href="/kerja-praktek/nilai-keluar" class="sejarah pt-2 bg-light "> <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>
  @endif
@endif

<a href="/pembimbing/kerja-praktek"  class="btn bg-light border  border-bottom-0 " >
  <span class="button-text">Bimbingan KP</span>
  <span class="badge-link" >
    <a href="/kerja-praktek/pembimbing/nilai-keluar" class="sejarah pt-2  bg-light " style="border-top-right-radius: 15px;">
      <span class="p-1" data-bs-toggle="tooltip" title="Riwayat KP"><i class="fas fa-history"></i></i></span>
    </a>
  </span>
</a>

</div>
</ol>

<ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/kp-skripsi/penilaian-kp">Jadwal Seminar</a></li>      
  <li class="breadcrumb-item"><a href="/kp-skripsi/riwayat-penilaian-kp">Riwayat Penilaian</a></li>  
</ol>

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>      
      <th class="text-center" scope="col">NIM</th>
      <th class="text-center" scope="col">Nama</th>
      <th class="text-center" scope="col">Seminar</th>
      <th class="text-center" scope="col">Prodi</th>
      <th class="text-center" scope="col">Tanggal</th>
      <th class="text-center" scope="col">Waktu</th>
      <th class="text-center" scope="col">Lokasi</th>              
      <th class="text-center" scope="col">Pembimbing</th>
      <th class="text-center" scope="col">Penguji</th>          
      <th class="text-center"scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody> 
    
    @foreach ($penjadwalan_kps as $kp)    
      <tr>                 
        <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
        <td class="text-center">{{$kp->mahasiswa->nama}}</td>                    
        <td class="bg-primary text-center">{{$kp->jenis_seminar}}</td>                     
        <td class="text-center">{{$kp->prodi->nama_prodi}}</td>          
        <td class="text-center">{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>                   
        <td class="text-center">{{$kp->waktu}}</td>                   
        <td class="text-center">{{$kp->lokasi}}</td>             
        <td class="text-center">
          <p>{{$kp->pembimbing->nama_singkat}}</p>           
        </td>         
        <td class="text-center">
          <p>{{$kp->penguji->nama_singkat}}</p>           
        </td>
        <td class="text-center">
          @if ($kp->penilaian(Auth::user()->nip, $kp->id) == false)
            @if (Carbon::now() >= $kp->tanggal && Carbon::now()->format('H:i:m') >= $kp->waktu)
            <a href="/penilaian-kp/create/{{Crypt::encryptString($kp->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
            @else
            <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>
            @endif
          @else
            <a href="/penilaian-kp/edit/{{Crypt::encryptString($kp->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
          @endif              
        </td>                                
      </tr>               
    @endforeach

   

  </tbody>
</table>
</div>
@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endpush()

@push('scripts')
<script>
  const swal= $('.swal').data('swal');
  if (swal) {
    Swal.fire({
      title : 'Berhasil',
      text : swal,
      confirmButtonColor: '#28A745',
      icon : 'success'
    })    
  }
</script>
@endpush()