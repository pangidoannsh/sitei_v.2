@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Kerja Praktek
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif



<div class="container-fluid">

@if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 5)
          
          <a href="/daftarkp-dosen" class="btn mahasiswa btn-success mb-3">Usulkan KP</a>

          @endif
          @endif
</div>


<!-- <div class="container">
  <div class="row">
    <div class="col">col</div>
    <div class="col">col</div>
    <div class="col">col</div>
    <div class="col">col</div>
  </div> -->

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Konsentrasi</th>
        <th class="text-center" scope="col">Angkatan</th>     
        <th class="text-center" scope="col">Jenis Usulan</th>
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  
    @foreach ($pendaftaran_kp as $kp)
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>
            <td class="text-center">{{$kp->konsentrasi->nama_konsentrasi}}</td>                   
            <td class="text-center">{{$kp->mahasiswa->angkatan}}</td>                   
            <td class="text-center bg-warning">{{$kp->jenis_usulan}}</td>
            @if ($kp->status_kp == 'USULAN' )
            <td class="text-center">
            <a href="/daftarkp-koordinator/detail-usulankp/ {{Crypt::encryptString($kp->id)}}"><button class="btn btn-success" type="button">Lihat Detail</button></a>
            </td>
            @endif

            @if ($kp->status_kp == 'USULAN DISETUJUI' )
            <td class="text-center">
            <a href="/daftarkp-koordinator/detail-permohonankp/ {{Crypt::encryptString($kp->id)}}"><button class="btn btn-success" type="button">Lihat Detail</button></a>
            </td>
            @endif

        </tr>
    @endforeach
  
  </tbody>
</table>



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